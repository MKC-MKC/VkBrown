<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Api\ApiContractInterface;
use Haikiri\VkBrown\Builders\MultipartRequestBuilder;
use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Normalizers\ParameterNormalizer;
use Haikiri\VkBrown\Response;
use InvalidArgumentException;

final class ApiRequestService
{

	private float $timeout = 30;
	private float $connectTimeout = 10;

	public function __construct(
		private readonly string               $token,
		private readonly ApiContractInterface $contract,
		private readonly HttpTransport        $transport,
		private readonly string               $url = "https://api.vk.ru",
		private readonly ?string              $proxy = null,
		private readonly bool                 $debug = false,
	)
	{
		if ($token === "" || str_contains($token, "\r") || str_contains($token, "\n")) {
			throw new InvalidArgumentException("Необходимо передать ключ доступа сообщества.");
		}

		$parsed = parse_url($url);
		if (!is_array($parsed) || empty($parsed["host"]) || isset($parsed["user"]) || isset($parsed["pass"])
			|| isset($parsed["query"]) || isset($parsed["fragment"])
			|| !in_array($parsed["scheme"] ?? "", ["https", "http"], true)) {
			throw new InvalidArgumentException("Некорректный базовый адрес VK API.");
		}
	}

	/**
	 * Выполняем API-метод с Bearer-авторизацией и обязательным параметром версии v.
	 * По умолчанию используем application/x-www-form-urlencoded. Если размер закодированных
	 * параметров превышает 2 Кбайт, передаём их как multipart/form-data, как рекомендует VK.
	 * @param string $method Имя метода, например messages.send.
	 * @param array<string, mixed> $params Параметры с именами VK; null означает отсутствие параметра.
	 * @param array<string, string> $headers Дополнительные заголовки; Content-Type может явно выбрать multipart.
	 * @return Response Конверт ответа и результат API-метода.
	 * @throws InvalidArgumentException Переданы несовместимые версия, авторизация или Content-Type.
	 * @throws VkMainException Ошибка транспорта, JSON или VK API.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function request(string $method, array $params = [], array $headers = []): Response
	{
		$definitions = $this->contract->getParameters($method);
		if (array_key_exists("access_token", $params)) {
			throw new InvalidArgumentException("Ключ доступа передаётся в заголовке Authorization.");
		}

		if (isset($params["v"]) && $params["v"] !== $this->contract->getVersion()) {
			throw new InvalidArgumentException("Параметр v не совпадает с выбранным контрактом API.");
		}

		$multipart = false;
		foreach ($headers as $name => $value) {
			if (!is_string($name)) {
				throw new InvalidArgumentException("Заголовки передаются словарём имя => значение.");
			}

			if (strtolower($name) === "authorization") {
				throw new InvalidArgumentException("Authorization определяется ключом сервера.");
			}

			if (strtolower($name) !== "content-type") {
				continue;
			}

			$mime = strtolower(trim(explode(";", $value, 2)[0]));
			if (!in_array($mime, ["application/x-www-form-urlencoded", "multipart/form-data"], true)) {
				throw new InvalidArgumentException("VK API принимает только form-urlencoded и multipart/form-data.");
			}

			$multipart = $mime === "multipart/form-data";
			unset($headers[$name]);
		}

		$params["v"] = $this->contract->getVersion();
		$params = ParameterNormalizer::normalize($params, $definitions);
		$multipart = $multipart || strlen(http_build_query($params, "", "&", PHP_QUERY_RFC3986)) > 2048;
		$options = $this->getRequestOptions();
		$options["headers"] = $headers + ["Authorization" => "Bearer " . $this->token];
		$options[$multipart ? "multipart" : "form_params"] = $multipart ? MultipartRequestBuilder::build($params) : $params;
		$base = rtrim($this->url, "/");
		$url = $base . (str_ends_with($base, "/method") ? "/" : "/method/") . $method;

		if ($this->debug) error_log("VK API " . $this->contract->getVersion() . ": " . $method);

		return ResponseDecoder::decodeApi($this->transport->request("POST", $url, $options));
	}

	/**
	 * Получаем общие настройки соединения для API, загрузки файлов и Long Poll.
	 * Long Poll меняет только общий timeout с учётом wait; connect_timeout остаётся отдельным.
	 * @return array<string, mixed> Тайм-ауты Guzzle и явно заданный прокси.
	 */
	public function getRequestOptions(): array
	{
		$options = ["timeout" => $this->timeout, "connect_timeout" => $this->connectTimeout];
		if ($this->proxy !== null) $options["proxy"] = $this->proxy;
		return $options;
	}

	/**
	 * Устанавливаем максимальную продолжительность обычного HTTP-запроса.
	 * Значение 0 отключает ограничение; Long Poll использует wait + 10 секунд.
	 * @param float $seconds Продолжительность в секундах, например 30.
	 * @return void
	 * @throws InvalidArgumentException Передано отрицательное или нечисловое ограничение.
	 */
	public function setTimeout(float $seconds): void
	{
		if ($seconds < 0 || !is_finite($seconds)) {
			throw new InvalidArgumentException("Тайм-аут должен быть конечным неотрицательным числом.");
		}

		$this->timeout = $seconds;
	}

	/**
	 * Устанавливаем время ожидания установления соединения независимо от времени ожидания ответа.
	 * Настройка применяется также к серверу загрузки и Long Poll.
	 * @param float $seconds Продолжительность в секундах; 0 отключает ограничение.
	 * @return void
	 * @throws InvalidArgumentException Передано отрицательное или нечисловое ограничение.
	 */
	public function setConnectTimeout(float $seconds): void
	{
		if ($seconds < 0 || !is_finite($seconds)) {
			throw new InvalidArgumentException("Тайм-аут соединения должен быть конечным неотрицательным числом.");
		}

		$this->connectTimeout = $seconds;
	}

}
