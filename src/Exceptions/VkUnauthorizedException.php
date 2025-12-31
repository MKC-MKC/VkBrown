<?php

namespace Haikiri\VkBrown\Exceptions;

use RuntimeException;

class VkUnauthorizedException extends RuntimeException
{

	public function __construct(string $message = "Авторизация пользователя не удалась.", int $code = 5)
	{
		parent::__construct($message, $code);
	}

}
