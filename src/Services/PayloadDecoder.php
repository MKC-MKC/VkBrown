<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkResponseException;

final class PayloadDecoder
{

	/**
	 * Декодируем полезную нагрузку текстовой кнопки, полученную в поле payload сообщения.
	 * VK передаёт payload сообщения JSON-строкой; в message_event полезная нагрузка уже является объектом.
	 * @param string|null $payload JSON-объект, например {"action":"help"}; null означает отсутствие payload.
	 * @return array<string, mixed>|null Произвольные данные кнопки без изменения их значений.
	 * @throws VkResponseException Передан невалидный JSON или JSON другого типа.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/key-types
	 */
	public static function decode(?string $payload): ?array
	{
		return $payload === null ? null : ResponseDecoder::decodeObject($payload);
	}

}
