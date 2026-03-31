<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests\Mock;

use Haikiri\VkBrown\VkBrownServerAbstract;

final class VkBrownServerRecorder extends VkBrownServerAbstract
{

	public string $requestedMethod = "";
	public array $requestedParams = [];
	public array $requestedHeaders = [];
	private mixed $response;

	public function __construct(mixed $response = true, string|int|null $groupId = "123456789")
	{
		parent::__construct(
			token: "vk1.a.Too.Long.Group.Token",
			groupId: $groupId,
		);
		$this->response = $response;
	}

	public function setResponse(mixed $response): void
	{
		$this->response = $response;
	}

	public function sendRequest(string $method, array $params = [], array $headers = ["Content-Type: application/x-www-form-urlencoded"]): mixed
	{
		$this->requestedMethod = $method;
		$this->requestedParams = $params;
		$this->requestedHeaders = $headers;

		return $this->response;
	}

}
