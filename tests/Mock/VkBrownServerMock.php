<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests\Mock;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\VkBrownServer;

final class VkBrownServerMock extends VkBrownServer
{
	private static string|null $mockedData;
	private static string $expected_token = "vk1.a.Too.Long.Group.Token";

	public function __construct(
		protected string $token,
		protected string|int|null $groupId,
		string|null      $mockedData,
		string|null      $confirmation = null,
		string|null      $version = null,
		string|null      $url = null,
						 $debug = false,
	)
	{
		parent::__construct($token, $groupId, $confirmation, $version, $url, $debug);
		self::$mockedData = $mockedData;
	}

	public function sendRequest(string $method, array $params = [], array $headers = ["Content-Type: application/x-www-form-urlencoded"]): mixed
	{
		# Подготавливаем пользовательский JSON.
		$response = self::$mockedData;

		# Имитация проверки токена на стороне VK API.
		if ($this->token != self::$expected_token) {
			$response = file_get_contents(__DIR__ . "/../Response/5-unauthorized.json");
		}

		# Проверяем и возвращаем данные.
		$response = self::validate($response, true);
		if (isset($response["error"])) {
			throw new VkMainException($response["error"]["error_msg"], $response["error"]["error_code"]);
		}

		if (!is_array($response)) return $response;
		return Response::fromResponse($response);
	}

}
