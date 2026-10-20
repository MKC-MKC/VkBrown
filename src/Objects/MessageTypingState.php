<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class MessageTypingState extends ResponseWrapper
{

	/**
	 * Идентификатор отправителя или автора; отрицательное значение обозначает сообщество.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля from_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_typing_state
	 */
	public function getFromId(): int|null
	{
		return $this->read("from_id", "integer");
	}

	/**
	 * Идентификатор назначения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля to_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_typing_state
	 */
	public function getToId(): int|null
	{
		return $this->read("to_id", "integer");
	}

	/**
	 * Состояние набора сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля state.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_typing_state
	 */
	public function getState(): string|null
	{
		return $this->read("state", "string");
	}

}
