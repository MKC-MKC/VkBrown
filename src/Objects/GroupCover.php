<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupCover extends ResponseWrapper
{

	/**
	 * Включена ли возможность.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля enabled.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group#cover
	 */
	public function isEnabled(): bool|null
	{
		return $this->read("enabled", "boolean");
	}

	/**
	 * Изображения доступных размеров.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля images.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group#cover
	 */
	public function getImages(): array
	{
		return $this->objects("images", PhotoSize::class);
	}

}
