<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class FormatItem extends ResponseWrapper
{

	/**
	 * Позиция в символах UTF-16.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля offset.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getOffset(): int|null
	{
		return $this->read("offset", "integer");
	}

	/**
	 * Длина диапазона в символах UTF-16.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля length.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getLength(): int|null
	{
		return $this->read("length", "integer");
	}

	/**
	 * Тип объекта или действия согласно контракту метода VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
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
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getUrl(): string|null
	{
		return $this->read("url", "string");
	}

}
