<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\AttachmentHelper;
use Haikiri\VkBrown\Objects\Traits\DateTimeTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Photo extends ResponseWrapper
{

	use DateTimeTrait;

	/**
	 * Идентификатор фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор владельца фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

	/**
	 * Идентификатор альбома, в котором находится фотография.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля album_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getAlbumId(): int|null
	{
		return $this->read("album_id", "integer");
	}

	/**
	 * Идентификатор пользователя, загрузившего фото (если фотография размещена в сообществе). Для
	 * фотографий, размещенных от имени сообщества, user_id = 100 .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля user_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getUserId(): int|null
	{
		return $this->read("user_id", "integer");
	}

	/**
	 * Текст описания фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля text.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getText(): string|null
	{
		return $this->read("text", "string");
	}

	/**
	 * Дата добавления в формате Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Ключ доступа к вложению. При наличии передаётся вместе с owner_id и id в attachment.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля access_key.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getAccessKey(): string|null
	{
		return $this->read("access_key", "string");
	}

	/**
	 * Массив с копиями изображения в разных размерах. Описание объекта находится на отдельной странице .
	 * Поле возвращается только при передаче параметра photo_sizes = 1 в запросе. Если параметр не передан,
	 * вместо поля sizes возвращаются поля, описанные ниже.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля sizes.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getSizes(): array
	{
		return $this->objects("sizes", PhotoSize::class);
	}

	/**
	 * Ширина изображения или видео в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля width.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getWidth(): int|null
	{
		return $this->read("width", "integer");
	}

	/**
	 * Высота изображения или видео в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля height.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getHeight(): int|null
	{
		return $this->read("height", "integer");
	}

	/**
	 * Есть ли отметки на фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля has_tags.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function hasTags(): bool|null
	{
		return $this->read("has_tags", "boolean");
	}

	/**
	 * Служебный хеш миниатюры фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля thumb_hash.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo
	 */
	public function getThumbHash(): string|null
	{
		return $this->read("thumb_hash", "string");
	}

	/**
	 * Формируем идентификатор вложения для параметра attachment.
	 *
	 * Сохраняем владельца объекта и access_key, если VK передал ключ доступа.
	 * @return string Тип, owner_id, id и необязательный access_key через подчёркивание.
	 * @throws VkResponseException Отсутствуют ID владельца или объекта.
	 * @see https://dev.vk.ru/ru/api/bots/development/messages/attachments
	 */
	public function getAttachment(): string
	{
		return AttachmentHelper::reference("photo", $this->getOwnerId(), $this->getId(), $this->getAccessKey());
	}

}
