<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Traits\DateTimeTrait;
use Haikiri\VkBrown\Objects\Traits\MessagePayloadTrait;
use Haikiri\VkBrown\Objects\Traits\PayloadActionTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Message extends ResponseWrapper
{

	use MessagePayloadTrait;
	use PayloadActionTrait;
	use DateTimeTrait;

	/**
	 * Идентификатор сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Время отправки в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Идентификатор назначения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля peer_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getPeerId(): int|null
	{
		return $this->read("peer_id", "integer");
	}

	/**
	 * Идентификатор отправителя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля from_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getFromId(): int|null
	{
		return $this->read("from_id", "integer");
	}

	/**
	 * Текст сообщения, записи или комментария.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля text.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getText(): string|null
	{
		return $this->read("text", "string");
	}

	/**
	 * Идентификатор, используемый при отправке сообщения. Возвращается только для исходящих сообщений.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля random_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getRandomId(): int|null
	{
		return $this->read("random_id", "integer");
	}

	/**
	 * Произвольный параметр для работы с источниками переходов .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля ref.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getRef(): string|null
	{
		return $this->read("ref", "string");
	}

	/**
	 * Произвольный параметр для работы с источниками переходов .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля ref_source.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getRefSource(): string|null
	{
		return $this->read("ref_source", "string");
	}

	/**
	 * Медиавложения сообщения (фотографии, ссылки и т.п.). Описание массива attachments находится на
	 * отдельной странице .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Attachment> Значение поля attachments.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getAttachments(): array
	{
		return $this->objects("attachments", Attachment::class);
	}

	/**
	 * true , если сообщение помечено как важное.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля important.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function isImportant(): bool|null
	{
		return $this->read("important", "boolean");
	}

	/**
	 * Информация о местоположении .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля geo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getGeo(): array|null
	{
		return $this->read("geo", "array");
	}

	/**
	 * Объект клавиатуры для ботов.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Keyboard|null Значение поля keyboard.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getKeyboard(): ?Keyboard
	{
		return $this->object("keyboard", Keyboard::class);
	}

	/**
	 * Массив пересланных сообщений (если есть). Максимальное количество элементов - 100 . Максимальная
	 * глубина вложенности для пересланных сообщений - 45 , общее максимальное количество в цепочке с учетом
	 * вложенности - 500 .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Message> Значение поля fwd_messages.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getFwdMessages(): array
	{
		return $this->objects("fwd_messages", Message::class);
	}

	/**
	 * Сообщение, в ответ на которое отправлено текущее.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Message|null Значение поля reply_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getReplyMessage(): ?Message
	{
		return $this->object("reply_message", Message::class);
	}

	/**
	 * Информация о сервисном действии с чатом. Объект, который содержит поля: • type ( string ) - тип
	 * действия. Возможные значения: • chat_photo_update - обновлена фотография беседы; • chat_photo_remove -
	 * удалена фотография беседы; • chat_create - создана беседа; • chat_title_update - обновлено название
	 * беседы; • chat_invite_user - приглашен пользователь; • chat_kick_user - исключен пользователь; •
	 * chat_pin_message - закреплено сообщение; • chat_unpin_message - откреплено сообщение; •
	 * chat_invite_user_by_link - пользователь присоединился к беседе по ссылке. • member_id ( integer ) -
	 * идентификатор пользователя (если > 0) или email (если < 0), которого пригласили или исключили (для
	 * служебных сообщений с type = chat_invite_user или chat_kick_user ). Идентификатор пользователя,
	 * который закрепил/открепил сообщение для action = chat_pin_message или chat_unpin_message . • text (
	 * string ) - название беседы (для служебных сообщений с type = chat_create или chat_title_update ). •
	 * email ( string ) - email, который пригласили или исключили (для служебных сообщений с type =
	 * chat_invite_user или chat_kick_user и отрицательным member_id ). • photo ( object ) -
	 * изображение-обложка чата. Объект, который содержит поля: • photo_50 ( string ) - URL изображения
	 * 50x50px; • photo_100 ( string ) - URL изображения 100x100px; • photo_200 ( string ) - URL изображения
	 * 200x200px;
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля action.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getAction(): array|null
	{
		return $this->read("action", "array");
	}

	/**
	 * Только для сообщений сообщества. Содержит идентификатор пользователя (администратора сообщества),
	 * отправившего это сообщение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля admin_author_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getAdminAuthorId(): int|null
	{
		return $this->read("admin_author_id", "integer");
	}

	/**
	 * Уникальный автоматически увеличивающийся номер для всех сообщений с этим peer.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля conversation_message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getConversationMessageId(): int|null
	{
		return $this->read("conversation_message_id", "integer");
	}

	/**
	 * Это сообщение обрезано для бота.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_cropped.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function isCropped(): bool|null
	{
		return $this->read("is_cropped", "boolean");
	}

	/**
	 * Количество участников.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля members_count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getMembersCount(): int|null
	{
		return $this->read("members_count", "integer");
	}

	/**
	 * Дата, когда сообщение было обновлено в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля update_time.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getUpdateTime(): int|null
	{
		return $this->read("update_time", "integer");
	}

	/**
	 * Было ли вложенное аудиосообщение уже прослушано вами.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля was_listened.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function isWasListened(): bool|null
	{
		return $this->read("was_listened", "boolean");
	}

	/**
	 * Дата, когда сообщение было закреплено в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля pinned_at.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getPinnedAt(): int|null
	{
		return $this->read("pinned_at", "integer");
	}

	/**
	 * Тип сообщения ( 0 - полученное, 1 - отправленное, не возвращается для пересланных сообщений).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля out.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function isOut(): bool|null
	{
		return $this->read("out", "boolean");
	}

	/**
	 * Удалено ли сообщение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля deleted.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function isDeleted(): bool|null
	{
		return $this->read("deleted", "boolean");
	}

	/**
	 * Версия данных объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля version.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getVersion(): int|null
	{
		return $this->read("version", "integer");
	}

	/**
	 * Информация о форматировании текста сообщения. Объект, который содержит поля: • version ( string ) -
	 * версия форматирования. • items ( array ) - массив объектов с параметрами форматирования: • offset (
	 * integer ) - позиция символа, начиная с которого применяется указанный тип форматирования. • length (
	 * integer ) - количество символов, на которые распространяется указанный тип форматирования. • type (
	 * string ) - тип форматирования, примененный к диапазону символов. Возможные значения: • bold -
	 * полужирный. • italic - курсив. • url - ссылка. • underline - подчеркнутый. • url ( string ) - адрес
	 * ссылки, если в type указан тип url . За единицу диапазона принимается символ в кодировке UTF-16.
	 * Обратите внимание: некоторые объекты, например эмодзи, могут занимать несколько символов в UTF-16.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return FormatData|null Значение поля format_data.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getFormatData(): ?FormatData
	{
		return $this->object("format_data", FormatData::class);
	}

}
