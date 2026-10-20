<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;

readonly class GroupMember extends User
{

	/**
	 * Роль участника сообщества: moderator, editor, administrator и другие значения VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля role.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getRole(): string|null
	{
		return $this->read("role", "string");
	}

	/**
	 * Список разрешений ключа доступа.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля permissions.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getPermissions(): array|null
	{
		return $this->read("permissions", "array");
	}

}
