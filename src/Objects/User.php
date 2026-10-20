<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Traits\UserStateTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class User extends ResponseWrapper
{

	use UserStateTrait;

	/**
	 * Идентификатор пользователя.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getId(): int
	{
		return $this->required("id", "integer");
	}

	/**
	 * Имя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля first_name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getFirstName(): string|null
	{
		return $this->read("first_name", "string");
	}

	/**
	 * Фамилия.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля last_name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getLastName(): string|null
	{
		return $this->read("last_name", "string");
	}

	/**
	 * Поле возвращается, если страница пользователя удалена или заблокирована, содержит значение deleted или
	 * banned . В этом случае опциональные поля не возвращаются.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля deactivated.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getDeactivated(): string|null
	{
		return $this->read("deactivated", "string");
	}

	/**
	 * Скрыт ли профиль пользователя настройками приватности.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_closed.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function isClosed(): bool|null
	{
		return $this->read("is_closed", "boolean");
	}

	/**
	 * Может ли текущий пользователь видеть профиль при is_closed = 1 (например, он есть в друзьях).
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_access_closed.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function canAccessClosed(): bool|null
	{
		return $this->read("can_access_closed", "boolean");
	}

	/**
	 * Пол. Возможные значения: • 1 - женский; • 2 - мужской; • 0 - пол не указан.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля sex.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getSex(): int|null
	{
		return $this->read("sex", "integer");
	}

	/**
	 * Дата рождения. Возвращается в формате D.M.YYYY или D.M (если год рождения скрыт). Если дата рождения
	 * скрыта целиком, поле отсутствует в ответе.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля bdate.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getBdate(): string|null
	{
		return $this->read("bdate", "string");
	}

	/**
	 * Информация о городе, указанном на странице пользователя в разделе «Контакты». Возвращаются следующие
	 * поля: • id ( integer ) - идентификатор города, который можно использовать для получения его названия с
	 * помощью метода database.getCitiesById ; • title ( string ) - название города.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return City|null Значение поля city.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getCity(): ?City
	{
		return $this->object("city", City::class);
	}

	/**
	 * Информация о стране, указанной на странице пользователя в разделе «Контакты». Возвращаются следующие
	 * поля: • id ( integer ) - идентификатор страны. • title ( string ) - название страны.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return Country|null Значение поля country.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getCountry(): ?Country
	{
		return $this->object("country", Country::class);
	}

	/**
	 * Короткий адрес страницы. Возвращается строка, содержащая короткий адрес страницы (например, andrew ).
	 * Если он не назначен, возвращается "id" + user_id , например, id35828305 .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля domain.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getDomain(): string|null
	{
		return $this->read("domain", "string");
	}

	/**
	 * Короткое имя страницы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля screen_name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getScreenName(): string|null
	{
		return $this->read("screen_name", "string");
	}

	/**
	 * URL квадратной фотографии пользователя, имеющей ширину 50 пикселей. В случае отсутствия у пользователя
	 * фотографии возвращается https://vk.com/images/camera_50.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_50.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhoto50(): string|null
	{
		return $this->read("photo_50", "string");
	}

	/**
	 * URL квадратной фотографии пользователя, имеющей ширину 100 пикселей. В случае отсутствия у
	 * пользователя фотографии возвращается https://vk.com/images/camera_100.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_100.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhoto100(): string|null
	{
		return $this->read("photo_100", "string");
	}

	/**
	 * URL квадратной фотографии, имеющей ширину 200 пикселей. Если у пользователя отсутствует фотография
	 * таких размеров, в ответе вернется https://vk.com/images/camera_200.png
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_200.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhoto200(): string|null
	{
		return $this->read("photo_200", "string");
	}

	/**
	 * URL фотографии пользователя, имеющей ширину 200 пикселей. В случае отсутствия у пользователя
	 * фотографии возвращается https://vk.com/images/camera_200.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_200_orig.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhoto200Orig(): string|null
	{
		return $this->read("photo_200_orig", "string");
	}

	/**
	 * URL фотографии, имеющей ширину 400 пикселей. Если у пользователя отсутствует фотография такого
	 * размера, в ответе вернется https://vk.com/images/camera_400.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_400_orig.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhoto400Orig(): string|null
	{
		return $this->read("photo_400_orig", "string");
	}

	/**
	 * URL квадратной фотографии с максимальной шириной. Может быть возвращена фотография, имеющая ширину как
	 * 200, так и 100 пикселей. В случае отсутствия у пользователя фотографии возвращается
	 * https://vk.com/images/camera_200.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_max.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhotoMax(): string|null
	{
		return $this->read("photo_max", "string");
	}

	/**
	 * URL фотографии максимального размера. Может быть возвращена фотография, имеющая ширину как 400, так и
	 * 200 пикселей. В случае отсутствия у пользователя фотографии возвращается
	 * https://vk.com/images/camera_400.png .
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля photo_max_orig.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getPhotoMaxOrig(): string|null
	{
		return $this->read("photo_max_orig", "string");
	}

	/**
	 * Информация о том, находится ли пользователь сейчас на сайте. Если пользователь использует мобильное
	 * приложение либо мобильную версию, возвращается дополнительное поле online_mobile , содержащее 1 . При
	 * этом, если используется именно приложение, дополнительно возвращается поле online_app , содержащее его
	 * идентификатор.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля online.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function isOnline(): bool|null
	{
		return $this->read("online", "boolean");
	}

	/**
	 * Использует ли пользователь мобильный клиент.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля online_mobile.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function isOnlineMobile(): bool|null
	{
		return $this->read("online_mobile", "boolean");
	}

	/**
	 * Идентификатор приложения, через которое пользователь находится онлайн.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля online_app.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getOnlineApp(): int|null
	{
		return $this->read("online_app", "integer");
	}

	/**
	 * Время последнего посещения. Объект, содержащий следующие поля: • time ( integer ) - время последнего
	 * посещения в формате Unixtime. • platform ( integer ) - тип платформы. Возможные значения: • 1 -
	 * мобильная версия; • 2 - приложение для iPhone; • 3 - приложение для iPad; • 4 - приложение для
	 * Android; • 5 - приложение для Windows Phone; • 6 - приложение для Windows 10; • 7 - полная версия
	 * сайта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля last_seen.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getLastSeen(): array|null
	{
		return $this->read("last_seen", "array");
	}

	/**
	 * Статус пользователя. Возвращается строка, содержащая текст статуса, расположенного в профиле под
	 * именем. Если включена опция «Транслировать в статус играющую музыку», возвращается дополнительное поле
	 * status_audio , содержащее информацию о композиции.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля status.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getStatus(): string|null
	{
		return $this->read("status", "string");
	}

	/**
	 * Содержимое поля «О себе» из профиля.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля about.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getAbout(): string|null
	{
		return $this->read("about", "string");
	}

	/**
	 * Содержимое поля «Деятельность» из профиля.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля activities.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getActivities(): string|null
	{
		return $this->read("activities", "string");
	}

	/**
	 * Содержимое поля «Любимые книги» из профиля пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля books.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getBooks(): string|null
	{
		return $this->read("books", "string");
	}

	/**
	 * Название родного города.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля home_town.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getHomeTown(): string|null
	{
		return $this->read("home_town", "string");
	}

	/**
	 * Содержимое поля «Интересы» из профиля.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля interests.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getInterests(): string|null
	{
		return $this->read("interests", "string");
	}

	/**
	 * Информация о том, установил ли пользователь фотографию для профиля. Возвращаемые значения: 1 -
	 * установил, 0 - не установил.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля has_photo.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function hasPhoto(): bool|null
	{
		return $this->read("has_photo", "boolean");
	}

	/**
	 * Информация о том, может ли текущий пользователь отправить личное сообщение. Возможные значения: • 1 -
	 * может; • 0 - не может.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_write_private_message.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function canWritePrivateMessage(): bool|null
	{
		return $this->read("can_write_private_message", "boolean");
	}

	/**
	 * Количество подписчиков пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля followers_count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getFollowersCount(): int|null
	{
		return $this->read("followers_count", "integer");
	}

	/**
	 * Никнейм (отчество) пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля nickname.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getNickname(): string|null
	{
		return $this->read("nickname", "string");
	}

	/**
	 * Девичья фамилия.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля maiden_name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/user
	 */
	public function getMaidenName(): string|null
	{
		return $this->read("maiden_name", "string");
	}

}
