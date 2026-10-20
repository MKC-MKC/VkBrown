<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupTag extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTagList
	 */
	public function getId(): int
	{
		return $this->required("id", "integer");
	}

	/**
	 * Название объекта.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля name.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTagList
	 */
	public function getName(): string
	{
		return $this->required("name", "string");
	}

	/**
	 * Цвет тега в шестнадцатеричном формате без #.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля color.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTagList
	 */
	public function getColor(): string
	{
		return $this->required("color", "string");
	}

	/**
	 * Количество использований тега.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля uses.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getTagList
	 */
	public function getUses(): int|null
	{
		return $this->read("uses", "integer");
	}

}
