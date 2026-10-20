<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects\Traits;

trait PayloadActionTrait
{

	/**
	 * Получаем строковое поле action из произвольной полезной нагрузки кнопки.
	 *
	 * Поле задаётся ботом при создании клавиатуры и не является доверенным идентификатором команды.
	 * @return string|null Значение action, если бот передал строку в этом поле.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public function getPayloadAction(): ?string
	{
		$payload = $this->getPayload();
		$action = is_array($payload) ? ($payload["action"] ?? null) : null;

		return is_string($action) ? $action : null;
	}

}
