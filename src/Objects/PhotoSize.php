<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class PhotoSize extends ResponseWrapper
{

	/**
	 * Тип объекта или действия согласно контракту метода VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo-sizes
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * URL объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo-sizes
	 */
	public function getUrl(): string|null
	{
		return $this->read("url", "string");
	}

	/**
	 * Ширина изображения или видео в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля width.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/photo-sizes
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
	 * @see https://dev.vk.ru/ru/reference/objects/photo-sizes
	 */
	public function getHeight(): int|null
	{
		return $this->read("height", "integer");
	}

}
