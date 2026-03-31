<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

use Haikiri\VkBrown\Helper\UploadSaveResponseNormalizer;

class DocsRoute extends AbstractRoute
{

	/**
	 * Метод возвращает документы по их идентификаторам.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getById(array $params = []): mixed
	{
		return $this->request("docs.getById", $params, ["docs"]);
	}

	/**
	 * Метод возвращает upload-сервер для отправки документа в сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getMessagesUploadServer(array $params = []): mixed
	{
		return $this->request("docs.getMessagesUploadServer", $params);
	}

	/**
	 * Метод возвращает upload-сервер для загрузки документа на стену.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getWallUploadServer(array $params = []): mixed
	{
		return $this->request("docs.getWallUploadServer", $params);
	}

	/**
	 * Метод сохраняет загруженный документ.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function save(array $params = []): mixed
	{
		return UploadSaveResponseNormalizer::normalizeDocsSaveResponse(
			$this->request("docs.save", $params, ["tags"]),
		);
	}

	/**
	 * Метод выполняет поиск документов.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function search(array $params = []): mixed
	{
		return $this->request("docs.search", $params);
	}

}
