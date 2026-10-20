<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\Document;
use Haikiri\VkBrown\Objects\DocumentList;
use Haikiri\VkBrown\Objects\SavedDocument;
use Haikiri\VkBrown\Objects\UploadServer;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Documents
{

	/**
	 * Возвращает информацию о документах по их идентификаторам.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string $docs Идентификаторы документов, информацию о которых нужно вернуть, в формате
	 * <owner_id>_<doc_id> . Пример значения docs : 66748_91488,66748_91455 Метод поддерживает передачу access_key
	 * . Обязательный параметр
	 * @param bool|null $returnTags 1 - добавить в ответ массив меток документа.
	 * @return list<Document> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/docs.getById
	 */
	public function getDocumentsById(
		array|string $docs,
		bool|null    $returnTags = null,
	): array
	{
		$params = [
			"docs" => $docs,
			"return_tags" => $returnTags,
		];

		$response = $this->sendRequest("docs.getById", $params);
		return ResponseHydrator::models($response, Document::class);
	}

	/**
	 * Метод получает адрес сервера для загрузки файла в личное сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string|null $type Необязательный параметр. Тип файла. Возможные значения: • doc - обычный файл. •
	 * audio_message - голосовое сообщение.
	 * @param int|string|null $peerId Необязательный параметр. Идентификатор назначения. Возможные значения: • Для
	 * пользователя: {ИДЕНТИФИКАТОР_ПОЛЬЗОВАТЕЛЯ} . • Для групповой беседы: 2000000000 + {ИДЕНТИФИКАТОР_БЕСЕДЫ} . •
	 * Для сообщества: -{ИДЕНТИФИКАТОР_СООБЩЕСТВА} .
	 * @return UploadServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/docs.getMessagesUploadServer
	 */
	public function getMessageDocumentUploadServer(
		string|null     $type = null,
		int|string|null $peerId = null,
	): UploadServer
	{
		$params = [
			"type" => $type,
			"peer_id" => $peerId,
		];

		$response = $this->sendRequest("docs.getMessagesUploadServer", $params);
		return ResponseHydrator::model($response, UploadServer::class);
	}

	/**
	 * Метод получает адрес сервера для загрузки документа в папку Отправленные для последующей отправки документа
	 * на стену или личным сообщением.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Необязательный параметр. Идентификатор сообщества, если необходимо загрузить
	 * файл в список файлов сообщества. Если файл нужно загрузить в список пользователя, метод вызывается без
	 * дополнительных параметров. Если не указан, используется сообщество сервера.
	 * @return UploadServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/docs.getWallUploadServer
	 */
	public function getWallDocumentUploadServer(
		int|string|null $groupId = null,
	): UploadServer
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("docs.getWallUploadServer", $params);
		return ResponseHydrator::model($response, UploadServer::class);
	}

	/**
	 * Метод сохраняет файл после его успешной загрузки на сервер .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $file Обязательный параметр. Файл в формате multipart/form-data . Параметр возвращается в
	 * результате загрузки файла на сервер . Обязательный параметр
	 * @param string|null $title Название файла.
	 * @param array|string|null $tags Метки для поиска, которые будут добавлены к документу.
	 * @param bool|null $returnTags 1 - добавить в ответ массив меток документа.
	 * @return SavedDocument Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function saveDocument(
		string            $file,
		string|null       $title = null,
		array|string|null $tags = null,
		bool|null         $returnTags = null,
	): SavedDocument
	{
		$params = [
			"file" => $file,
			"title" => $title,
			"tags" => $tags,
			"return_tags" => $returnTags,
		];

		$response = $this->sendRequest("docs.save", $params);
		return ResponseHydrator::model($response, SavedDocument::class);
	}

	/**
	 * Ищем документы по заданной строке.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string|null $q Строка поискового запроса.
	 * @param bool|null $searchOwn Искать только среди собственных документов.
	 * @param int|null $count Количество результатов на странице.
	 * @param int|null $offset Смещение относительно начала списка.
	 * @param bool|null $returnTags Добавить метки документа в ответ метода.
	 * @return DocumentList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/docs.search
	 */
	public function searchDocuments(
		string|null $q = null,
		bool|null   $searchOwn = null,
		int|null    $count = null,
		int|null    $offset = null,
		bool|null   $returnTags = null,
	): DocumentList
	{
		$params = [
			"q" => $q,
			"search_own" => $searchOwn,
			"count" => $count,
			"offset" => $offset,
			"return_tags" => $returnTags,
		];

		$response = $this->sendRequest("docs.search", $params);
		return ResponseHydrator::model($response, DocumentList::class);
	}

}
