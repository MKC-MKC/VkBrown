<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ChatPhoto extends ResponseWrapper
{

	/**
	 * Глобальный идентификатор сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.setChatPhoto
	 */
	public function getMessageId(): int|null
	{
		return $this->read("message_id", "integer");
	}

	/**
	 * Данные беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Chat|null Значение поля chat.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.setChatPhoto
	 */
	public function getChat(): ?Chat
	{
		return $this->object("chat", Chat::class);
	}

}
