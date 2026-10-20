<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Conversation extends ResponseWrapper
{

	/**
	 * Назначение диалога: идентификатор, тип и local_id.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Peer|null Значение поля peer.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getPeer(): ?Peer
	{
		return $this->object("peer", Peer::class);
	}

	/**
	 * Идентификатор последнего прочитанного входящего сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля in_read.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getInRead(): int|null
	{
		return $this->read("in_read", "integer");
	}

	/**
	 * Идентификатор последнего прочитанного исходящего сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля out_read.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getOutRead(): int|null
	{
		return $this->read("out_read", "integer");
	}

	/**
	 * Количество непрочитанных сообщений.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля unread_count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getUnreadCount(): int|null
	{
		return $this->read("unread_count", "integer");
	}

	/**
	 * Отмечен ли диалог или сообщение как важное.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля important.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function isImportant(): bool|null
	{
		return $this->read("important", "boolean");
	}

	/**
	 * Помечена ли беседа как неотвеченная.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля unanswered.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function isUnanswered(): bool|null
	{
		return $this->read("unanswered", "boolean");
	}

	/**
	 * Настройки уведомлений диалога.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля push_settings.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getPushSettings(): array|null
	{
		return $this->read("push_settings", "array");
	}

	/**
	 * Информация о возможности писать сообщения в диалог.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля can_write.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getCanWrite(): array|null
	{
		return $this->read("can_write", "array");
	}

	/**
	 * Настройки беседы: название, фотография, участники и доступные действия.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля chat_settings.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getChatSettings(): array|null
	{
		return $this->read("chat_settings", "array");
	}

	/**
	 * Текущая клавиатура в диалоге.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Keyboard|null Значение поля current_keyboard.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation
	 */
	public function getCurrentKeyboard(): ?Keyboard
	{
		return $this->object("current_keyboard", Keyboard::class);
	}

}
