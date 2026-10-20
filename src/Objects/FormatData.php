<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class FormatData extends ResponseWrapper
{

	/**
	 * Версия формата разметки текста сообщения, например 1.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля version.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getVersion(): string|null
	{
		return $this->read("version", "string");
	}

	/**
	 * Элементы результата в порядке, возвращённом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<FormatItem> Значение поля items.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
	 */
	public function getItems(): array
	{
		return $this->objects("items", FormatItem::class);
	}

}
