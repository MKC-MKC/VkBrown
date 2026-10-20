<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class SavedDocument extends ResponseWrapper
{

	/**
	 * Тип сохранённого вложения: doc, audio_message или graffiti.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Сохранённый документ при type=doc.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Document|null Значение поля doc.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function getDoc(): ?Document
	{
		return $this->object("doc", Document::class);
	}

	/**
	 * Сохранённое голосовое сообщение при type=audio_message.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return AudioMessage|null Значение поля audio_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function getAudioMessage(): ?AudioMessage
	{
		return $this->object("audio_message", AudioMessage::class);
	}

	/**
	 * Сохранённое граффити при type=graffiti.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля graffiti.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function getGraffiti(): array|null
	{
		return $this->read("graffiti", "array");
	}

}
