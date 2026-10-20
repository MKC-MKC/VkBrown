<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class PeerReaction extends ResponseWrapper
{

	/**
	 * Идентификатор пользователя.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля user_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getReactedPeers
	 */
	public function getUserId(): int
	{
		return $this->required("user_id", "integer");
	}

	/**
	 * Идентификатор реакции VK.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля reaction_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getReactedPeers
	 */
	public function getReactionId(): int
	{
		return $this->required("reaction_id", "integer");
	}

}
