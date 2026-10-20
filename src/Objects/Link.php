<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Link extends ResponseWrapper
{

	/**
	 * URL ссылки.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getUrl(): string|null
	{
		return $this->read("url", "string");
	}

	/**
	 * Заголовок ссылки.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Подпись прикреплённой ссылки.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля caption.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getCaption(): string|null
	{
		return $this->read("caption", "string");
	}

	/**
	 * Описание ссылки.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля description.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getDescription(): string|null
	{
		return $this->read("description", "string");
	}

	/**
	 * Изображение превью, объект фотографии (если имеется).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Photo|null Значение поля photo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getPhoto(): ?Photo
	{
		return $this->object("photo", Photo::class);
	}

	/**
	 * Кнопка прикреплённой ссылки.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля button.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getButton(): array|null
	{
		return $this->read("button", "array");
	}

	/**
	 * Идентификатор вики-страницы с контентом для предпросмотра содержимого страницы. Возвращается в формате
	 * "owner_id_page_id" .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля preview_page.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getPreviewPage(): string|null
	{
		return $this->read("preview_page", "string");
	}

	/**
	 * URL страницы с контентом для предпросмотра содержимого страницы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля preview_url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/link
	 */
	public function getPreviewUrl(): string|null
	{
		return $this->read("preview_url", "string");
	}

}
