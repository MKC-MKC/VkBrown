<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use DateTime;
use Exception;

trait UserOptionalAITrait
{

	/**
	 * Содержимое поля «О себе» из профиля.
	 * @return string|null
	 */
	public function getAbout(): string|null
	{
		return $this->getData("about");
	}

	/**
	 * Содержимое поля «Деятельность» из профиля.
	 * @return string|null
	 */
	public function getActivities(): string|null
	{
		return $this->getData("activities");
	}

	/**
	 * Дата рождения. Возвращается в формате D.M.YYYY или D. M (если год рождения скрыт).
	 * Если дата рождения скрыта целиком, возвращаем null.
	 * @noinspection SpellCheckingInspection
	 * @return DateTime|null
	 */
	public function getBirthDay(): DateTime|null
	{
		$bd = $this->getData("bdate");
		if (!$bd) return null;

		try {
			return DateTime::createFromFormat("d.m.Y", $bd) ?: DateTime::createFromFormat("d.m", $bd);
		} catch (Exception) {
			return null;
		}
	}

	/**
	 * Информация о том, находится ли текущий пользователь в черном списке.
	 * @return bool
	 */
	public function isBlacklisted(): bool
	{
		return (bool)$this->getData("blacklisted", false);
	}

	/**
	 * Информация о том, находится ли пользователь в черном списке у текущего пользователя.
	 * @return bool
	 */
	public function isBlacklistedByMe(): bool
	{
		return (bool)$this->getData("blacklisted_by_me", false);
	}

	/**
	 * Содержимое поля «Любимые книги» из профиля пользователя.
	 * @return string|null
	 */
	public function getBooks(): string|null
	{
		return $this->getData("books");
	}

	/**
	 * Информация о том, может ли текущий пользователь оставлять записи на стене.
	 * @return bool
	 */
	public function canPost(): bool
	{
		return (bool)$this->getData("can_post", false);
	}

	/**
	 * Информация о том, может ли текущий пользователь видеть чужие записи на стене.
	 * @return bool
	 */
	public function canSeeAllPosts(): bool
	{
		return (bool)$this->getData("can_see_all_posts", false);
	}

	/**
	 * Информация о том, может ли текущий пользователь видеть аудиозаписи.
	 * @return bool
	 */
	public function canSeeAudio(): bool
	{
		return (bool)$this->getData("can_see_audio", false);
	}

	/**
	 * Информация о том, будет ли отправлено уведомление пользователю о заявке в друзья от текущего пользователя.
	 * @return bool
	 */
	public function canSendFriendRequest(): bool
	{
		return (bool)$this->getData("can_send_friend_request", false);
	}

	/**
	 * Информация о том, может ли текущий пользователь отправить личное сообщение.
	 * @return bool
	 */
	public function canWritePrivateMessage(): bool
	{
		return (bool)$this->getData("can_write_private_message", false);
	}

	/**
	 * Информация о городе, указанном на странице пользователя в разделе «Контакты».
	 * @return City
	 */
	public function getCity(): object
	{
		$data = (array)$this->getData("city", []);
		return new City($data);
	}

	/**
	 * Количество общих друзей с текущим пользователем.
	 * @return int
	 */
	public function getCommonFriendsCount(): int
	{
		return (int)$this->getData("common_count", 0);
	}


	/**
	 * Короткий адрес страницы. Возвращается строка, содержащая короткий адрес страницы (например, andrew).
	 * Если он не назначен, возвращается "id"+user_id, например, id35828305.
	 * @return string
	 */
	public function getDomain(): string
	{
		return (string)$this->getData("domain", "");
	}
}
