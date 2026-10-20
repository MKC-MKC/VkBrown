<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class UploadDocument extends ResponseWrapper
{

	/**
	 * Служебное значение file, возвращённое сервером загрузки и необходимое для docs.save.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля file.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function getFile(): string
	{
		return $this->required("file", "string");
	}

}
