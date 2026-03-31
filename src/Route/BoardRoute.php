<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class BoardRoute extends AbstractRoute
{

	/**
	 * Метод удаляет комментарий в обсуждении сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteComment(array $params = []): mixed
	{
		return $this->request("board.deleteComment", $params);
	}

	/**
	 * Метод восстанавливает комментарий в обсуждении сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function restoreComment(array $params = []): mixed
	{
		return $this->request("board.restoreComment", $params);
	}

}
