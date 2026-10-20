<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class ReactionCounter extends ResponseWrapper
{

	/**
	 * Идентификатор реакции VK.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля reaction_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getReactionId(): int
	{
		return $this->required("reaction_id", "integer");
	}

	/**
	 * Число результатов.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля count.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getCount(): int
	{
		return $this->required("count", "integer");
	}

	/**
	 * Идентификаторы пользователей или сообществ, поставивших реакцию.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля user_ids.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getUserIds(): array|null
	{
		return $this->read("user_ids", "array");
	}

}
