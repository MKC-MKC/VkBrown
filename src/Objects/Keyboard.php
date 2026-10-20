<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Keyboard extends ResponseWrapper
{
	/**
	 * Определяем, скрывается ли клавиатура после нажатия.
	 *
	 * Настройка применима к обычной клавиатуре; при отсутствии поля VK использует false.
	 * @return bool Значение one_time.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public function isOneTime(): bool
	{
		return $this->read("one_time", "boolean") ?? false;
	}

	/**
	 * Определяем, расположена ли клавиатура внутри сообщения.
	 *
	 * false означает клавиатуру под полем ввода. Отсутствие inline имеет то же значение.
	 * @return bool Значение inline.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public function isInline(): bool
	{
		return $this->read("inline", "boolean") ?? false;
	}

	/**
	 * Получаем идентификатор автора клавиатуры, если VK включил его в сообщение.
	 *
	 * Это поле результата; оно не требуется при отправке новой клавиатуры.
	 * @return int|null Значение author_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/message
	 */
	public function getAuthorId(): ?int
	{
		return $this->read("author_id", "integer");
	}

	/**
	 * Получаем строки кнопок с исходными полями action и color.
	 *
	 * Payload каждой кнопки является JSON-строкой. Входящую клавиатуру не преобразуем в другую структуру.
	 * @return list<list<array>> Строки кнопок; пустой список означает снятую клавиатуру.
	 * @throws VkResponseException Отсутствует поле buttons или передан неверный тип.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public function getButtons(): array
	{
		return $this->required("buttons", "array");
	}
}
