<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Exceptions\VkMainException;
use GuzzleHttp\Client;
use Throwable;

class VkBrownServer extends VkBrownServerAbstract
{

	/**
	 * Метод отправки POST запроса на сервер API.
	 *
	 * @param string $method
	 * @param array $params
	 * @param array $headers
	 * @return Response|mixed
	 */
	public function sendRequest(string $method, array $params = [], array $headers = ["Content-Type: application/x-www-form-urlencoded"]): mixed
	{
		# Сериализация пустых параметров.
		$isMultipart = $headers === ["Content-Type: multipart/form-data"];
		if (!$isMultipart && $params) {
			$params = array_filter($params, fn($value) => !is_null($value));
			$params = array_map(function ($value) {
				return (is_array($value) || is_object($value)) ? json_encode($value) : $value;
			}, $params);
		}

		# Формируем URL.
		$params["v"] = $this->getVersion();
		$params["access_token"] = $this->getToken();
		$url = rtrim($this->getUrl(), "/") . "/method/" . $method;

		$client = new Client([
			"timeout" => 10,
			"http_errors" => false,
		]);
		$options = ["headers" => $headers];

		if ($isMultipart) {
			$options["multipart"] = $params;
		} elseif ($headers === ["Content-Type: application/json"]) {
			$options["json"] = $params;
		} else {
			$options["form_params"] = $params;
		}
		if (self::$debug) error_log(PHP_EOL . ">>>>>>>>>>" . PHP_EOL . var_export($options, true));

		# Отправляем запрос.
		try {
			$res = $client->post($url, $options);
			$response = (string)$res->getBody();
		} catch (Throwable $ex) {
			throw new VkMainException(message: $ex->getMessage(), code: $ex->getCode());
		}

		$response = self::validate($response, true);
		self::apiResponseValidate($response);

		if (!is_array($response["response"])) return $response["response"];
		return Response::fromResponse($response["response"]);
	}

	/**
	 * Метод получения обновлений через Long Poll API.
	 *
	 * @param int $timeout
	 * @param array $allowedUpdates
	 * @param int|null $offset
	 * @return Response[]
	 */
	public function getUpdates(int $timeout = 25, array $allowedUpdates = [], int|null $offset = null): array
	{
		if (!empty($allowedUpdates)) {
			$allowedUpdates["group_id"] = $this->getGroupId();
			$this->sendRequest("groups.setLongPollSettings", $allowedUpdates);
		}

		$response = $this->sendRequest("groups.getLongPollServer", ["group_id" => $this->getGroupId()]);
		$data = $response->getRaw();
		$longPoolServer = $data["server"];
		$longPoolKey = $data["key"];
		$longPoolTs = $data["ts"];

		if ($offset !== null) $longPoolTs = $offset;

		try {
			$client = new Client(["timeout" => 90]);
			$res = $client->get($longPoolServer, [
				"query" => [
					"key" => $longPoolKey,
					"ts" => $longPoolTs,
					"wait" => $timeout,
					"act" => "a_check",
				],
			]);

			$body = (string)$res->getBody();
			$response = self::validate($body, true);
			self::apiResponseValidate($response);

			return array_map(fn(array $item): Response => Response::fromResponse($item), $response["updates"]);
		} catch (Throwable $e) {
			throw new VkMainException($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Метод валидации ответа JSON.
	 *
	 * @param mixed $json
	 * @param bool|null $asArray
	 * @param int $depth
	 * @param int $flags
	 * @return object|array
	 * @throws VkMainException
	 */
	public static function validate(mixed $json, ?bool $asArray = null, int $depth = 512, int $flags = 0): object|array
	{
		if (!is_string($json)) throw new VkMainException("Invalid response from the server: \$json is not a string");
		$result = json_decode($json, $asArray, $depth, $flags);
		if (self::$debug) error_log(PHP_EOL . "<<<<<<<<<<" . PHP_EOL . var_export($result, true));
		if (json_last_error() !== JSON_ERROR_NONE) throw new VkMainException(json_last_error_msg(), json_last_error());
		return $result;
	}

	/**
	 * Метод валидации ответа от API.
	 *
	 * @param $response
	 * @return void
	 */
	protected static function apiResponseValidate($response): void
	{
		if (!is_array($response) || !isset($response["error"])) return;

		$error = $response["error"];
		$code = (int)($error["error_code"] ?? -1);
		$message = $error["error_msg"] ?? "Unknown error";

		match ($code) {
			18 => throw new Exceptions\VkUserDisabledException(message: $message, code: $code),
			14 => throw new Exceptions\VkCaptchaException(message: $message, code: $code),
			6 => throw new Exceptions\VkTooManyRequests(message: $message, code: $code),
			5 => throw new Exceptions\VkUnauthorizedException(message: $message, code: $code),
			default => throw new Exceptions\VkMainException(message: $message, code: $code),
		};
	}

}
