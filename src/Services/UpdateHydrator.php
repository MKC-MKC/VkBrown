<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Api\ApiContractInterface;
use Haikiri\VkBrown\Enums\UpdateEnum;
use Haikiri\VkBrown\Exceptions\UnsupportedVersionException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Update;

final readonly class UpdateHydrator
{

	public function __construct(private ApiContractInterface $contract)
	{
	}

	/**
	 * Создаём обновление из полного конверта Callback API или элемента updates Bots Long Poll.
	 * Сохраняем type, group_id, event_id, v, secret и object вместе. У confirmation могут отсутствовать
	 * object, event_id и v; для остальных событий проверяем версию сформированного объекта.
	 * @param array<string, mixed> $data Полный объект события VK.
	 * @return Update Обновление с единым интерфейсом для обоих способов получения событий.
	 * @throws VkResponseException Передан неполный конверт или неизвестный тип события.
	 * @throws UnsupportedVersionException Версия события отличается от настроенного контракта.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function hydrate(array $data): Update
	{
		$type = $data["type"] ?? null;
		if (!is_string($type) || !is_int($data["group_id"] ?? null) || $data["group_id"] <= 0 || UpdateEnum::tryFrom($type) === null) {
			throw new VkResponseException("Событие VK должно содержать известный type и целочисленный group_id.");
		}

		if ($type !== UpdateEnum::CONFIRMATION->value) {
			if (!is_array($data["object"] ?? null)) {
				throw new VkResponseException("В событии VK отсутствует object.");
			}

			if (($data["v"] ?? null) !== $this->contract->getVersion()) {
				throw new UnsupportedVersionException("Версия события VK не совпадает с настроенным контрактом.");
			}
		}

		return new Update($data);
	}

}
