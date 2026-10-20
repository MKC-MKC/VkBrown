<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Normalizers;

use BackedEnum;
use Haikiri\VkBrown\ResponseWrapper;

final class ModelNormalizer
{

	/**
	 * Преобразуем вложенные модели SDK и значения enum в данные, передаваемые VK.
	 *
	 * Сохраняем ключи массивов, нулевые значения, false и null внутри JSON-объектов.
	 * @param mixed $value Модель, массив моделей или значение отдельного параметра.
	 * @return mixed Данные без объектов ResponseWrapper и BackedEnum.
	 */
	public static function normalize(mixed $value): mixed
	{
		return match (true) {
			$value instanceof ResponseWrapper => self::normalize($value->getAsArray()),
			$value instanceof BackedEnum => $value->value,
			is_array($value) => array_map(self::normalize(...), $value),
			default => $value,
		};
	}

}
