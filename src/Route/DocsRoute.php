<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class DocsRoute extends AbstractRoute
{

	public function getById(array $params = []): mixed
	{
		return $this->request("docs.getById", $params, ["docs"]);
	}

	public function getMessagesUploadServer(array $params = []): mixed
	{
		return $this->request("docs.getMessagesUploadServer", $params);
	}

	public function getWallUploadServer(array $params = []): mixed
	{
		return $this->request("docs.getWallUploadServer", $params);
	}

	public function save(array $params = []): mixed
	{
		return $this->request("docs.save", $params, ["tags"]);
	}

	public function search(array $params = []): mixed
	{
		return $this->request("docs.search", $params);
	}

}
