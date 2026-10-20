<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class MessageReactionCounters extends ResponseWrapper
{

	/**
	 * Идентификатор сообщения внутри диалога, conversation_message_id.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля cmid.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getCmid(): int
	{
		return $this->required("cmid", "integer");
	}

	/**
	 * Счётчики реакций на сообщение.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return list<ReactionCounter> Значение поля counters.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getCounters(): array
	{
		return $this->objects("counters", ReactionCounter::class);
	}

}
