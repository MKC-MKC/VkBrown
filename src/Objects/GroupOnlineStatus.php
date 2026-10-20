<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupOnlineStatus extends ResponseWrapper
{

	/**
	 * Статус сообщества: online, offline или none.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля status.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getOnlineStatus
	 */
	public function getStatus(): string|null
	{
		return $this->read("status", "string");
	}

	/**
	 * Период статуса онлайн в минутах.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля minutes.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getOnlineStatus
	 */
	public function getMinutes(): int|null
	{
		return $this->read("minutes", "integer");
	}

}
