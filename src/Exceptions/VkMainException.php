<?php

namespace Haikiri\VkBrown\Exceptions;

use LogicException;

class VkMainException extends LogicException
{

	public function __construct(string $message = "Произошла неизвестная ошибка.", int $code = 1)
	{
		parent::__construct($message, $code);
	}

}
