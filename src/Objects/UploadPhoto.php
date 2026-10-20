<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class UploadPhoto extends ResponseWrapper
{

	/**
	 * Идентификатор сервера, принявшего фотографию; передаётся в photos.saveMessagesPhoto.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля server.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.saveMessagesPhoto
	 */
	public function getServer(): int
	{
		return $this->required("server", "integer");
	}

	/**
	 * Служебная JSON-строка фотографии из ответа сервера загрузки; передаётся без повторного кодирования.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля photo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.saveMessagesPhoto
	 */
	public function getPhoto(): string
	{
		return $this->required("photo", "string");
	}

	/**
	 * Подпись результата загрузки, необходимая для сохранения фотографии.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля hash.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.saveMessagesPhoto
	 */
	public function getHash(): string
	{
		return $this->required("hash", "string");
	}

}
