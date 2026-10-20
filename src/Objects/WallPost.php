<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\AttachmentHelper;
use Haikiri\VkBrown\Objects\Traits\DateTimeTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class WallPost extends ResponseWrapper
{

	use DateTimeTrait;

	/**
	 * Идентификатор записи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор владельца стены, на которой размещена запись. В версиях API ниже 5.7 это поле называется
	 * to_id .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getOwnerId(): int|null
	{
		return $this->read("owner_id", "integer");
	}

	/**
	 * Идентификатор автора записи (от чьего имени опубликована запись).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля from_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getFromId(): int|null
	{
		return $this->read("from_id", "integer");
	}

	/**
	 * Идентификатор администратора, который опубликовал запись (возвращается только для сообществ при
	 * запросе с ключом доступа администратора). Возвращается в записях, опубликованных менее 24 часов назад.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля created_by.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getCreatedBy(): int|null
	{
		return $this->read("created_by", "integer");
	}

	/**
	 * Время публикации записи в формате unixtime .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getDate(): int|null
	{
		return $this->read("date", "integer");
	}

	/**
	 * Текст записи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля text.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getText(): string|null
	{
		return $this->read("text", "string");
	}

	/**
	 * Идентификатор владельца записи, в ответ на которую была оставлена текущая.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля reply_owner_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getReplyOwnerId(): int|null
	{
		return $this->read("reply_owner_id", "integer");
	}

	/**
	 * Идентификатор записи, в ответ на которую была оставлена текущая.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля reply_post_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getReplyPostId(): int|null
	{
		return $this->read("reply_post_id", "integer");
	}

	/**
	 * 1 , если запись была создана с опцией «Только для друзей».
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля friends_only.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function isFriendsOnly(): bool|null
	{
		return $this->read("friends_only", "boolean");
	}

	/**
	 * Информация о комментариях к записи, объект с полями: • count ( integer ) - количество комментариев; •
	 * can_post* ( integer ) - информация о том, может ли текущий пользователь комментировать запись ( 1 -
	 * может, 0 - не может); • groups_can_post ( integer ) - информация о том, могут ли сообщества
	 * комментировать запись; • can_close ( boolean ) - может ли текущий пользователь закрыть комментарии к
	 * записи; • can_open ( boolean ) - может ли текущий пользователь открыть комментарии к записи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля comments.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getComments(): array|null
	{
		return $this->read("comments", "array");
	}

	/**
	 * Информация о лайках к записи, объект с полями: • count ( integer ) - число пользователей, которым
	 * понравилась запись; • user_likes* ( integer ) - наличие отметки «Мне нравится» от текущего
	 * пользователя ( 1 - есть, 0 - нет); • can_like* ( integer ) - информация о том, может ли текущий
	 * пользователь поставить отметку «Мне нравится» ( 1 - может, 0 - не может); • can_publish* ( integer ) -
	 * информация о том, может ли текущий пользователь сделать репост записи ( 1 - может, 0 - не может).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля likes.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getLikes(): array|null
	{
		return $this->read("likes", "array");
	}

	/**
	 * Информация о репостах записи («Рассказать друзьям»), объект с полями: • count ( integer ) - число
	 * пользователей, скопировавших запись; • user_reposted* ( integer ) - наличие репоста от текущего
	 * пользователя ( 1 - есть, 0 - нет).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля reposts.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getReposts(): array|null
	{
		return $this->read("reposts", "array");
	}

	/**
	 * Информация о просмотрах записи. Объект с единственным полем: • count ( integer ) - число просмотров
	 * записи.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля views.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getViews(): array|null
	{
		return $this->read("views", "array");
	}

	/**
	 * Тип записи, может принимать следующие значения: post , copy , reply , postpone , suggest .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля post_type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getPostType(): string|null
	{
		return $this->read("post_type", "string");
	}

	/**
	 * Массив объектов, соответствующих медиаресурсам, прикреплённым к записи: фотографиям, документам,
	 * видеофайлам и другим. Подробное описание - в разделе Медиавложения в записях на стене .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Attachment> Значение поля attachments.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getAttachments(): array
	{
		return $this->objects("attachments", Attachment::class);
	}

	/**
	 * Информация о местоположении , содержит поля: • type ( string ) - тип места; • coordinates ( string ) -
	 * координаты места; • place ( object ) - описание места (если оно добавлено). Объект места .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля geo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getGeo(): array|null
	{
		return $this->read("geo", "array");
	}

	/**
	 * Идентификатор автора, если запись была опубликована от имени сообщества и подписана пользователем;
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля signer_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getSignerId(): int|null
	{
		return $this->read("signer_id", "integer");
	}

	/**
	 * Массив, содержащий историю репостов для записи. Возвращается только в том случае, если запись является
	 * репостом. Каждый из объектов массива, в свою очередь, является объектом-записью стандартного формата.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<WallPost> Значение поля copy_history.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getCopyHistory(): array
	{
		return $this->objects("copy_history", WallPost::class);
	}

	/**
	 * Информация о том, может ли текущий пользователь закрепить запись ( 1 - может, 0 - не может).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_pin.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function canPin(): bool|null
	{
		return $this->read("can_pin", "boolean");
	}

	/**
	 * Информация о том, может ли текущий пользователь удалить запись ( 1 - может, 0 - не может).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_delete.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function canDelete(): bool|null
	{
		return $this->read("can_delete", "boolean");
	}

	/**
	 * Информация о том, может ли текущий пользователь редактировать запись ( 1 - может, 0 - не может).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_edit.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function canEdit(): bool|null
	{
		return $this->read("can_edit", "boolean");
	}

	/**
	 * Информация о том, что запись закреплена.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_pinned.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function isPinned(): bool|null
	{
		return $this->read("is_pinned", "boolean");
	}

	/**
	 * Информация о том, содержит ли запись отметку «реклама» ( 1 - да, 0 - нет).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля marked_as_ads.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function isMarkedAsAds(): bool|null
	{
		return $this->read("marked_as_ads", "boolean");
	}

	/**
	 * true , если объект добавлен в закладки у текущего пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_favorite.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function isFavorite(): bool|null
	{
		return $this->read("is_favorite", "boolean");
	}

	/**
	 * Информация о записи VK Донат: • is_donut ( boolean ) - запись доступна только платным подписчикам VK
	 * Донат; • paid_duration ( integer ) - время, в течение которого запись будет доступна только платным
	 * подписчикам VK Донат; • placeholder ( object ) - заглушка для пользователей, которые не оформили
	 * подписку VK Донат. Отображается вместо содержимого записи. • can_publish_free_copy ( boolean ) - можно
	 * ли открыть запись для всех пользователей, а не только подписчиков VK Донат; • edit_mode ( string ) -
	 * информация о том, какие значения VK Донат можно изменить в записи. Возможные значения: • all - всю
	 * информацию о VK Донат. • duration - время, в течение которого запись будет доступна только платным
	 * подписчикам VK Донат.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля donut.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getDonut(): array|null
	{
		return $this->read("donut", "array");
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
		return AttachmentHelper::reference("wall", $this->getOwnerId(), $this->getId());
	}

}
