<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Exceptions;

class VkLongPollException extends VkMainException
{
	/**
	 * Получаем позицию продолжения после утраты истории событий.
	 *
	 * При failed=1/3 сессия уже обновлена по протоколу VK. Следующий getUpdates() продолжит с этой позиции.
	 * @return string|null Новый ts, если VK позволил восстановить сессию.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function getTimestamp(): ?string
	{
		return $this->getDetails()["ts"] ?? null;
	}
}
