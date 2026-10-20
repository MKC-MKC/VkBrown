<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use GuzzleHttp\ClientInterface;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Exceptions\VkTransportException;
use Throwable;

final readonly class HttpTransport
{

	public function __construct(private ClientInterface $client)
	{
	}

	/**
	 * Выполняем один HTTP-запрос VK без автоматических повторов и перенаправлений.
	 * Bearer нужен только API-запросам; загрузка файла и Long Poll получают собственные параметры.
	 * @param string $method HTTP-метод: POST для API/загрузки или GET для Long Poll.
	 * @param string $url Адрес запроса, например https://api.vk.ru/method/users.get.
	 * @param array<string, mixed> $options Настройки Guzzle: form_params, multipart, query и тайм-ауты.
	 * @return array<string, mixed> JSON-объект ответа.
	 * @throws VkTransportException Сбой соединения или HTTP-ошибка без корректной ошибки VK.
	 * @throws VkResponseException Успешный HTTP-ответ не содержит корректного JSON-объекта.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function request(string $method, string $url, array $options): array
	{
		# Запрещаем перенос Authorization на другой сервер при перенаправлении.
		$options["http_errors"] = false;
		$options["allow_redirects"] = false;
		$options["auth"] = null;

		try {
			$response = $this->client->request($method, $url, $options);
		} catch (Throwable) {
			throw new VkTransportException("Не удалось выполнить HTTP-запрос VK.");
		}

		$status = $response->getStatusCode();
		$body = (string)$response->getBody();
		if ($status < 200 || $status >= 300) {
			try {
				$error = ResponseDecoder::decodeObject($body);
			} catch (VkResponseException) {
				throw new VkTransportException("VK вернул HTTP $status.", $status);
			}

			if (isset($error["error"])) ResponseDecoder::decodeApi($error);
			throw new VkTransportException("VK вернул HTTP $status.", $status);
		}

		return ResponseDecoder::decodeObject($body);
	}

}
