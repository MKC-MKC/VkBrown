<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class BoardRoute extends AbstractRoute
{

	public function deleteComment(array $params = []): mixed
	{
		return $this->request("board.deleteComment", $params);
	}

	public function restoreComment(array $params = []): mixed
	{
		return $this->request("board.restoreComment", $params);
	}

}
