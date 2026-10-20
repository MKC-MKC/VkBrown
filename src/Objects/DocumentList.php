<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class DocumentList extends ResponseWrapper
{

	/**
	 * Число результатов.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.search
	 */
	public function getCount(): int|null
	{
		return $this->read("count", "integer");
	}

	/**
	 * Элементы результата в порядке, возвращённом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Document> Значение поля items.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.search
	 */
	public function getItems(): array
	{
		return $this->objects("items", Document::class);
	}

}
