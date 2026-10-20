<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\AttachmentHelper;
use Haikiri\VkBrown\Objects\Traits\DateTimeTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Video extends ResponseWrapper
{

	use DateTimeTrait;

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор владельца видеозаписи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

	/**
	 * Название видеозаписи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Текст описания видеозаписи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля description.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getDescription(): string|null
	{
		return $this->read("description", "string");
	}

	/**
	 * Длительность ролика в секундах.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля duration.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getDuration(): int|null
	{
		return $this->read("duration", "integer");
	}

	/**
	 * URL изображения-обложки ролика с размером 160x120 px.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля image.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getImage(): array
	{
		return $this->objects("image", PhotoSize::class);
	}

	/**
	 * Изображения первого кадра видео.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<PhotoSize> Значение поля first_frame.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getFirstFrame(): array
	{
		return $this->objects("first_frame", PhotoSize::class);
	}

	/**
	 * Дата добавления видеозаписи в формате Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Информация о просмотрах объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля views.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getViews(): int|null
	{
		return $this->read("views", "integer");
	}

	/**
	 * Информация о комментариях: количество и доступность.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля comments.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getComments(): int|null
	{
		return $this->read("comments", "integer");
	}

	/**
	 * Ключ доступа к вложению. При наличии передаётся вместе с owner_id и id в attachment.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля access_key.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getAccessKey(): string|null
	{
		return $this->read("access_key", "string");
	}

	/**
	 * Адрес страницы с плеером, который можно использовать для воспроизведения ролика в браузере.
	 * Поддерживается flash и HTML5, плеер всегда масштабируется по размеру окна. Параметр недоступен для
	 * видеозаписи с типом story .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля player.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getPlayer(): string|null
	{
		return $this->read("player", "string");
	}

	/**
	 * Ширина изображения или видео в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля width.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getWidth(): int|null
	{
		return $this->read("width", "integer");
	}

	/**
	 * Высота изображения или видео в пикселях.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля height.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function getHeight(): int|null
	{
		return $this->read("height", "integer");
	}

	/**
	 * Доступно ли добавление объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_add.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function canAdd(): bool|null
	{
		return $this->read("can_add", "boolean");
	}

	/**
	 * Является ли объект приватным.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_private.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/video
	 */
	public function isPrivate(): bool|null
	{
		return $this->read("is_private", "boolean");
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
		return AttachmentHelper::reference("video", $this->getOwnerId(), $this->getId(), $this->getAccessKey());
	}

}
