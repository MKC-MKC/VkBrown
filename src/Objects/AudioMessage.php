<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\AttachmentHelper;
use Haikiri\VkBrown\ResponseWrapper;

readonly class AudioMessage extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор владельца объекта; для сообщества используется отрицательное значение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

	/**
	 * Продолжительность записи в секундах.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля duration.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getDuration(): int|null
	{
		return $this->read("duration", "integer");
	}

	/**
	 * Массив значений формы волны голосового сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля waveform.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getWaveform(): array|null
	{
		return $this->read("waveform", "array");
	}

	/**
	 * URL голосового сообщения в OGG.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля link_ogg.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getLinkOgg(): string|null
	{
		return $this->read("link_ogg", "string");
	}

	/**
	 * URL голосового сообщения в MP3.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля link_mp3.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getLinkMp3(): string|null
	{
		return $this->read("link_mp3", "string");
	}

	/**
	 * Ключ доступа к вложению. При наличии передаётся вместе с owner_id и id в attachment.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля access_key.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getAccessKey(): string|null
	{
		return $this->read("access_key", "string");
	}

	/**
	 * Расшифровка голосового сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля transcript.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getTranscript(): string|null
	{
		return $this->read("transcript", "string");
	}

	/**
	 * Состояние расшифровки голосового сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля transcript_state.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/attachments-message
	 */
	public function getTranscriptState(): string|null
	{
		return $this->read("transcript_state", "string");
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
		return AttachmentHelper::reference("doc", $this->getOwnerId(), $this->getId(), $this->getAccessKey());
	}

}
