<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Helper;

use Haikiri\VkBrown\Response;

final class UploadSaveResponseNormalizer
{

	/**
	 * Метод приводит ответ `docs.save` к единому списку документов.
	 * VK может вернуть как массив документов, так и объект-обёртку с полем `type`.
	 *
	 * @param mixed $response
	 * @return array
	 */
	public static function normalizeDocsSaveResponse(mixed $response): array
	{
		$raw = self::extractRawResponse($response);

		# Если VK уже вернул список документов, просто оставляем в нём только массивы-элементы.
		if (is_array($raw) && array_is_list($raw)) {
			return array_values(array_filter($raw, static fn(mixed $item): bool => is_array($item)));
		}

		# Если VK вернул объект-обёртку вида {"type":"doc","doc":{...}}, достаём вложенный документ по имени типа.
		if (is_array($raw)) {
			$responseType = $raw["type"] ?? null;
			if (is_string($responseType) && isset($raw[$responseType]) && is_array($raw[$responseType])) {
				return [$raw[$responseType]];
			}
		}

		# Иногда VK может прислать сразу один объект документа без массива и без поля `type`.
		if (is_array($raw) && isset($raw["owner_id"], $raw["id"])) return [$raw];

		# Для любых остальных форм возвращаем пустой список, чтобы не ронять вызывающий код на экзотическом ответе.
		return [];
	}

	/**
	 * Метод приводит ответ списочного save-метода к массиву объектов.
	 * Это нужно для методов вроде `photos.saveMessagesPhoto`, которые логически возвращают список сущностей.
	 *
	 * @param mixed $response
	 * @return array
	 */
	public static function normalizeListResponse(mixed $response): array
	{
		$raw = self::extractRawResponse($response);
		if (!is_array($raw) || !array_is_list($raw)) return [];

		# В ответе оставляем только реальные объектоподобные элементы, чтобы контракт списка был однородным.
		return array_values(array_filter($raw, static fn(mixed $item): bool => is_array($item)));
	}

	/**
	 * Метод извлекает сырой payload из `Response`, если route уже получил типизированную обёртку от transport-слоя.
	 * Иначе возвращает вход как есть.
	 *
	 * @param mixed $response
	 * @return mixed
	 */
	private static function extractRawResponse(mixed $response): mixed
	{
		return $response instanceof Response ? $response->getRaw() : $response;
	}

}
