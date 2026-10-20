<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class WallCommentIdentifier extends ResponseWrapper
{

	/**
	 * Идентификатор созданного комментария.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля comment_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/wall.createComment
	 */
	public function getCommentId(): int|null
	{
		return $this->read("comment_id", "integer");
	}

	/**
	 * Цепочка идентификаторов родительских комментариев.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля parents_stack.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/wall.createComment
	 */
	public function getParentsStack(): array|null
	{
		return $this->read("parents_stack", "array");
	}

}
