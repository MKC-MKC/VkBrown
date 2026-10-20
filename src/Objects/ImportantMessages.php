<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ImportantMessages extends ResponseWrapper
{

	/**
	 * Вложенный результат выборки сообщений с count и items.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return MessageList|null Значение поля messages.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getImportantMessages
	 */
	public function getMessages(): ?MessageList
	{
		return $this->object("messages", MessageList::class);
	}

	/**
	 * Дополнительные объекты пользователей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<User> Значение поля profiles.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getImportantMessages
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
	 * @see https://dev.vk.ru/ru/method/messages.getImportantMessages
	 */
	public function getGroups(): array
	{
		return $this->objects("groups", Group::class);
	}

}
