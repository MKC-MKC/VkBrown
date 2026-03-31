<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class WallRoute extends AbstractRoute
{

	public function closeComments(array $params = []): mixed
	{
		return $this->request("wall.closeComments", $params);
	}

	public function createComment(array $params = []): mixed
	{
		return $this->request("wall.createComment", $params);
	}

	public function openComments(array $params = []): mixed
	{
		return $this->request("wall.openComments", $params);
	}

}
