<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class HistoryAttachment extends ResponseWrapper
{

	/**
	 * Вложение из истории сообщений.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Attachment|null Значение поля attachment.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getAttachment(): ?Attachment
	{
		return $this->object("attachment", Attachment::class);
	}

	/**
	 * Время создания или отправки в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Глобальный идентификатор сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getMessageId(): int|null
	{
		return $this->read("message_id", "integer");
	}

	/**
	 * Идентификатор сообщения внутри диалога, conversation_message_id.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля cmid.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getCmid(): int|null
	{
		return $this->read("cmid", "integer");
	}

	/**
	 * Идентификатор отправителя или автора; отрицательное значение обозначает сообщество.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля from_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getFromId(): int|null
	{
		return $this->read("from_id", "integer");
	}

	/**
	 * Уровень вложенности пересланного сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля forward_level.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getForwardLevel(): int|null
	{
		return $this->read("forward_level", "integer");
	}

	/**
	 * Прослушано ли голосовое сообщение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля was_listened.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function isWasListened(): bool|null
	{
		return $this->read("was_listened", "boolean");
	}

	/**
	 * Позиция вложения внутри сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля position.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getPosition(): int|null
	{
		return $this->read("position", "integer");
	}

	/**
	 * Время жизни исчезающего сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля message_expire_ttl.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getMessageExpireTtl(): int|null
	{
		return $this->read("message_expire_ttl", "integer");
	}

}
