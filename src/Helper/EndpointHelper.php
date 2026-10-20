<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Helper;

use Haikiri\VkBrown\Exceptions\VkResponseException;

final class EndpointHelper
{

	/**
	 * Проверяем адрес загрузки или Long Poll, полученный от API VK.
	 *
	 * Такие адреса содержат собственные секреты в query; не включаем их в текст исключений.
	 * @param string $url Адрес HTTPS без встроенной HTTP-авторизации.
	 * @return void
	 * @throws VkResponseException Адрес имеет неверный формат, небезопасную схему или встроенные credentials.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function validate(string $url): void
	{
		$parts = parse_url($url);
		if (!is_array($parts) || ($parts["scheme"] ?? null) !== "https" || empty($parts["host"])
			|| isset($parts["user"]) || isset($parts["pass"]) || isset($parts["fragment"])) {
			throw new VkResponseException("VK вернул некорректный адрес сервера.");
		}
	}

}
