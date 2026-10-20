<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkCaptchaException;
use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Exceptions\VkTooManyRequests;
use Haikiri\VkBrown\Exceptions\VkUnauthorizedException;
use Haikiri\VkBrown\Exceptions\VkUserDisabledException;
use Haikiri\VkBrown\Response;
use JsonException;
use stdClass;

final class ResponseDecoder
{

	/**
	 * Декодируем JSON-объект API, Long Poll или входящего Callback-запроса.
	 * Пустой ответ, массив вместо конверта и невалидный JSON считаем нарушением протокола.
	 * @param string $body Исходное тело ответа или запроса.
	 * @return array<string, mixed> Поля JSON-объекта.
	 * @throws VkResponseException JSON не является объектом.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function decodeObject(string $body): array
	{
		try {
			$object = json_decode($body, false, 512, JSON_THROW_ON_ERROR);
			if (!$object instanceof stdClass) {
				throw new VkResponseException("VK вернул JSON, который не является объектом.");
			}

			return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
		} catch (JsonException $exception) {
			throw new VkResponseException("Не удалось разобрать JSON VK.", $exception->getCode());
		}
	}

	/**
	 * Извлекаем результат API-метода либо выбрасываем исключение с кодом и полями ошибки VK.
	 * В случае Captcha сохраняем параметры проверки, но не повторяем запрос автоматически.
	 * @param array<string, mixed> $body Декодированный конверт VK.
	 * @return Response Полный ответ и значение response.
	 * @throws VkMainException VK вернул error.
	 * @throws VkResponseException В ответе нет результата или ошибка имеет неверный формат.
	 * @see https://dev.vk.ru/ru/reference/errors
	 * @see https://dev.vk.ru/ru/api/captcha-error
	 */
	public static function decodeApi(array $body): Response
	{
		if (array_key_exists("error", $body)) {
			$error = $body["error"];
			if (!is_array($error) || !is_int($error["error_code"] ?? null) || !is_string($error["error_msg"] ?? null)) {
				throw new VkResponseException("VK вернул ошибку без error_code или error_msg.");
			}

			$details = self::removeSecrets($error);
			throw match ($error["error_code"]) {
				5 => new VkUnauthorizedException($error["error_msg"], $error["error_code"], $details),
				6 => new VkTooManyRequests($error["error_msg"], $error["error_code"], $details),
				14 => new VkCaptchaException($error["error_msg"], $error["error_code"], $details),
				18 => new VkUserDisabledException($error["error_msg"], $error["error_code"], $details),
				default => new VkMainException($error["error_msg"], $error["error_code"], $details),
			};
		}

		if (!array_key_exists("response", $body)) throw new VkResponseException("В ответе VK отсутствует поле response.");

		return new Response($body["response"], $body);
	}

	/**
	 * Исключаем секреты из дополнительных полей ошибки, в том числе из request_params.
	 * VK может вернуть параметры запроса списком объектов key/value или обычным словарём.
	 * @param array $data Дополнительные поля ошибки.
	 * @return array Поля без токена доступа, секрета Callback и ключа Long Poll.
	 */
	private static function removeSecrets(array $data): array
	{
		$secretNames = ["access_token", "authorization", "secret", "secret_key", "client_secret", "key"];
		# `request_params` содержит пары `key`/`value`: имя обычного параметра сохраняем целиком.
		if (isset($data["key"]) && is_string($data["key"]) && array_key_exists("value", $data)) {
			return in_array(strtolower($data["key"]), $secretNames, true) ? [] : $data;
		}

		foreach ($data as $name => $value) {
			if (is_string($name) && in_array(strtolower($name), $secretNames, true)) {
				unset($data[$name]);
			} elseif (is_array($value)) {
				if (isset($value["key"]) && in_array(strtolower((string)$value["key"]), $secretNames, true)) {
					unset($data[$name]);
				} else {
					$data[$name] = self::removeSecrets($value);
				}
			}
		}

		return $data;
	}

}
