<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Attachment extends ResponseWrapper
{

	/**
	 * Тип объекта или действия согласно контракту метода VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Информация о фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Photo|null Значение поля photo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getPhoto(): ?Photo
	{
		return $this->object("photo", Photo::class);
	}

	/**
	 * Прикреплённый документ.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Document|null Значение поля doc.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getDoc(): ?Document
	{
		return $this->object("doc", Document::class);
	}

	/**
	 * Прикреплённая аудиозапись.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Audio|null Значение поля audio.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getAudio(): ?Audio
	{
		return $this->object("audio", Audio::class);
	}

	/**
	 * Прикреплённая видеозапись.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Video|null Значение поля video.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getVideo(): ?Video
	{
		return $this->object("video", Video::class);
	}

	/**
	 * Прикреплённое голосовое сообщение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return AudioMessage|null Значение поля audio_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getAudioMessage(): ?AudioMessage
	{
		return $this->object("audio_message", AudioMessage::class);
	}

	/**
	 * Ссылка, возвращённая методом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Link|null Значение поля link.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getLink(): ?Link
	{
		return $this->object("link", Link::class);
	}

	/**
	 * Прикреплённый стикер.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Sticker|null Значение поля sticker.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getSticker(): ?Sticker
	{
		return $this->object("sticker", Sticker::class);
	}

	/**
	 * Прикреплённая запись на стене.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return WallPost|null Значение поля wall.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getWall(): ?WallPost
	{
		return $this->object("wall", WallPost::class);
	}

	/**
	 * Прикреплённый комментарий на стене.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return WallComment|null Значение поля wall_reply.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getWallReply(): ?WallComment
	{
		return $this->object("wall_reply", WallComment::class);
	}

}
