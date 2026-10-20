<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupBans extends ResponseWrapper
{

	/**
	 * Число результатов.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getCount(): int|null
	{
		return $this->read("count", "integer");
	}

	/**
	 * Элементы результата в порядке, возвращённом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<GroupBan> Значение поля items.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getItems(): array
	{
		return $this->objects("items", GroupBan::class);
	}

}
