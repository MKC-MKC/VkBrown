<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ConversationByIdList extends ResponseWrapper
{

	/**
	 * Число результатов.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationsById
	 */
	public function getCount(): int|null
	{
		return $this->read("count", "integer");
	}

	/**
	 * Элементы результата в порядке, возвращённом VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<Conversation> Значение поля items.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationsById
	 */
	public function getItems(): array
	{
		return $this->objects("items", Conversation::class);
	}

	/**
	 * Дополнительные объекты пользователей.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<User> Значение поля profiles.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationsById
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
	 * @see https://dev.vk.ru/ru/method/messages.getConversationsById
	 */
	public function getGroups(): array
	{
		return $this->objects("groups", Group::class);
	}

}
