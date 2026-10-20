<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class GroupMembership extends ResponseWrapper
{

	/**
	 * Идентификатор пользователя.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля user_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function getUserId(): int|null
	{
		return $this->read("user_id", "integer");
	}

	/**
	 * Является ли пользователь участником сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля member.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function isMember(): bool|null
	{
		return $this->read("member", "boolean");
	}

	/**
	 * Приглашён ли пользователь в сообщество.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля invitation.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function isInvitation(): bool|null
	{
		return $this->read("invitation", "boolean");
	}

	/**
	 * Подал ли пользователь заявку на вступление.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля request.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function isRequest(): bool|null
	{
		return $this->read("request", "boolean");
	}

	/**
	 * Можно ли пригласить пользователя в сообщество.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_invite.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function canInvite(): bool|null
	{
		return $this->read("can_invite", "boolean");
	}

	/**
	 * Можно ли отозвать отправленное приглашение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля can_recall.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function canRecall(): bool|null
	{
		return $this->read("can_recall", "boolean");
	}

}
