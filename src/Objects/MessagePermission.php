<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class MessagePermission extends ResponseWrapper
{

	/**
	 * Разрешил ли пользователь сообщения сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return bool|null Значение поля is_allowed.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/messages.isMessagesFromGroupAllowed
	 */
	public function isAllowed(): bool|null
	{
		return $this->read("is_allowed", "boolean");
	}

}
