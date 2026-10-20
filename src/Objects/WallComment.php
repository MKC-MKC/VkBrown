<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Traits\DateTimeTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class WallComment extends ResponseWrapper
{

	use DateTimeTrait;

	/**
	 * Идентификатор комментария.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор автора комментария.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля from_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getFromId(): int|null
	{
		return $this->read("from_id", "integer");
	}

	/**
	 * Дата создания комментария в формате Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Текст комментария.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля text.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getText(): string|null
	{
		return $this->read("text", "string");
	}

	/**
	 * Идентификатор пользователя или сообщества, в ответ которому оставлен текущий комментарий (если
	 * применимо).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля reply_to_user.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getReplyToUser(): int|null
	{
		return $this->read("reply_to_user", "integer");
	}

	/**
	 * Идентификатор комментария, в ответ на который оставлен текущий (если применимо).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля reply_to_comment.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getReplyToComment(): int|null
	{
		return $this->read("reply_to_comment", "integer");
	}

	/**
	 * Медиавложения комментария (фотографии, ссылки и т.п.). Описание массива attachments находится на
	 * отдельной странице .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Attachment> Значение поля attachments.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getAttachments(): array
	{
		return $this->objects("attachments", Attachment::class);
	}

	/**
	 * Массив идентификаторов родительских комментариев.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля parents_stack.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getParentsStack(): array|null
	{
		return $this->read("parents_stack", "array");
	}

	/**
	 * Информация о вложенной ветке комментариев, объект с полями: • count ( integer ) - количество
	 * комментариев в ветке. • items ( array ) - массив объектов комментариев к записи (только для метода
	 * wall.getComments ). • can_post ( boolean ) - может ли текущий пользователь оставлять комментарии в
	 * этой ветке. • show_reply_button ( boolean ) - нужно ли отображать кнопку «ответить» в ветке. •
	 * groups_can_post ( boolean ) - могут ли сообщества оставлять комментарии в ветке.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля thread.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getThread(): array|null
	{
		return $this->read("thread", "array");
	}

	/**
	 * Идентификатор записи на стене.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля post_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getPostId(): int|null
	{
		return $this->read("post_id", "integer");
	}

	/**
	 * Идентификатор владельца объекта; для сообщества используется отрицательное значение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

}
