<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Chat extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Тип объекта или действия согласно контракту метода VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Название объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Идентификатор администратора беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля admin_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getAdminId(): int|null
	{
		return $this->read("admin_id", "integer");
	}

	/**
	 * Участники беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля users.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getUsers(): array|null
	{
		return $this->read("users", "array");
	}

	/**
	 * Настройки уведомлений диалога.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля push_settings.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getPushSettings(): array|null
	{
		return $this->read("push_settings", "array");
	}

	/**
	 * URL фотографии размером 50x50 пикселей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_50.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getPhoto50(): string|null
	{
		return $this->read("photo_50", "string");
	}

	/**
	 * URL фотографии размером 100x100 пикселей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_100.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getPhoto100(): string|null
	{
		return $this->read("photo_100", "string");
	}

	/**
	 * URL фотографии размером 200x200 пикселей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_200.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function getPhoto200(): string|null
	{
		return $this->read("photo_200", "string");
	}

	/**
	 * Покинул ли текущий участник беседу.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля left.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function isLeft(): bool|null
	{
		return $this->read("left", "boolean");
	}

	/**
	 * Исключён ли текущий участник из беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля kicked.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/chat
	 */
	public function isKicked(): bool|null
	{
		return $this->read("kicked", "boolean");
	}

}
