<?php

namespace Haikiri\VkBrown\Objects;

use DateTime;
use Exception;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Message extends ResponseWrapper
{

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	public function getDate(): DateTime|null
	{
		try {
			return new DateTime("@{$this->getData("date", 0)}");
		} catch (Exception) {
			return null;
		}
	}

	public function getPeerId(): int
	{
		return (int)$this->getData("peer_id");
	}

	public function getFromId(): int
	{
		return (int)$this->getData("from_id");
	}

	public function getMessageText(): string
	{
		return (string)$this->getData("text", "");
	}

	/**
	 * Информация о форматировании текста сообщения.
	 * @return FormatData
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getFormatData(): object
	{
		$data = (array)$this->getData("format_data", []);
		return new FormatData($data);
	}

	/**
	 * Идентификатор, используемый при отправке сообщения. Возвращается только для исходящих сообщений.
	 */
	public function getRandomId()
	{
		return $this->getData("random_id");
	}

	/**
	 * Сервисное поле для сообщений ботам (полезная нагрузка).
	 * @return string
	 */
	public function getPayload(): string
	{
		return (string)$this->getData("payload");
	}

	/**
	 * Возвращает объект клавиатуры для ботов.
	 * @return Keyboard
	 * @see https://dev.vk.ru/ru/reference/objects/message#keyboard
	 */
	public function getKeyboard(): object
	{
		$data = (array)$this->getData("keyboard", []);
		return new Keyboard($data);
	}

	/**
	 * Массив пересланных сообщений (если есть).
	 * Максимальное количество элементов — 100.
	 * Максимальная глубина вложенности для пересланных сообщений — 45.
	 * Общее максимальное количество в цепочке с учетом вложенности — 500.
	 * @return Message[]
	 * @see https://dev.vk.ru/ru/reference/objects/message#fwd_messages%C2%A0
	 */
	public function getForwardMessages(): array
	{
		$data = (array)$this->getData("fwd_messages", []);
		return array_map(static fn(array $item): Message => new Message($item), $data);
	}

	/**
	 * Сообщение, в ответ на которое отправлено текущее.
	 * @return Message
	 */
	public function getReplyMessage(): object
	{
		$data = (array)$this->getData("reply_message", []);
		return new Message($data);
	}

	public function getAdminAuthorId(): int|null
	{
		return $this->getData("admin_author_id");
	}

	public function getConversationMessageId(): int|null
	{
		return (int)$this->getData("conversation_message_id");
	}

	public function getAttachments(): array
	{
		return (array)$this->getData("attachments", []);
	}

	public function isHidden(): bool
	{
		return (bool)$this->getData("is_hidden");
	}

	public function isImportant(): bool
	{
		return (bool)$this->getData("important");
	}

	public function isOut(): int
	{
		return (int)$this->getData("out");
	}

	public function getVersion(): int|null
	{
		return (int)$this->getData("version");
	}

	public function isDeleted(): bool
	{
		return (bool)$this->getData("deleted", false);
	}

}
