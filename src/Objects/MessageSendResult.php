<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class MessageSendResult extends ResponseWrapper
{

	/**
	 * Идентификатор назначения: пользователя, сообщества или беседы.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля peer_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function getPeerId(): int
	{
		return $this->required("peer_id", "integer");
	}

	/**
	 * Глобальный идентификатор сообщения.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function getMessageId(): int
	{
		return $this->required("message_id", "integer");
	}

	/**
	 * Уникальный автоматически увеличивающийся номер сообщения в этом диалоге.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля conversation_message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function getConversationMessageId(): int
	{
		return $this->required("conversation_message_id", "integer");
	}

	/**
	 * Ошибка доставки конкретному получателю; остальные результаты рассылки сохраняются.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля error.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function getError(): array|null
	{
		return $this->read("error", "array");
	}

}
