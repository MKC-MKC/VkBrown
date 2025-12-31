<?php

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

/**
 * Keyboard
 * Клавиатура чат-бота — блок с кнопками, которые показываются на экране ввода сообщения.
 * Они упрощают и ускоряют общение: пользователи могут отправить сообщение или запрос, не печатая текст.
 * @see https://dev.vk.ru/ru/reference/objects/keyboard
 */
readonly class Keyboard extends ResponseWrapper
{

	/**
	 * Флаг, скрывать клавиатуру после нажатия или нет.
	 */
	public function isOneTime(): bool
	{
		return (bool)$this->getData("one_time", false);
	}

	/**
	 * Клавиатура показана внутри сообщения (true) или под ним (false).
	 */
	public function isInline(): bool
	{
		return (bool)$this->getData("inline", false);
	}

	/**
	 * Идентификатор автора клавиатуры (сообщество или бот).
	 */
	public function getAuthorId(): int|null
	{
		return $this->getData("author_id");
	}

	/**
	 * Массив строк с кнопками.
	 * @return array
	 */
	public function getButtons(): array
	{
		return (array)$this->getData("buttons", []);
	}

}
