<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\WallCommentIdentifier;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Wall
{

	/**
	 * Закрываем комментирование записи на стене.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $postId Идентификатор записи на стене владельца owner_id.
	 * @param int|string|null $ownerId Идентификатор владельца; для сообщества используется отрицательное значение.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/wall.closeComments
	 */
	public function closeWallComments(
		int|string      $postId,
		int|string|null $ownerId = null,
	): bool
	{
		$params = [
			"post_id" => $postId,
			"owner_id" => $ownerId ?? -$this->getGroupId(),
		];

		$response = $this->sendRequest("wall.closeComments", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Добавляем комментарий к записи на стене сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $postId Идентификатор записи на стене владельца owner_id.
	 * @param int|string|null $ownerId Идентификатор владельца; для сообщества используется отрицательное значение.
	 * @param int|null $fromGroup Идентификатор сообщества, от имени которого оставляется комментарий.
	 * @param string|null $text Текст сообщения или комментария; упоминания и ссылки передаются в формате VK.
	 * @param int|null $replyToComment Идентификатор комментария, в ответ на который создаётся новый комментарий.
	 * @param array|string|null $attachments Идентификаторы вложений, например ["photo-123_456"], либо строка через
	 * запятую.
	 * @param int|string|null $stickerId Идентификатор стикера VK.
	 * @param string|null $guid Уникальная строка для предотвращения повторной отправки комментария.
	 * @return WallCommentIdentifier Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/wall.createComment
	 */
	public function createWallComment(
		int|string        $postId,
		int|string|null   $ownerId = null,
		int|null          $fromGroup = null,
		string|null       $text = null,
		int|null          $replyToComment = null,
		array|string|null $attachments = null,
		int|string|null   $stickerId = null,
		string|null       $guid = null,
	): WallCommentIdentifier
	{
		$params = [
			"post_id" => $postId,
			"owner_id" => $ownerId ?? -$this->getGroupId(),
			"from_group" => $fromGroup,
			"message" => $text,
			"reply_to_comment" => $replyToComment,
			"attachments" => $attachments,
			"sticker_id" => $stickerId,
			"guid" => $guid,
		];

		$response = $this->sendRequest("wall.createComment", $params);
		return ResponseHydrator::model($response, WallCommentIdentifier::class);
	}

	/**
	 * Открываем комментирование записи на стене.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $postId Идентификатор записи на стене владельца owner_id.
	 * @param int|string|null $ownerId Идентификатор владельца; для сообщества используется отрицательное значение.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/wall.openComments
	 */
	public function openWallComments(
		int|string      $postId,
		int|string|null $ownerId = null,
	): bool
	{
		$params = [
			"post_id" => $postId,
			"owner_id" => $ownerId ?? -$this->getGroupId(),
		];

		$response = $this->sendRequest("wall.openComments", $params);
		return ResponseHydrator::boolean($response);
	}

}
