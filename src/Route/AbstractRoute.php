<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

use Haikiri\VkBrown\VkBrownServerAbstract;

abstract class AbstractRoute
{

	public function __construct(
		protected readonly VkBrownServerAbstract $server,
	)
	{
	}

	/**
	 * Метод готовит параметры в формате, который ожидает VK API, и затем делегирует сам HTTP-вызов серверу.
	 *
	 * @param string $method
	 * @param array $params
	 * @param array $listParams
	 * @return mixed
	 */
	protected function request(string $method, array $params = [], array $listParams = []): mixed
	{
		return $this->server->sendRequest($method, $this->normalizeParams($params, $listParams));
	}

	/**
	 * Метод нормализует параметры строго на транспортном уровне:
	 * - списки переводит в формат строки через запятую там, где VK ожидает именно такой контракт;
	 * - boolean приводит к `0/1`, потому что именно так VK принимает большинство флагов;
	 * - `null` вычищает, чтобы не шуметь в запросе лишними полями.
	 *
	 * @param array $params
	 * @param array $listParams
	 * @return array
	 */
	protected function normalizeParams(array $params, array $listParams = []): array
	{
		# Сначала приводим массивы-списки к строке через запятую только для тех полей, где это действительно контракт VK API.
		foreach ($listParams as $paramName) {
			if (!array_key_exists($paramName, $params) || $params[$paramName] === null || !is_array($params[$paramName])) continue;
			$params[$paramName] = implode(",", array_map(static fn(mixed $item): string => (string)$item, $params[$paramName]));
		}

		# Затем приводим флаги к целочисленному виду, чтобы не зависеть от неявного поведения HTTP-клиента.
		foreach ($params as $paramName => $value) {
			if (!is_bool($value)) continue;
			$params[$paramName] = (int)$value;
		}

		# В конце оставляем только реально переданные значения, чтобы запрос не содержал пустых полей.
		return array_filter($params, static fn(mixed $value): bool => $value !== null);
	}

}
