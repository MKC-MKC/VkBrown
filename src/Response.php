<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

readonly class Response
{
	public function __construct(private mixed $data, private array $raw)
	{
	}

	/**
	 * Получаем результат выполнения API-метода из поля response.
	 *
	 * Число, строка, объект и массив сохраняют формат VK. Значения 0, false и [] не являются ошибкой.
	 * @return mixed Значение response без конверта и без потери вложенных полей.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function getData(): mixed
	{
		return $this->data;
	}

	/**
	 * Получаем полный декодированный ответ API, включая дополнительные поля конверта.
	 *
	 * Возвращаем исходную структуру response и другие поля, если VK их передал.
	 * @return array<string, mixed> Полный ответ сервера.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function getRaw(): array
	{
		return $this->raw;
	}

}
