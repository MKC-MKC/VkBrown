<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class CreateChatResult extends ResponseWrapper
{

	/**
	 * Идентификатор беседы без смещения 2000000000.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля chat_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.createChat
	 */
	public function getChatId(): int|null
	{
		return $this->read("chat_id", "integer");
	}

	/**
	 * Идентификаторы диалогов или успешно добавленных участников.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля peer_ids.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.createChat
	 */
	public function getPeerIds(): array|null
	{
		return $this->read("peer_ids", "array");
	}

}
