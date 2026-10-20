<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class HistoryAttachments extends ResponseWrapper
{

	/**
	 * Элементы результата в порядке, возвращённом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<HistoryAttachment> Значение поля items.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getItems(): array
	{
		return $this->objects("items", HistoryAttachment::class);
	}

	/**
	 * Указатель следующей страницы; передаётся в start_from.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля next_from.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getNextFrom(): string|null
	{
		return $this->read("next_from", "string");
	}

	/**
	 * Дополнительные объекты пользователей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<User> Значение поля profiles.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getProfiles(): array
	{
		return $this->objects("profiles", User::class);
	}

	/**
	 * Объекты сообществ.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Group> Значение поля groups.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getGroups(): array
	{
		return $this->objects("groups", Group::class);
	}

}
