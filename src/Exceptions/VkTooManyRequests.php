<?php

namespace Haikiri\VkBrown\Exceptions;

use RuntimeException;

class VkTooManyRequests extends RuntimeException
{

	# Задайте больший интервал между вызовами или используйте метод execute.
	# Подробнее об ограничениях на частоту вызовов см. на странице vk.com/dev/api_requests.
	public function __construct(string $message = "Слишком много запросов в секунду.", int $code = 6)
	{
		parent::__construct($message, $code);
	}

}
