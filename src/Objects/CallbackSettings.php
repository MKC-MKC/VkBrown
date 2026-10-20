<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class CallbackSettings extends ResponseWrapper
{

	/**
	 * Версия API, используемая для формирования событий.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля api_version.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackSettings
	 */
	public function getApiVersion(): string|null
	{
		return $this->read("api_version", "string");
	}

	/**
	 * Настройки уведомлений в формате название события: статус 0/1.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля events.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackSettings
	 */
	public function getEvents(): array|null
	{
		return $this->read("events", "array");
	}

}
