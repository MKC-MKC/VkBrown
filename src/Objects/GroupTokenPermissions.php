<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupTokenPermissions extends ResponseWrapper
{

	/**
	 * Битовая маска прав ключа доступа сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля mask.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTokenPermissions
	 */
	public function getMask(): int|null
	{
		return $this->read("mask", "integer");
	}

	/**
	 * Список разрешений ключа доступа.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля permissions.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTokenPermissions
	 */
	public function getPermissions(): array|null
	{
		return $this->read("permissions", "array");
	}

}
