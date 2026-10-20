<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Sticker extends ResponseWrapper
{

	/**
	 * Идентификатор набора стикеров.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля product_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function getProductId(): int|null
	{
		return $this->read("product_id", "integer");
	}

	/**
	 * Идентификатор стикера.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля sticker_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function getStickerId(): int|null
	{
		return $this->read("sticker_id", "integer");
	}

	/**
	 * Изображения для стикера (с прозрачным фоном). Массив, каждый объект в котором содержит поля: • url (
	 * string ) - URL копии изображения. • width ( integer ) - ширина копии в пикселях. • height ( integer )
	 * - высота копии в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля images.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function getImages(): array
	{
		return $this->objects("images", PhotoSize::class);
	}

	/**
	 * Изображения для стикера (с непрозрачным фоном). Массив, каждый объект в котором содержит поля: • url (
	 * string ) - URL копии изображения. • width ( integer ) - ширина копии в пикселях. • height ( integer )
	 * - высота копии в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля images_with_background.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function getImagesWithBackground(): array
	{
		return $this->objects("images_with_background", PhotoSize::class);
	}

	/**
	 * URL анимации стикера.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля animation_url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function getAnimationUrl(): string|null
	{
		return $this->read("animation_url", "string");
	}

	/**
	 * Разрешил ли пользователь сообщения сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_allowed.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/sticker
	 */
	public function isAllowed(): bool|null
	{
		return $this->read("is_allowed", "boolean");
	}

}
