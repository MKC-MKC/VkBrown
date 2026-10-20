<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects\Traits;

trait UserStateTrait
{
	/**
	 * Проверяем, удалена ли страница пользователя.
	 * VK передаёт deactivated=deleted для удалённой страницы и banned для заблокированной.
	 * @return bool true только при значении deleted.
	 * @see https://dev.vk.ru/ru/reference/objects/user#deactivated
	 */
	public function isDeleted(): bool
	{
		return $this->getDeactivated() === "deleted";
	}

	/**
	 * Проверяем, заблокирована ли страница пользователя.
	 * Отсутствие поля deactivated не считаем блокировкой.
	 * @return bool true только при значении banned.
	 * @see https://dev.vk.ru/ru/reference/objects/user#deactivated
	 */
	public function isBanned(): bool
	{
		return $this->getDeactivated() === "banned";
	}
}
