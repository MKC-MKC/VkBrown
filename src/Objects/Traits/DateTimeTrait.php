<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects\Traits;

use DateTimeImmutable;
use Haikiri\VkBrown\Exceptions\VkResponseException;

trait DateTimeTrait
{

	/**
	 * Представляем дату объекта VK в виде неизменяемого объекта времени UTC.
	 *
	 * Исходное поле date содержит Unix timestamp в секундах и остаётся доступным через getDate().
	 * @return DateTimeImmutable|null Дата объекта либо null, если поле date не передано.
	 * @throws VkResponseException Дата не является целым числом.
	 */
	public function getDateTime(): ?DateTimeImmutable
	{
		$date = $this->read("date", "integer");

		if ($date === null) return null;
		$datetime = DateTimeImmutable::createFromFormat("U", (string)$date);
		if ($datetime === false) throw new VkResponseException("Не удалось преобразовать дату объекта VK.");
		return $datetime;
	}

}
