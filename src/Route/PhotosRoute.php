<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

use Haikiri\VkBrown\Helper\UploadSaveResponseNormalizer;

class PhotosRoute extends AbstractRoute
{

	/**
	 * Метод возвращает upload-сервер для обложки беседы.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getChatUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getChatUploadServer", $params);
	}

	/**
	 * Метод возвращает upload-сервер для отправки фото в сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getMessagesUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getMessagesUploadServer", $params);
	}

	/**
	 * Метод возвращает upload-сервер для обложки сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getOwnerCoverPhotoUploadServer(array $params = []): mixed
	{
		return $this->request("photos.getOwnerCoverPhotoUploadServer", $params);
	}

	/**
	 * Метод сохраняет фото, загруженное для сообщений.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function saveMessagesPhoto(array $params = []): mixed
	{
		return UploadSaveResponseNormalizer::normalizeListResponse(
			$this->request("photos.saveMessagesPhoto", $params),
		);
	}

	/**
	 * Метод сохраняет обложку сообщества после загрузки.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function saveOwnerCoverPhoto(array $params = []): mixed
	{
		return $this->request("photos.saveOwnerCoverPhoto", $params);
	}

}
