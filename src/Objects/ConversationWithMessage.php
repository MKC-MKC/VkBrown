<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ConversationWithMessage extends ResponseWrapper
{

	/**
	 * Данные диалога, включая peer и состояние прочтения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Conversation|null Значение поля conversation.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversations
	 */
	public function getConversation(): ?Conversation
	{
		return $this->object("conversation", Conversation::class);
	}

	/**
	 * Последнее сообщение диалога.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Message|null Значение поля last_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversations
	 */
	public function getLastMessage(): ?Message
	{
		return $this->object("last_message", Message::class);
	}

}
