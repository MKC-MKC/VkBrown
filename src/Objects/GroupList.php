<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupList extends ResponseWrapper
{

	/**
	 * Объекты сообществ.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Group> Значение поля groups.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getById
	 */
	public function getGroups(): array
	{
		return $this->objects("groups", Group::class);
	}

	/**
	 * Дополнительные объекты пользователей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<User> Значение поля profiles.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getById
	 */
	public function getProfiles(): array
	{
		return $this->objects("profiles", User::class);
	}

}
