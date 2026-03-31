<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class WallRoute extends AbstractRoute
{

	/**
	 * Метод закрывает комментарии к записи на стене.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function closeComments(array $params = []): mixed
	{
		return $this->request("wall.closeComments", $params);
	}

	/**
	 * Метод создаёт комментарий к записи на стене.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function createComment(array $params = []): mixed
	{
		return $this->request("wall.createComment", $params);
	}

	/**
	 * Метод открывает комментарии к записи на стене.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function openComments(array $params = []): mixed
	{
		return $this->request("wall.openComments", $params);
	}

}
