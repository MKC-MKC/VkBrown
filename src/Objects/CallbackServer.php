<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class CallbackServer extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Название объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Идентификатор создателя сервера Callback.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля creator_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getCreatorId(): int|null
	{
		return $this->read("creator_id", "integer");
	}

	/**
	 * URL объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getUrl(): string|null
	{
		return $this->read("url", "string");
	}

	/**
	 * Статус объекта, возвращённый VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля status.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getStatus(): string|null
	{
		return $this->read("status", "string");
	}

}
