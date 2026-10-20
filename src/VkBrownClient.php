<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Api\VersionRegistry;
use Haikiri\VkBrown\Enums\ApiVersion;
use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Update;
use Haikiri\VkBrown\Services\ResponseDecoder;
use Haikiri\VkBrown\Services\UpdateHydrator;
use LogicException;

class VkBrownClient extends VkBrownClientAbstract
{
	private ?Update $update = null;
	private readonly UpdateHydrator $hydrator;

	public function __construct(ApiVersion|string $version = ApiVersion::V5_199)
	{
		$this->hydrator = new UpdateHydrator(VersionRegistry::get($version));
	}

	/**
	 * Читаем JSON-объект входящего Callback-запроса из тела HTTP-запроса.
	 * Метод не печатает ответ и не подтверждает доставку. Полученный конверт передаётся в setUpdate.
	 * @return array<string, mixed> Полный входящий JSON-объект VK.
	 * @throws VkResponseException Тело пустое или содержит невалидный JSON.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function getResponse(): array
	{
		$body = file_get_contents("php://input");
		if ($body === false) throw new VkResponseException("Не удалось прочитать тело Callback-запроса.");
		return ResponseDecoder::decodeObject($body);
	}

	/**
	 * Записываем полный входящий конверт либо модель обновления, полученную Long Poll.
	 * Повторно проверяем версию и метаданные и для переданной модели Update.
	 * @param array<string, mixed>|Update $update Полное событие сообщества.
	 * @return static Клиент с новым текущим обновлением.
	 * @throws VkMainException Событие не соответствует выбранному контракту.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function setUpdate(array|Update $update): static
	{
		$this->update = $this->hydrator->hydrate($update instanceof Update ? $update->getAsArray() : $update);
		return $this;
	}

	/**
	 * Получаем текущее типизированное обновление для маршрутизации и чтения данных события.
	 * getType() возвращает enum, а getActualMessage() и getMessageEvent() - объекты своего типа события.
	 * @return Update Установленное событие VK.
	 * @throws LogicException Обновление ещё не установлено.
	 */
	public function getUpdate(): Update
	{
		return $this->update ?? throw new LogicException("Сначала установите событие VK через setUpdate().");
	}

}
