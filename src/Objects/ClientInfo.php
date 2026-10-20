<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ClientInfo extends ResponseWrapper
{

	/**
	 * Типы действий кнопок, поддерживаемые клиентом пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля button_actions.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function getButtonActions(): array|null
	{
		return $this->read("button_actions", "array");
	}

	/**
	 * Поддерживает ли клиент клавиатуры ботов.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля keyboard.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function isKeyboard(): bool|null
	{
		return $this->read("keyboard", "boolean");
	}

	/**
	 * Поддерживает ли клиент inline-клавиатуру.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля inline_keyboard.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function isInlineKeyboard(): bool|null
	{
		return $this->read("inline_keyboard", "boolean");
	}

	/**
	 * Поддерживает ли клиент пользователя карусель.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля carousel.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function isCarousel(): bool|null
	{
		return $this->read("carousel", "boolean");
	}

	/**
	 * Идентификатор языка клиента пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля lang_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function getLangId(): int|null
	{
		return $this->read("lang_id", "integer");
	}

}
