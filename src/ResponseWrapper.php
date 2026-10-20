<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Normalizers\ModelNormalizer;

abstract readonly class ResponseWrapper
{
	public function __construct(private array $response)
	{
	}

	/**
	 * Получаем представление объекта с исходными именами полей VK.
	 * Вложенные модели преобразуем в массивы. Не удаляем дополнительные поля, переданные сервером.
	 * @return array<string, mixed> Данные объекта для чтения или сериализации запроса.
	 */
	public function getAsArray(): array
	{
		return ModelNormalizer::normalize($this->response);
	}

	/**
	 * Читаем поле объекта или вложенное поле по пути с точками.
	 * Значения false, 0 и [] сохраняются. Значение по умолчанию используется только для отсутствующего поля.
	 * @param string|null $key Имя поля, например photo_200 или payload.action; null возвращает весь объект.
	 * @param mixed $default Значение для отсутствующего поля.
	 * @return mixed Значение поля без приведения типов.
	 */
	public function getData(?string $key = null, mixed $default = null): mixed
	{
		$data = $this->getAsArray();
		if ($key === null) return $data;

		foreach (explode(".", $key) as $segment) {
			if (!is_array($data) || !array_key_exists($segment, $data)) return $default;
			$data = $data[$segment];
		}

		return $data;
	}

	/**
	 * Читаем типизированное поле без подмены отсутствующего значения нулём или пустой строкой.
	 * Булевы поля VK могут иметь документированное представление 0/1; остальные типы не преобразуем.
	 * @param string $key Имя поля VK, например conversation_message_id.
	 * @param string $type Ожидаемый тип: integer, string, boolean, number или array.
	 * @return mixed Значение указанного типа или null, если поле не передано.
	 * @throws VkResponseException Переданное значение нарушает контракт поля.
	 */
	protected function read(string $key, string $type): mixed
	{
		$value = $this->getData($key);
		if ($value === null) return null;
		if ($type === "boolean" && in_array($value, [0, 1], true)) return $value === 1;
		$valid = match ($type) {
			"integer" => is_int($value),
			"number" => is_int($value) || is_float($value),
			"string" => is_string($value),
			"boolean" => is_bool($value),
			"array" => is_array($value),
			default => false,
		};
		if (!$valid) {
			throw new VkResponseException("Поле $key имеет неверный тип; ожидается $type.");
		}

		return $value;
	}

	/**
	 * Читаем обязательное поле результата, не заменяя отсутствующие данные значением по умолчанию.
	 * Например, идентификатор пользователя и адрес сервера загрузки должны присутствовать в ответе.
	 * @param string $key Имя обязательного поля VK.
	 * @param string $type Ожидаемый тип значения.
	 * @return mixed Проверенное значение поля.
	 * @throws VkResponseException Поле отсутствует, равно null или имеет неверный тип.
	 */
	protected function required(string $key, string $type): mixed
	{
		$value = $this->read($key, $type);
		if ($value === null) {
			throw new VkResponseException("В объекте VK отсутствует обязательное поле $key.");
		}

		return $value;
	}

	/**
	 * Создаём модель вложенного объекта, если VK передал соответствующее поле.
	 * Отсутствующий объект остаётся null; пустой объект не превращается в фиктивную сущность с ID 0.
	 * @template T of ResponseWrapper
	 * @param string $key Имя поля, например reply_message.
	 * @param class-string<T> $class Класс модели вложенного объекта.
	 * @return T|null Модель переданного объекта.
	 * @throws VkResponseException Поле содержит скаляр вместо объекта.
	 */
	protected function object(string $key, string $class): ?ResponseWrapper
	{
		$data = $this->read($key, "array");
		return $data === null ? null : new $class($data);
	}

	/**
	 * Создаём модели элементов массива, сохраняя порядок, полученный от VK.
	 * Отсутствующий необязательный список представлен пустым массивом.
	 * @template T of ResponseWrapper
	 * @param string $key Имя списка, например attachments или profiles.
	 * @param class-string<T> $class Класс модели элемента.
	 * @return list<T> Модели элементов.
	 * @throws VkResponseException Передан неверный тип списка или его элемента.
	 */
	protected function objects(string $key, string $class): array
	{
		$items = $this->read($key, "array") ?? [];
		if (!array_is_list($items)) throw new VkResponseException("Поле $key должно быть списком объектов.");

		$result = [];
		foreach ($items as $item) {
			if (!is_array($item)) throw new VkResponseException("Элемент поля $key не является объектом.");
			$result[] = new $class($item);
		}

		return $result;
	}

}
