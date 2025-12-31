<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

trait UserOptionalSWTrait
{
	const SEX_UNKNOWN = 0;
	const SEX_FEMALE = 1;
	const SEX_MALE = 2;

	/**
	 * Короткое имя страницы.
	 * @return string|null
	 * @see https://dev.vk.ru/ru/reference/objects/user#screen_name
	 */
	public function getScreenName(): string|null
	{
		return $this->getData("screen_name");
	}

	/**
	 * Пол пользователя.
	 *
	 * Возвращается одно из значений:
	 * 0 — пол не указан;
	 * 1 — женский;
	 * 2 — мужской.
	 *
	 * @return int
	 * @see https://dev.vk.ru/ru/reference/objects/user#sex
	 */
	public function getSex(): int
	{
		return (int)$this->getData("sex", self::SEX_UNKNOWN);
	}

	/**
	 * Статус пользователя. Возвращается строка, содержащая текст статуса, расположенного в профиле под именем.
	 * Если включена опция «Транслировать в статус играющую музыку»,
	 * возвращается дополнительное поле status_audio, содержащее информацию о композиции.
	 * @return string
	 * @see https://dev.vk.ru/ru/reference/objects/user#status
	 */
	public function getUserStatus(): string
	{
		return (string)$this->getData("status");
	}

}
