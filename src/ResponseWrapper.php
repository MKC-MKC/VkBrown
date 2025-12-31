<?php

namespace Haikiri\VkBrown;

abstract readonly class ResponseWrapper
{

	public function __construct(private array|null $response)
	{
	}

	public function getAsArray(): array|null
	{
		return $this->response;
	}

	public function getData(string|null $key = null, mixed $default = null): mixed
	{
		$data = $this->getAsArray();
		if ($key === null) return $data;

		foreach (explode(".", $key) as $segment) {
			if (!is_array($data) || !array_key_exists($segment, $data)) {
				return $default;
			}
			$data = $data[$segment];
		}

		return $data;
	}

}
