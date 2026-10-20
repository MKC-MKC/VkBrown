<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class PhotoCover extends ResponseWrapper
{

	/**
	 * Изображения доступных размеров.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля images.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/photos.saveOwnerCoverPhoto
	 */
	public function getImages(): array
	{
		return $this->objects("images", PhotoSize::class);
	}

}
