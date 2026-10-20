<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupBan extends ResponseWrapper
{

	/**
	 * Тип объекта или действия согласно контракту метода VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Объект пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return User|null Значение поля profile.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getProfile(): ?User
	{
		return $this->object("profile", User::class);
	}

	/**
	 * Информация о сообществе.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Group|null Значение поля group.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getGroup(): ?Group
	{
		return $this->object("group", Group::class);
	}

	/**
	 * Информация о блокировке участника: время, причина и комментарий.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля ban_info.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getBanInfo(): array|null
	{
		return $this->read("ban_info", "array");
	}

}
