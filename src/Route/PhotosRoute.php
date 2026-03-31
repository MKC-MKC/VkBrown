<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class PhotosRoute extends AbstractRoute
{

	public function getChatUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getChatUploadServer", $params);
	}

	public function getMessagesUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getMessagesUploadServer", $params);
	}

	public function getOwnerCoverPhotoUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getOwnerCoverPhotoUploadServer", $params);
	}

	public function saveMessagesPhoto(array $params = []): mixed
	{
		return $this->request("photos.saveMessagesPhoto", $params);
	}

	public function saveOwnerCoverPhoto(array $params = []): mixed
	{
		return $this->request("photos.saveOwnerCoverPhoto", $params);
	}

}
