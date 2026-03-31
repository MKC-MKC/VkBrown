<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

/**
 * FormatData
 * Объект с информацией о форматировании текста сообщения.
 * @see https://dev.vk.ru/ru/reference/objects/message#format_data
 */
readonly class FormatData extends ResponseWrapper
{

	/**
	 * Возвращает версию схемы форматирования сообщения.
	 * Это поле приходит в объекте `format_data` ответа VK.
	 * @return string
	 */
	public function getVersion(): string
	{
		return (string)$this->getData("version", "");
	}

	/**
	 * Возвращает сырой список правил форматирования сообщения.
	 * Каждый элемент массива содержит параметры конкретного форматирования:
	 * смещение, длину и тип оформления текста.
	 * @return array
	 */
	public function getItems(): array
	{
		return (array)$this->getData("items", []);
	}

}
