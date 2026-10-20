<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Exceptions;

use RuntimeException;

class VkMainException extends RuntimeException
{
	public function __construct(string $message, int $code = 0, private readonly array $details = [])
	{
		parent::__construct($message, $code);
	}

	/**
	 * Получаем дополнительные поля ошибки VK: captcha_sid, captcha_img, redirect_uri и другие.
	 *
	 * Код ошибки доступен через getCode(). Секреты исключаются при разборе ответа.
	 * @return array<string, mixed> Дополнительные сведения, полученные от API.
	 * @see https://dev.vk.ru/ru/reference/errors
	 */
	public function getDetails(): array
	{
		return $this->details;
	}
}
