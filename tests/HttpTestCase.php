<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Haikiri\VkBrown\VkBrownServer;
use JsonException;
use LogicException;
use PHPUnit\Framework\TestCase;
use Throwable;

abstract class HttpTestCase extends TestCase
{
	protected array $history = [];
	protected array $bodies = [];

	/**
	 * Подключаем к настоящему серверу SDK очередь HTTP-ответов и журнал запросов.
	 *
	 * Сериализация, маршруты, декодирование ошибок и модели остаются настоящими.
	 * @param list<array|Throwable> $responses JSON-объекты либо ошибки соединения.
	 * @param array $clientOptions Дополнительные настройки Guzzle для проверки изоляции запросов.
	 * @return VkBrownServer Сервер сообщества 123.
	 */
	protected function server(array $responses, array $clientOptions = []): VkBrownServer
	{
		try {
			$queue = array_map(static fn($data) => $data instanceof Throwable ? $data : new Response(200, [], json_encode($data, JSON_THROW_ON_ERROR)), $responses);
		} catch (JsonException $exception) {
			throw new LogicException("Не удалось подготовить JSON тестового HTTP-ответа.", previous: $exception);
		}
		$stack = HandlerStack::create(new MockHandler($queue));
		$stack->push(Middleware::history($this->history));
		$stack->push(Middleware::mapRequest(function ($request) {
			$this->bodies[] = (string)$request->getBody();
			$request->getBody()->rewind();
			return $request;
		}));
		return new VkBrownServer("TEST-TOKEN", 123, "confirmation-code", client: new Client(["handler" => $stack] + $clientOptions), secret: "callback-secret");
	}

	/**
	 * Читаем полный сохранённый ответ VK 5.199.
	 *
	 * Источники и правила обезличивания описаны рядом с фикстурами.
	 * @param string $name Имя фикстуры без расширения.
	 * @return array JSON-конверт API или Long Poll.
	 */
	protected function fixture(string $name): array
	{
		return $this->decodeJson(file_get_contents(__DIR__ . "/Response/5.199/$name.json"));
	}

	/**
	 * Читаем поля отправленной формы для проверки контракта метода.
	 *
	 * Применяется к коротким запросам form-urlencoded.
	 * @param int $index Порядковый номер HTTP-запроса.
	 * @return array Имена и строковые значения полей VK.
	 */
	protected function fields(int $index): array
	{
		parse_str((string)$this->history[$index]["request"]->getBody(), $fields);
		return $fields;
	}

	/**
	 * Разбираем JSON тестовых данных с отдельной ошибкой повреждённой фикстуры.
	 *
	 * Ошибка подготовки теста не является ошибкой проверяемого SDK.
	 * @param string $json JSON-объект или список из фикстуры либо журнала HTTP.
	 * @return array Декодированные данные для утверждений теста.
	 * @throws LogicException Некорректный JSON или скаляр вместо объекта/списка.
	 */
	protected function decodeJson(string $json): array
	{
		try {
			$value = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
		} catch (JsonException $exception) {
			throw new LogicException("Повреждён JSON тестовых данных.", previous: $exception);
		}
		if (!is_array($value)) throw new LogicException("Ожидался объект или список тестовых данных.");
		return $value;
	}

}
