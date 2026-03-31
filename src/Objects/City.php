<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

/**
 * City
 * Объект города из данных пользователя.
 * @see https://dev.vk.ru/ru/reference/objects/user
 */
readonly class City extends ResponseWrapper
{

	/**
	 * Возвращает идентификатор города из ответа VK.
	 * @return int
	 */
	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	/**
	 * Возвращает название города из ответа VK.
	 * @return string
	 */
	public function getTitle(): string
	{
		return (string)$this->getData("title", "");
	}

}
