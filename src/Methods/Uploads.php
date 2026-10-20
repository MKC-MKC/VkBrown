<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\InputFile;
use Haikiri\VkBrown\Objects\Photo;
use Haikiri\VkBrown\Objects\SavedDocument;
use Haikiri\VkBrown\Services\UploadService;

trait Uploads
{
	/**
	 * Загружаем фотографию для отправки сообщением за три запроса VK.
	 *
	 * Получаем upload_url, передаём файл multipart-запросом и вызываем photos.saveMessagesPhoto.
	 * @param InputFile $file Файл, например InputFile::fromPath("photo.png").
	 * @param int|string|null $peerId Диалог назначения; null загружает в скрытый альбом сообщества.
	 * @return list<Photo> Сохранённые фотографии, пригодные для attachment.
	 * @throws VkMainException Ошибка любого этапа загрузки.
	 * @see https://dev.vk.ru/ru/api/upload/photo-in-message
	 */
	public function uploadMessagePhoto(InputFile $file, int|string|null $peerId = null): array
	{
		return (new UploadService($this->api, $this->transport))->messagePhoto($file, $peerId);
	}

	/**
	 * Загружаем документ или голосовое сообщение в диалог и сохраняем его в VK.
	 *
	 * Для отправки используйте doc либо audio_message из результата, в зависимости от type.
	 * @param InputFile $file Файл, например InputFile::fromString("Текст", "report.txt").
	 * @param int|string|null $peerId Диалог назначения.
	 * @param string $type Тип загрузки: doc или audio_message.
	 * @param string|null $title Название сохраняемого документа.
	 * @param array|string|null $tags Метки документа через запятую либо списком.
	 * @return SavedDocument Результат docs.save с полем type и объектом вложения.
	 * @throws VkMainException Ошибка любого этапа загрузки.
	 * @see https://dev.vk.ru/ru/method/docs.getMessagesUploadServer
	 * @see https://dev.vk.ru/ru/method/docs.save
	 */
	public function uploadMessageDocument(InputFile $file, int|string|null $peerId = null, string $type = "doc", ?string $title = null, array|string|null $tags = null): SavedDocument
	{
		return (new UploadService($this->api, $this->transport))->messageDocument($file, $peerId, $type, $title, $tags);
	}
}
