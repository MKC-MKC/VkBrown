<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Helper\EndpointHelper;
use Haikiri\VkBrown\Objects\InputFile;
use Haikiri\VkBrown\Objects\Photo;
use Haikiri\VkBrown\Objects\SavedDocument;
use Haikiri\VkBrown\Objects\UploadDocument;
use Haikiri\VkBrown\Objects\UploadPhoto;
use Haikiri\VkBrown\Objects\UploadServer;

final readonly class UploadService
{

	public function __construct(private ApiRequestService $api, private HttpTransport $transport)
	{
	}

	/**
	 * Загружаем фотографию для сообщения: получаем сервер, отправляем файл и сохраняем результат.
	 * При указанном peer_id фотография предназначена этому диалогу. Без peer_id VK использует скрытый
	 * альбом сообщества; сохранённое вложение можно передать в messages.send.
	 * @param InputFile $file Локальный файл или байты изображения.
	 * @param int|string|null $peerId Назначение фотографии либо null для альбома сообщества.
	 * @return list<Photo> Сохранённые фотографии VK с owner_id, id и access_key, если он возвращён.
	 * @throws VkMainException Ошибка любого из трёх этапов загрузки.
	 * @see https://dev.vk.ru/ru/api/upload/photo-in-message
	 * @see https://dev.vk.ru/ru/method/photos.saveMessagesPhoto
	 */
	public function messagePhoto(InputFile $file, int|string|null $peerId): array
	{
		$server = ResponseHydrator::model($this->api->request("photos.getMessagesUploadServer", ["peer_id" => $peerId]), UploadServer::class);
		$uploaded = new UploadPhoto($this->upload($server->getUploadUrl(), "photo", $file));
		if ($uploaded->getPhoto() === "[]") throw new VkResponseException("VK не принял загружаемую фотографию.");
		return ResponseHydrator::models(
			response: $this->api->request(
				method: "photos.saveMessagesPhoto",
				params: [
					"server" => $uploaded->getServer(),
					"photo" => $uploaded->getPhoto(),
					"hash" => $uploaded->getHash(),
				],
			),
			class: Photo::class,
		);
	}

	/**
	 * Загружаем документ или голосовое сообщение и сохраняем его методом docs.save.
	 * Тип doc возвращает объект doc, тип audio_message - объект audio_message. Состав результата не подменяется.
	 * @param InputFile $file Файл с корректным расширением для выбранного типа.
	 * @param int|string|null $peerId Идентификатор назначения.
	 * @param string $type Тип загрузки, поддерживаемый docs.getMessagesUploadServer.
	 * @param string|null $title Название документа; null оставляет выбор VK.
	 * @param array|string|null $tags Метки документа для docs.save.
	 * @return SavedDocument Результат с type и соответствующим объектом файла.
	 * @throws VkMainException Ошибка получения сервера, загрузки или сохранения.
	 * @see https://dev.vk.ru/ru/method/docs.getMessagesUploadServer
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function messageDocument(InputFile $file, int|string|null $peerId, string $type, ?string $title, array|string|null $tags): SavedDocument
	{
		$server = ResponseHydrator::model(
			response: $this->api->request(
				method: "docs.getMessagesUploadServer",
				params: [
					"type" => $type,
					"peer_id" => $peerId,
				],
			),
			class: UploadServer::class,
		);

		$uploaded = new UploadDocument($this->upload($server->getUploadUrl(), "file", $file));
		return ResponseHydrator::model(
			response: $this->api->request(
				method: "docs.save",
				params: [
					"file" => $uploaded->getFile(),
					"title" => $title,
					"tags" => $tags,
				],
			),
			class: SavedDocument::class,
		);
	}

	/**
	 * Отправляем один файл на адрес, выданный методом получения сервера загрузки VK.
	 * Адрес содержит собственную авторизацию; Bearer и заголовки клиента API не передаются.
	 * Границу multipart создаёт Guzzle. Владение потоком остаётся у этого сервиса.
	 * @param string $url upload_url из ответа VK.
	 * @param string $field Имя поля по протоколу загрузки: photo или file.
	 * @param InputFile $file Загружаемый файл.
	 * @return array<string, mixed> Исходный JSON-объект сервера загрузки, без обёртки response.
	 * @throws VkMainException Некорректный адрес, ошибка HTTP или JSON.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function upload(string $url, string $field, InputFile $file): array
	{
		EndpointHelper::validate($url);
		$stream = $file->openStream();
		try {
			$options = $this->api->getRequestOptions();
			$options["headers"] = null;
			$options["multipart"] = [["name" => $field, "contents" => $stream, "filename" => $file->getFilename()]];
			$body = $this->transport->request("POST", $url, $options);
			if (isset($body["error"])) ResponseDecoder::decodeApi($body);
			return $body;
		} finally {
			if (is_resource($stream)) fclose($stream);
		}
	}

}
