<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Normalizers;

use InvalidArgumentException;
use JsonException;

final class ParameterNormalizer
{

	/**
	 * Подготавливаем поля формы по описаниям параметров выбранного метода VK.
	 * Списки передаём через запятую, сложные параметры - JSON-строкой. Готовые строки не кодируем
	 * повторно. Только null на верхнем уровне означает, что параметр не передаётся.
	 * @param array<string, mixed> $params Параметры с именами VK, например ["user_ids" => [1, 2]].
	 * @param array<string, array<string, mixed>> $definitions Правила сериализации метода.
	 * @return array<string, string> Подготовленные поля POST-запроса.
	 * @throws InvalidArgumentException Тип параметра не соответствует способу передачи.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public static function normalize(array $params, array $definitions): array
	{
		$result = [];

		# Кодируем каждое поле отдельно: VK не принимает JSON в качестве тела API-запроса.
		foreach ($params as $name => $value) {
			if ($value === null) continue;
			$value = ModelNormalizer::normalize($value);
			$encoding = $definitions[$name]["encoding"] ?? null;

			if ($encoding === "json" && !is_string($value)) {
				try {
					$result[$name] = json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
				} catch (JsonException) {
					throw new InvalidArgumentException("Параметр $name невозможно представить в JSON.");
				}

				continue;
			}

			if ($encoding === "csv" && is_array($value)) {
				foreach ($value as $item) {
					if (!is_scalar($item)) {
						throw new InvalidArgumentException("Параметр $name должен содержать скалярные значения.");
					}
				}

				$result[$name] = implode(",", $value);
				continue;
			}

			if (!is_scalar($value)) {
				throw new InvalidArgumentException("Для параметра $name не определён способ передачи сложного значения.");
			}

			if (is_bool($value)) {
				$value = (int)$value;
			}

			$result[$name] = (string)$value;
		}

		return $result;
	}

}
