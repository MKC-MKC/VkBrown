<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects\Traits;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Services\PayloadDecoder;

trait MessagePayloadTrait
{
	/**
	 * Получаем произвольные данные текстовой кнопки из JSON-строки payload сообщения.
	 * Не изменяем структуру полезной нагрузки: её поля определяет приложение бота.
	 * @return array<string, mixed>|null Декодированный объект или null, если payload не передан.
	 * @throws VkResponseException payload не содержит JSON-объект.
	 * @see https://dev.vk.ru/ru/reference/objects/message#payload
	 */
	public function getPayload(): ?array
	{
		return PayloadDecoder::decode($this->read("payload", "string"));
	}

	/**
	 * Получаем исходную полезную нагрузку сообщения в формате строки VK.
	 * Метод полезен, когда нужно сохранить исходный JSON без декодирования и повторного кодирования.
	 * @return string|null Исходное значение payload.
	 * @see https://dev.vk.ru/ru/reference/objects/message#payload
	 */
	public function getPayloadString(): ?string
	{
		return $this->read("payload", "string");
	}

}
