<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\Photo;
use Haikiri\VkBrown\Objects\PhotoCover;
use Haikiri\VkBrown\Objects\UploadServer;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Photos
{

	/**
	 * Метод получает адрес сервера для загрузки обложки чата .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $chatId Обязательный параметр. Идентификатор беседы, для которой нужно загрузить
	 * фотографию. Если вы вызываете метод с ключом доступа сообщества, этот параметр равен peer_id - 2000000000 .
	 * peer_id нужной беседы можно узнать перебором бесед с помощью метода messages.getConversationsById либо с
	 * помощью Callback- или Longpoll-события message_new . Обязательный параметр
	 * @param int|null $cropX Необязательный параметр. Координата x для обрезки фотографии (правый верхний угол).
	 * @param int|null $cropY Необязательный параметр. Координата y для обрезки фотографии (правый верхний угол).
	 * @param int|null $cropWidth Необязательный параметр. Ширина фотографии после обрезки в пикселях.
	 * @return UploadServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/photos.getChatUploadServer
	 */
	public function getChatPhotoUploadServer(
		int|string $chatId,
		int|null   $cropX = null,
		int|null   $cropY = null,
		int|null   $cropWidth = null,
	): UploadServer
	{
		$params = [
			"chat_id" => $chatId,
			"crop_x" => $cropX,
			"crop_y" => $cropY,
			"crop_width" => $cropWidth,
		];

		$response = $this->sendRequest("photos.getChatUploadServer", $params);
		return ResponseHydrator::model($response, UploadServer::class);
	}

	/**
	 * Метод получает адрес сервера для загрузки фотографии в личное сообщение пользователя или в сообщение
	 * сообщества. Примечание. Убедитесь, что вы включили сообщения в сообществе. Для этого: 1. Войдите ВКонтакте
	 * под своей учётной записью. 2. Откройте сообщество, где вы являетесь администратором. 3. Нажмите на кнопку
	 * Управление . 4. Нажмите на кнопку Сообщения . 5. Убедитесь, что в блоке Сообщения сообщества включён режим
	 * Включены . 6. Нажмите на кнопку Сохранить .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @return UploadServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/photos.getMessagesUploadServer
	 */
	public function getMessagePhotoUploadServer(
		int|string|null $peerId = null,
	): UploadServer
	{
		$params = [
			"peer_id" => $peerId,
		];

		$response = $this->sendRequest("photos.getMessagesUploadServer", $params);
		return ResponseHydrator::model($response, UploadServer::class);
	}

	/**
	 * Метод получает адрес сервера для загрузки обложки сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Обязательный параметр. Идентификатор сообщества. Обязательный параметр Если
	 * не указан, используется сообщество сервера.
	 * @param int|null $cropX Необязательный параметр. Координата X верхнего левого угла для обрезки фотографии.
	 * @param int|null $cropY Необязательный параметр. Координата Y верхнего левого угла для обрезки фотографии.
	 * @param int|null $cropX2 Необязательный параметр. Координата X нижнего правого угла для обрезки изображения.
	 * @param int|null $cropY2 Необязательный параметр. Координата Y нижнего правого угла для обрезки изображения.
	 * @param bool|null $isVideoCover Сохранять или загружать видеообложку сообщества.
	 * @return UploadServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/photos.getOwnerCoverPhotoUploadServer
	 */
	public function getGroupCoverPhotoUploadServer(
		int|string|null $groupId = null,
		int|null        $cropX = null,
		int|null        $cropY = null,
		int|null        $cropX2 = null,
		int|null        $cropY2 = null,
		bool|null       $isVideoCover = null,
	): UploadServer
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"crop_x" => $cropX,
			"crop_y" => $cropY,
			"crop_x2" => $cropX2,
			"crop_y2" => $cropY2,
			"is_video_cover" => $isVideoCover,
		];

		$response = $this->sendRequest("photos.getOwnerCoverPhotoUploadServer", $params);
		return ResponseHydrator::model($response, UploadServer::class);
	}

	/**
	 * Метод сохраняет фотографию в личном сообщении после её успешной загрузки на сервер .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $photo Обязательный параметр. Фотография в формате multipart/form-data . Параметр возвращается
	 * в результате загрузки фотографии на сервер . Обязательный параметр
	 * @param int|null $server Обязательный параметр. Идентификатор сервера, на который загружена фотография.
	 * Параметр возвращается в результате загрузки фотографии на сервер .
	 * @param string|null $hash Обязательный параметр. Хеш фотографии. Параметр возвращается в результате загрузки
	 * фотографии на сервер .
	 * @return list<Photo> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/photos.saveMessagesPhoto
	 */
	public function saveMessagePhoto(
		string      $photo,
		int|null    $server = null,
		string|null $hash = null,
	): array
	{
		$params = [
			"photo" => $photo,
			"server" => $server,
			"hash" => $hash,
		];

		$response = $this->sendRequest("photos.saveMessagesPhoto", $params);
		return ResponseHydrator::models($response, Photo::class);
	}

	/**
	 * Сохраняем обложку сообщества после загрузки на сервер.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|null $cropX Координата X области обрезки изображения.
	 * @param int|null $cropHeight Высота области обрезки изображения в пикселях.
	 * @param int|null $cropY Координата Y области обрезки изображения.
	 * @param int|null $cropWidth Ширина области обрезки изображения в пикселях.
	 * @param array|string|null $responseJson JSON-ответ сервера загрузки видеообложки, необходимый для сохранения.
	 * @param string|null $hash Подпись hash, возвращённая сервером загрузки.
	 * @param string|null $photo Служебные данные фотографии из ответа сервера загрузки; передаются без повторного
	 * JSON-кодирования.
	 * @param bool|null $isVideoCover Сохранять или загружать видеообложку сообщества.
	 * @return PhotoCover Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/photos.saveOwnerCoverPhoto
	 */
	public function saveGroupCoverPhoto(
		int|null          $cropX = null,
		int|null          $cropHeight = null,
		int|null          $cropY = null,
		int|null          $cropWidth = null,
		array|string|null $responseJson = null,
		string|null       $hash = null,
		string|null       $photo = null,
		bool|null         $isVideoCover = null,
	): PhotoCover
	{
		$params = [
			"crop_x" => $cropX,
			"crop_height" => $cropHeight,
			"crop_y" => $cropY,
			"crop_width" => $cropWidth,
			"response_json" => $responseJson,
			"hash" => $hash,
			"photo" => $photo,
			"is_video_cover" => $isVideoCover,
		];

		$response = $this->sendRequest("photos.saveOwnerCoverPhoto", $params);
		return ResponseHydrator::model($response, PhotoCover::class);
	}

}
