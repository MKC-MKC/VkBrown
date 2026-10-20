<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Api;

use Haikiri\VkBrown\Api\Contracts\V5199;
use Haikiri\VkBrown\Enums\ApiVersion;
use Haikiri\VkBrown\Exceptions\UnsupportedVersionException;

final class VersionRegistry
{
	/**
	 * Выбираем отдельный контракт по точному номеру версии VK API.
	 * Новая версия требует отдельной реализации контракта и явной регистрации здесь.
	 * @param ApiVersion|string $version Номер версии, например ApiVersion::V5_199.
	 * @return ApiContractInterface Реализация выбранной версии.
	 * @throws UnsupportedVersionException Для переданной версии нет реализации.
	 * @see https://dev.vk.ru/ru/reference/versions
	 */
	public static function get(ApiVersion|string $version): ApiContractInterface
	{
		$value = $version instanceof ApiVersion ? $version->value : $version;

		return match ($value) {
			"5.199" => new V5199(),
			default => throw new UnsupportedVersionException("Версия VK API $value не поддерживается."),
		};
	}
}
