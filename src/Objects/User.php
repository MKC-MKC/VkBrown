<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

/**
 * User
 * Методы для работы с данными пользователей
 * @see https://dev.vk.ru/ru/reference/objects/user
 */
readonly class User extends ResponseWrapper
{
	use UserOptionalAITrait;
	use UserOptionalLRTrait;
	use UserOptionalSWTrait;

	public function getId(): int
	{
		return (int)$this->getData("id");
	}

	/**
	 * Имя в заданном падеже.
	 * Если не указан падеж, возвращает имя в именительном падеже.
	 *
	 * Возможные значения для `case`:
	 * nom — именительный;
	 * gen — родительный;
	 * dat — дательный;
	 * acc — винительный;
	 * ins — творительный;
	 * abl — предложный.
	 *
	 * @param string|null $case
	 * @return string
	 */
	public function getFirstName(string|null $case = null): string
	{
		if (in_array($case, ["nom", "gen", "dat", "acc", "ins", "abl"])) {
			return (string)$this->getData("first_name_$case", "");
		}

		return (string)$this->getData("first_name");
	}

	/**
	 * Фамилия в заданном падеже.
	 *
	 * Возможные значения для `case`:
	 * nom — именительный;
	 * gen — родительный;
	 * dat — дательный;
	 * acc — винительный;
	 * ins — творительный;
	 * abl — предложный.
	 *
	 * @param string|null $case
	 * @return string
	 */
	public function getLastName(string|null $case = null): string
	{
		if (in_array($case, ["nom", "gen", "dat", "acc", "ins", "abl"])) {
			return (string)$this->getData("last_name_$case", "");
		}

		return (string)$this->getData("last_name");
	}

	/**
	 * Поле возвращается, если страница пользователя удалена или заблокирована, содержит значение deleted или banned.
	 * @return string
	 */
	public function getDeactivated(): string
	{
		return (string)$this->getData("deactivated", "");
	}

	public function isDeleted(): bool
	{
		return ($this->getDeactivated() === "deleted");
	}

	public function isBanned(): bool
	{
		return ($this->getDeactivated() === "banned");
	}

	/**
	 * Скрыт ли профиль пользователя настройками приватности.
	 * @return bool
	 */
	public function isClosed(): bool
	{
		return (bool)$this->getData("is_closed", false);
	}

	/**
	 * Может ли текущий пользователь видеть профиль при $this->isClosed() = true (например, он есть в друзьях).
	 * @return bool
	 */
	public function canAccessClosed(): bool
	{
		return (bool)$this->getData("can_access_closed", false);
	}

}
