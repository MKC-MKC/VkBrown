<?php

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

/**
 * События в сообществах
 * @see https://dev.vk.com/ru/api/community-events/json-schema#message_event
 */
readonly class MessageEvent extends ResponseWrapper
{

	/**
	 * Случайная строка.
	 * Активна в течение минуты, спустя минуту становится недействительной.
	 * @return string
	 */
	public function getEventId(): string
	{
		return (string)$this->getData("event_id");
	}

	/**
	 * Идентификатор пользователя.
	 * @return int
	 */
	public function getUserId(): int
	{
		return (int)$this->getData("user_id");
	}

	/**
	 * Идентификатор диалога со стороны бота.
	 * @return int
	 */
	public function getPeerId(): int
	{
		return (int)$this->getData("peer_id");
	}

	/**
	 * Дополнительная информация, указанная в клавише.
	 * @return array|mixed
	 */
	public function getPayload(): mixed
	{
		return $this->getData("payload");
	}

	/**
	 * Идентификатор сообщения в беседе. Не передаётся для клавиатур беседы.
	 * @return int|null
	 */
	public function getConversationMessageId(): int|null
	{
		return (int)$this->getData("conversation_message_id");
	}

}
