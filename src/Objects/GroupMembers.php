<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupMembers extends ResponseWrapper
{

	public function __construct(array $response, private string $mode = "ids")
	{
		parent::__construct($response);
	}

	/**
	 * Получаем общее число участников, соответствующих фильтру запроса.
	 *
	 * Это количество не ограничивается числом элементов текущей страницы.
	 * @return int Значение count.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getCount(): int
	{
		return $this->required("count", "integer");
	}

	/**
	 * Получаем участников в формате, который был запрошен у VK.
	 *
	 * Без fields и filter=managers возвращаются ID. С fields возвращаются пользователи,
	 * а filter=managers без fields возвращает объекты id/role.
	 * @return list<int>|list<User>|list<GroupMember> Элементы текущей страницы.
	 * @throws VkResponseException Элемент не соответствует запрошенному формату.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getItems(): array
	{
		if ($this->mode === "profiles") return $this->objects("items", User::class);
		if ($this->mode === "roles") return $this->objects("items", GroupMember::class);
		$items = $this->required("items", "array");
		foreach ($items as $item) {
			if (!is_int($item)) throw new VkResponseException("Ожидался целочисленный ID участника сообщества.");
		}
		return $items;
	}

	/**
	 * Получаем указатель следующей страницы, если VK использует пагинацию через next_from.
	 *
	 * Отсутствующее поле не заменяем числом или вычисленным смещением.
	 * @return string|null Значение next_from.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getNextFrom(): ?string
	{
		return $this->read("next_from", "string");
	}

}
