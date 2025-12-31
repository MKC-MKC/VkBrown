<?php

namespace Haikiri\VkBrown\Exceptions;

use RuntimeException;

class VkUserDisabledException extends RuntimeException
{

	# Страница пользователя была удалена или заблокирована
	public function __construct(string $message = "Страница удалена или заблокирована.", int $code = 18)
	{
		parent::__construct($message, $code);
	}

}
