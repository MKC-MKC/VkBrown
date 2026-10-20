<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Builders;

final class MultipartRequestBuilder
{
	/**
	 * Представляем подготовленные параметры API отдельными частями multipart/form-data.
	 * Boundary и Content-Type формирует Guzzle. Не смешиваем поля API с описаниями файлов.
	 * @param array<string, string> $params Строковые значения после нормализации.
	 * @return list<array{name: string, contents: string}> Части multipart-запроса.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function build(array $params): array
	{
		$parts = [];
		foreach ($params as $name => $contents) {
			$parts[] = ["name" => $name, "contents" => $contents];
		}

		return $parts;
	}
}
