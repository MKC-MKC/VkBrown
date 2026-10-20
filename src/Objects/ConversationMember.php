<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ConversationMember extends ResponseWrapper
{

	/**
	 * Идентификатор участника беседы, включая отрицательные ID сообществ.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля member_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function getMemberId(): int
	{
		return $this->required("member_id", "integer");
	}

	/**
	 * Можно ли исключить участника из беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_kick.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function canKick(): bool|null
	{
		return $this->read("can_kick", "boolean");
	}

	/**
	 * Ограничена ли возможность участника писать сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_restricted_to_write.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function isRestrictedToWrite(): bool|null
	{
		return $this->read("is_restricted_to_write", "boolean");
	}

	/**
	 * Идентификатор пригласившего участника.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля invited_by.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function getInvitedBy(): int|null
	{
		return $this->read("invited_by", "integer");
	}

	/**
	 * Является ли участник администратором беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_admin.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function isAdmin(): bool|null
	{
		return $this->read("is_admin", "boolean");
	}

	/**
	 * Является ли участник владельцем беседы.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_owner.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function isOwner(): bool|null
	{
		return $this->read("is_owner", "boolean");
	}

	/**
	 * Является ли участие запросом на переписку.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_message_request.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function isMessageRequest(): bool|null
	{
		return $this->read("is_message_request", "boolean");
	}

	/**
	 * Время вступления в беседу в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля join_date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function getJoinDate(): int|null
	{
		return $this->read("join_date", "integer");
	}

	/**
	 * Время запроса на переписку в Unixtime.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля request_date.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function getRequestDate(): int|null
	{
		return $this->read("request_date", "integer");
	}

}
