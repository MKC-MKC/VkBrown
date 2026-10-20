<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Peer extends ResponseWrapper
{

	/**
	 * Идентификатор диалога: пользователь, сообщество или беседа.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation#peer
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
	 * @see https://dev.vk.ru/ru/reference/objects/conversation#peer
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Локальный идентификатор назначения внутри своего типа peer.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля local_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/conversation#peer
	 */
	public function getLocalId(): int|null
	{
		return $this->read("local_id", "integer");
	}

}
