<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\MessageSendResult;
use InvalidArgumentException;
use Random\RandomException;

final readonly class MessageService
{

	public function __construct(private ApiRequestService $api)
	{
	}

	/**
	 * Отправляем сообщение и выбираем документированный формат результата по способу адресации.
	 * `random_id` создаём один раз в диапазоне int32, если его не передал вызывающий код. При peer_ids
	 * сохраняем результат каждого адресата, включая частичную ошибку доставки.
	 * @param array<string, mixed> $params Параметры messages.send с исходными именами VK.
	 * @return int|list<MessageSendResult> ID сообщения или результаты для нескольких получателей.
	 * @throws InvalidArgumentException Не указан адресат или random_id выходит за пределы int32.
	 * @throws VkMainException Ошибка отправки или формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function send(array $params): int|array
	{
		$targets = array_intersect_key($params, array_flip(["peer_id", "peer_ids", "user_id", "user_ids", "domain", "chat_id"]));
		if (!array_filter($targets, static fn($value) => $value !== null && $value !== [] && $value !== "")) {
			throw new InvalidArgumentException("Необходимо указать получателя сообщения.");
		}

		try {
			$params["random_id"] ??= random_int(1, 2147483647);
		} catch (RandomException) {
			throw new VkMainException("Не удалось создать random_id сообщения.");
		}

		if ($params["random_id"] < -2147483648 || $params["random_id"] > 2147483647) {
			throw new InvalidArgumentException("random_id должен находиться в диапазоне int32.");
		}

		$response = $this->api->request("messages.send", $params);
		return isset($params["peer_ids"]) || isset($params["user_ids"])
			? ResponseHydrator::models($response, MessageSendResult::class)
			: ResponseHydrator::integer($response);
	}

}
