<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class UploadServer extends ResponseWrapper
{

	/**
	 * Адрес, по которому необходимо передать файл.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля upload_url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.getMessagesUploadServer
	 */
	public function getUploadUrl(): string
	{
		return $this->required("upload_url", "string");
	}

	/**
	 * Идентификатор альбома фотографии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля album_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.getMessagesUploadServer
	 */
	public function getAlbumId(): int|null
	{
		return $this->read("album_id", "integer");
	}

	/**
	 * Идентификатор пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля user_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.getMessagesUploadServer
	 */
	public function getUserId(): int|null
	{
		return $this->read("user_id", "integer");
	}

}
