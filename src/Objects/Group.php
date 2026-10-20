<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Group extends ResponseWrapper
{

	/**
	 * Идентификатор сообщества.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getId(): int
	{
		return $this->required("id", "integer");
	}

	/**
	 * Название сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getName(): string|null
	{
		return $this->read("name", "string");
	}

	/**
	 * Короткий адрес, например, apiclub .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля screen_name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getScreenName(): string|null
	{
		return $this->read("screen_name", "string");
	}

	/**
	 * Является ли сообщество закрытым. Возможные значения: • 0 - открытое; • 1 - закрытое; • 2 - частное.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля is_closed.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getIsClosed(): int|null
	{
		return $this->read("is_closed", "integer");
	}

	/**
	 * Тип сообщества: • group - группа; • page - публичная страница; • event - мероприятие.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля type.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getType(): string|null
	{
		return $this->read("type", "string");
	}

	/**
	 * Возвращается в случае, если сообщество удалено или заблокировано. Возможные значения: • deleted -
	 * сообщество удалено; • banned - сообщество заблокировано;
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля deactivated.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getDeactivated(): string|null
	{
		return $this->read("deactivated", "string");
	}

	/**
	 * Требуется scope = groups Информация о том, является ли текущий пользователь руководителем. Возможные
	 * значения: • 1 - является; • 0 - не является.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_admin.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function isAdmin(): bool|null
	{
		return $this->read("is_admin", "boolean");
	}

	/**
	 * Требуется scope = groups Уровень полномочий текущего пользователя (если is_admin = 1 ): • 1 -
	 * модератор; • 2 - редактор; • 3 - администратор.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля admin_level.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getAdminLevel(): int|null
	{
		return $this->read("admin_level", "integer");
	}

	/**
	 * Требуется scope = groups Информация о том, является ли текущий пользователь участником. Возможные
	 * значения: • 1 - является; • 0 - не является.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_member.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function isMember(): bool|null
	{
		return $this->read("is_member", "boolean");
	}

	/**
	 * Требуется scope = groups Информация о том, является ли текущий пользователь рекламодателем. Возможные
	 * значения: • 1 - является; • 0 - не является.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_advertiser.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function isAdvertiser(): bool|null
	{
		return $this->read("is_advertiser", "boolean");
	}

	/**
	 * URL главной фотографии с размером 50x50px.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_50.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getPhoto50(): string|null
	{
		return $this->read("photo_50", "string");
	}

	/**
	 * URL главной фотографии с размером 100х100px.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_100.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getPhoto100(): string|null
	{
		return $this->read("photo_100", "string");
	}

	/**
	 * URL главной фотографии в максимальном размере.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_200.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getPhoto200(): string|null
	{
		return $this->read("photo_200", "string");
	}

	/**
	 * Количество участников в сообществе
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля members_count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getMembersCount(): int|null
	{
		return $this->read("members_count", "integer");
	}

	/**
	 * Текст описания сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля description.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getDescription(): string|null
	{
		return $this->read("description", "string");
	}

	/**
	 * Статус сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля status.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getStatus(): string|null
	{
		return $this->read("status", "string");
	}

	/**
	 * Строка тематики паблика. У групп возвращается строковое значение, открыта ли группа или нет, а у
	 * событий дата начала.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля activity.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getActivity(): string|null
	{
		return $this->read("activity", "string");
	}

	/**
	 * Адрес сайта из поля «веб-сайт» в описании сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля site.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getSite(): string|null
	{
		return $this->read("site", "string");
	}

	/**
	 * Город, указанный в информации о сообществе. Объект, содержащий следующие поля: • id ( integer ) -
	 * идентификатор города; • title ( string ) - название города.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return City|null Значение поля city.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getCity(): ?City
	{
		return $this->object("city", City::class);
	}

	/**
	 * Страна, указанная в информации о сообществе. Объект, содержащий следующие поля: • id ( integer ) -
	 * идентификатор страны; • title ( string ) - название страны.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Country|null Значение поля country.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getCountry(): ?Country
	{
		return $this->object("country", Country::class);
	}

	/**
	 * Обложка сообщества. Объект, который содержит следующие поля: • enabled ( integer ) - информация о том,
	 * включена ли обложка ( 1 - да, 0 - нет); • images ( array ) - копии изображений обложки. Массив
	 * объектов, каждый из которых содержит следующие поля: • url ( string ) - URL копии; • width ( integer )
	 * - ширина копии; • height ( integer ) - высота копии.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return GroupCover|null Значение поля cover.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getCover(): ?GroupCover
	{
		return $this->object("cover", GroupCover::class);
	}

	/**
	 * Информация об адресах сообщества. Возвращаются следующие поля: • is_enabled ( boolean ) - включен ли
	 * блок адресов в сообществе. • main_address_id ( integer ) - идентификатор основного адреса.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля addresses.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getAddresses(): array|null
	{
		return $this->read("addresses", "array");
	}

	/**
	 * Информация из блока контактов публичной страницы. Массив объектов, каждый из которых может содержать
	 * поля: • user_id ( integer ) - идентификатор пользователя; • desc ( string ) - должность; • phone (
	 * string ) - номер телефона; • email ( string ) - адрес e-mail.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля contacts.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getContacts(): array|null
	{
		return $this->read("contacts", "array");
	}

	/**
	 * Информация из блока ссылок сообщества. Массив объектов, каждый из которых содержит следующие поля: •
	 * id ( integer ) - идентификатор ссылки; • url ( string ) - URL; • name ( string ) - название ссылки; •
	 * desc ( string ) - описание ссылки; • photo_50 ( string ) - URL изображения-превью шириной 50px; •
	 * photo_100 ( string ) - URL изображения-превью шириной 100px. Поле возвращается только при запросе
	 * данных об одном сообществе
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля links.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getLinks(): array|null
	{
		return $this->read("links", "array");
	}

	/**
	 * Объект, содержащий счётчики сообщества, может включать любой набор из следующих полей: photos , albums
	 * , audios , videos , topics , docs . Поле возвращается только при запросе данных об одном сообществе
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля counters.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getCounters(): array|null
	{
		return $this->read("counters", "array");
	}

	/**
	 * Информация о том, может ли текущий пользователь написать сообщение сообществу. Возможные значения: • 1
	 * - может; • 0 - не может.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function canMessage(): bool|null
	{
		return $this->read("can_message", "boolean");
	}

	/**
	 * Информация о том, может ли текущий пользователь оставлять записи на стене сообщества. Возможные
	 * значения: • 1 - может; • 0 - не может.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_post.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function canPost(): bool|null
	{
		return $this->read("can_post", "boolean");
	}

	/**
	 * Информация о том, разрешено ли видеть чужие записи на стене группы. Возможные значения: • 1 - может; •
	 * 0 - не может.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_see_all_posts.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function canSeeAllPosts(): bool|null
	{
		return $this->read("can_see_all_posts", "boolean");
	}

	/**
	 * Информация о том, может ли текущий пользователь загружать документы в группу. Возможные значения: • 1
	 * - может; • 0 - не может.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_upload_doc.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function canUploadDoc(): bool|null
	{
		return $this->read("can_upload_doc", "boolean");
	}

	/**
	 * Информация о том, заблокированы ли сообщения от этого сообщества (для текущего пользователя).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_messages_blocked.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function isMessagesBlocked(): bool|null
	{
		return $this->read("is_messages_blocked", "boolean");
	}

	/**
	 * Верифицировано ли сообщество: • 1 - верифицировано; • 0 - нет. Подробнее о верификации - в Помощи
	 * ВКонтакте .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля verified.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function isVerified(): bool|null
	{
		return $this->read("verified", "boolean");
	}

	/**
	 * Информация о том, установлена ли у сообщества главная фотография. Возможные значения: • 1 -
	 * установлена; • 0 - не установлена.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля has_photo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function hasPhoto(): bool|null
	{
		return $this->read("has_photo", "boolean");
	}

	/**
	 * Возрастное ограничение. • 1 - нет; • 2 - 16+; • 3 - 18+.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля age_limits.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getAgeLimits(): int|null
	{
		return $this->read("age_limits", "integer");
	}

	/**
	 * Информация о главной секции. Возможные значения: • 0 - отсутствует; • 1 - фотографии; • 2 -
	 * обсуждения; • 3 - аудиозаписи; • 4 - видеозаписи; • 5 - товары.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля main_section.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/group
	 */
	public function getMainSection(): int|null
	{
		return $this->read("main_section", "integer");
	}

}
