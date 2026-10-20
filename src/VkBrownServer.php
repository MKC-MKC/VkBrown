<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Exceptions\VkMainException;

class VkBrownServer extends VkBrownServerAbstract
{
	/**
	 * Отправляем API-запрос через общий транспорт выбранной версии.
	 * В отличие от предметных методов, возвращаем полный Response для явного чтения результата и конверта.
	 * @param string $method Полное имя метода VK, например messages.send.
	 * @param array<string, mixed> $params Параметры с именами VK.
	 * @param array<string, string> $headers Дополнительные заголовки, например Content-Type => multipart/form-data.
	 * @return Response Проверенный результат запроса.
	 * @throws VkMainException Ошибка сети, HTTP, JSON или VK API.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function sendRequest(string $method, array $params = [], array $headers = []): Response
	{
		return $this->api->request($method, $params, $headers);
	}
}
