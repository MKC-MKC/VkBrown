<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Helper;

use Haikiri\VkBrown\Exceptions\VkResponseException;

final class AttachmentHelper
{

	/**
	 * Формируем идентификатор сохранённого вложения для attachment сообщения или комментария.
	 *
	 * Access key добавляем только при его наличии. URL файла не является идентификатором вложения.
	 * @param string $type Тип VK: photo, doc, audio_message, video, audio или wall.
	 * @param int|null $ownerId Идентификатор владельца объекта, включая отрицательные ID сообществ.
	 * @param int|null $id Идентификатор объекта у владельца.
	 * @param string|null $accessKey Ключ доступа, если возвращён VK.
	 * @return string Значение вида photo-123_456_accesskey.
	 * @throws VkResponseException Объект не содержит owner_id или id.
	 * @see https://dev.vk.ru/ru/api/bots/development/messages/attachments
	 */
	public static function reference(string $type, ?int $ownerId, ?int $id, ?string $accessKey = null): string
	{
		if ($ownerId === null || $id === null) throw new VkResponseException("Для вложения необходимы owner_id и id.");
		return $type . $ownerId . "_" . $id . ($accessKey !== null && $accessKey !== "" ? "_" . $accessKey : "");
	}

}
