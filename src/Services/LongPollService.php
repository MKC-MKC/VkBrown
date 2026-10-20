<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkLongPollException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\EndpointHelper;
use Haikiri\VkBrown\Objects\LongPollServer;
use Haikiri\VkBrown\Objects\Update;
use InvalidArgumentException;

final class LongPollService
{

	private ?LongPollServer $session = null;
	private ?string $timestamp = null;

	public function __construct(
		private readonly ApiRequestService $api,
		private readonly HttpTransport     $transport,
		private readonly UpdateHydrator    $hydrator,
		private readonly int               $groupId,
	)
	{
	}

	/**
	 * Получаем очередную порцию событий, сохраняя адрес сервера, ключ и позицию чтения.
	 * Истёкший ключ обновляем через groups.getLongPollServer, сохраняя ts. При утрате истории
	 * обновляем сессию по протоколу и сообщаем об этом исключением вместо скрытого пропуска событий.
	 * @param int|string|null $offset Явная позиция чтения; null продолжает текущую сессию.
	 * @param int $wait Ожидание новых событий, от 0 до 90 секунд.
	 * @return list<Update> События с полным конвертом VK; пустой список при отсутствии событий или обновлении ключа.
	 * @throws VkLongPollException История утрачена (код 1/3) или получен неизвестный failed.
	 * @throws VkResponseException VK вернул некорректные поля или события другого сообщества.
	 * @throws InvalidArgumentException Неверный wait или offset.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function poll(int|string|null $offset, int $wait): array
	{
		if ($wait < 0 || $wait > 90) {
			throw new InvalidArgumentException("wait должен находиться в диапазоне 0..90.");
		}

		if ($offset !== null && !preg_match('/^\d+$/D', (string)$offset)) {
			throw new InvalidArgumentException("ts должен быть неотрицательным целым числом.");
		}

		if ($this->session === null) $this->renew(false);
		if ($offset !== null) $this->timestamp = (string)$offset;

		$options = $this->api->getRequestOptions();
		$options["timeout"] = $wait + 10;
		$options["headers"] = null;
		$options["auth"] = null;
		$options["query"] = ["act" => "a_check", "key" => $this->session->getKey(), "ts" => $this->timestamp, "wait" => $wait];
		$body = $this->transport->request("GET", $this->session->getServer(), $options);

		# `failed` - часть протокола сессии. Сетевые ошибки не повторяем и не сбрасываем курсор.
		if (array_key_exists("failed", $body)) {
			if (!is_int($body["failed"])) {
				throw new VkResponseException("Поле failed Long Poll должно быть целым числом.");
			}

			switch ($body["failed"]) {
				case 1:
					$this->timestamp = self::timestamp($body["ts"] ?? null);
					throw new VkLongPollException(
						message: "История событий Long Poll устарела или была частично утрачена.",
						code: 1,
						details: [
							"ts" => $this->timestamp,
						],
					);
				case 2:
					$this->renew(true);
					return [];
				case 3:
					$this->renew(false);
					throw new VkLongPollException(
						message: "История событий Long Poll утрачена; получена новая сессия.",
						code: 3,
						details: [
							"ts" => $this->timestamp,
						],
					);
				default:
					throw new VkLongPollException("Неизвестная ошибка сессии Long Poll.", $body["failed"]);
			}
		}

		$nextTimestamp = self::timestamp($body["ts"] ?? null);
		if (!is_array($body["updates"] ?? null) || !array_is_list($body["updates"])) {
			throw new VkResponseException("В ответе Long Poll отсутствует список updates.");
		}

		$updates = [];
		foreach ($body["updates"] as $data) {
			if (!is_array($data)) {
				throw new VkResponseException("Элемент updates должен быть объектом события.");
			}

			$update = $this->hydrator->hydrate($data);
			if ($update->getGroupId() !== $this->groupId) {
				throw new VkResponseException("Long Poll вернул событие другого сообщества.");
			}

			$updates[] = $update;
		}

		# Не продвигаем курсор, если хотя бы одно событие не удалось разобрать.
		$this->timestamp = $nextTimestamp;
		return $updates;
	}

	/**
	 * Получаем последнюю обработанную позицию чтения для сохранения между запусками.
	 * До открытия сессии позиция отсутствует.
	 * @return string|null Текущий ts.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function getTimestamp(): ?string
	{
		return $this->timestamp;
	}

	/**
	 * Получаем новую сессию, не изменяя подписки и настройки сообщества.
	 * Адрес и ключ заменяем только после проверки всех обязательных полей ответа.
	 * @param bool $keepTimestamp Сохранить прежний ts при failed=2.
	 * @return void
	 * @throws VkResponseException Неполные данные сессии или небезопасный адрес сервера.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollServer
	 */
	private function renew(bool $keepTimestamp): void
	{
		$session = ResponseHydrator::model(
			response: $this->api->request(method: "groups.getLongPollServer", params: ["group_id" => $this->groupId]),
			class: LongPollServer::class,
		);
		EndpointHelper::validate($session->getServer());

		if ($session->getKey() === "") throw new VkResponseException("Сессия Long Poll не содержит ключ.");
		$timestamp = self::timestamp($session->getTs());
		$this->session = $session;

		if (!$keepTimestamp) $this->timestamp = $timestamp;
	}

	/**
	 * Нормализуем позицию Long Poll, учитывая числовой ts в ответе failed=1.
	 * Обычные ответы используют строку; позиция не приводится к int, чтобы не зависеть от разрядности.
	 * @param mixed $value Значение поля ts.
	 * @return string Неотрицательное десятичное число.
	 * @throws VkResponseException Поле отсутствует или нарушает контракт.
	 */
	private static function timestamp(mixed $value): string
	{
		if ((!is_int($value) && !is_string($value)) || !preg_match('/^\d+$/D', (string)$value)) {
			throw new VkResponseException("Long Poll вернул некорректный ts.");
		}

		return (string)$value;
	}

}
