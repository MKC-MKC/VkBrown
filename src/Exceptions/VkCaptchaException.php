<?php

namespace Haikiri\VkBrown\Exceptions;

use RuntimeException;

class VkCaptchaException extends RuntimeException
{

	/**
	 * Процесс обработки этой ошибки подробно описан на отдельной странице.
	 * @see https://dev.vk.com/ru/api/captcha-error
	 * @param string $message
	 * @param int $code
	 */
	public function __construct(string $message = "Требуется ввод кода с картинки (Captcha).", int $code = 14)
	{
		parent::__construct($message, $code);
	}

}
