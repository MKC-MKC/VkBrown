<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class DeletedConversation extends ResponseWrapper
{

	/**
	 * Идентификатор последнего удалённого сообщения.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля last_deleted_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.deleteConversation
	 */
	public function getLastDeletedId(): int|null
	{
		return $this->read("last_deleted_id", "integer");
	}

}
