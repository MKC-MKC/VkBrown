<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\AttachmentHelper;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Audio extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор владельца аудиозаписи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

	/**
	 * Исполнитель.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля artist.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getArtist(): string|null
	{
		return $this->read("artist", "string");
	}

	/**
	 * Название композиции.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Длительность аудиозаписи в секундах.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля duration.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getDuration(): int|null
	{
		return $this->read("duration", "integer");
	}

	/**
	 * Ссылка на mp3.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля url.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getUrl(): string|null
	{
		return $this->read("url", "string");
	}

	/**
	 * Ключ доступа к вложению. При наличии передаётся вместе с owner_id и id в attachment.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля access_key.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/audio
	 */
	public function getAccessKey(): string|null
	{
		return $this->read("access_key", "string");
	}

	/**
	 * Формируем идентификатор вложения для параметра attachment.
	 *
	 * Сохраняем владельца объекта и access_key, если VK передал ключ доступа.
	 * @return string Тип, owner_id, id и необязательный access_key через подчёркивание.
	 * @throws VkResponseException Отсутствуют ID владельца или объекта.
	 * @see https://dev.vk.ru/ru/api/bots/development/messages/attachments
	 */
	public function getAttachment(): string
	{
		return AttachmentHelper::reference("audio", $this->getOwnerId(), $this->getId(), $this->getAccessKey());
	}

}
