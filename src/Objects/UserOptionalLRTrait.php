<?php

namespace Haikiri\VkBrown\Objects;

trait UserOptionalLRTrait
{

	/**
	 * Девичья фамилия.
	 * @return string|null
	 * @see https://dev.vk.ru/ru/reference/objects/user#maiden_name
	 */
	public function getMaidenName(): string|null
	{
		return $this->getData("maiden_name");
	}

	/**
	 * Никнейм (отчество) пользователя.
	 * @return string|null
	 * @see https://dev.vk.ru/ru/reference/objects/user#nickname
	 */
	public function getNickname(): string|null
	{
		return $this->getData("nickname");
	}

	/**
	 * Информация о том, находится ли пользователь сейчас на сайте.
	 * @return bool
	 * @see https://dev.vk.ru/ru/reference/objects/user#online
	 */
	public function getOnline(): bool
	{
		return (bool)$this->getData("online", false);
	}

	/**
	 * Если пользователь использует мобильное приложение либо мобильную версию, возвращается true.
	 * @return bool
	 * @see https://dev.vk.ru/ru/reference/objects/user#online
	 * TODO: проверить дичь
	 */
	public function getOnlineMobile(): mixed
	{
		return $this->getData("online_mobile");
	}

	/**
	 * Если используется именно приложение, дополнительно возвращается поле online_app, содержащее его идентификатор.
	 * @return bool
	 * @see https://dev.vk.ru/ru/reference/objects/user#online
	 * TODO: проверить дичь
	 */
	public function getOnlineMobileApp(): mixed
	{
		return $this->getData("online_app");
	}

}
