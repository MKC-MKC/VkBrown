<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\GroupMembership;
use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\ResponseWrapper;

final class ResponseHydrator
{

	/**
	 * Проверяем объект или массив в результате метода, не отбрасывая count и расширенные поля.
	 * Для скалярных ответов используются отдельные проверки integer, boolean и stringField.
	 * @param Response $response Ответ транспорта после проверки error.
	 * @return array Результат response с исходными ключами.
	 * @throws VkResponseException Результат не является объектом или массивом.
	 */
	public static function array(Response $response): array
	{
		$result = $response->getData();
		if (!is_array($result)) throw new VkResponseException("Результат VK должен быть объектом или массивом.");
		return $result;
	}

	/**
	 * Создаём модель результата API-метода из объекта response.
	 * Поля объекта сохраняются полностью и проверяются типизированными геттерами модели.
	 * @template T of ResponseWrapper
	 * @param Response $response Проверенный ответ транспорта.
	 * @param class-string<T> $class Модель результата, например MessageList::class.
	 * @return T Созданная модель.
	 * @throws VkResponseException VK вернул скаляр вместо объекта.
	 */
	public static function model(Response $response, string $class): ResponseWrapper
	{
		return new $class(self::array($response));
	}

	/**
	 * Создаём модели элементов, когда response сам является массивом объектов.
	 * Так возвращают результат users.get, docs.getById и photos.saveMessagesPhoto.
	 * @template T of ResponseWrapper
	 * @param Response $response Проверенный ответ транспорта.
	 * @param class-string<T> $class Модель элемента, например User::class.
	 * @return list<T> Элементы в исходном порядке.
	 * @throws VkResponseException VK вернул объект вместо списка либо скалярный элемент.
	 */
	public static function models(Response $response, string $class): array
	{
		$items = self::array($response);
		if (!array_is_list($items)) throw new VkResponseException("Результат VK должен быть списком объектов.");
		return array_map(static function ($item) use ($class): ResponseWrapper {
			if (!is_array($item)) throw new VkResponseException("Элемент результата VK должен быть объектом.");
			return new $class($item);
		}, $items);
	}

	/**
	 * Читаем булев результат VK, представленный true/false или целыми 1/0.
	 * Произвольные числа, строки и объекты не считаем успешным выполнением.
	 * @param Response $response Проверенный ответ транспорта.
	 * @return bool Результат выполнения метода.
	 * @throws VkResponseException Получено другое значение response.
	 */
	public static function boolean(Response $response): bool
	{
		$value = $response->getData();
		if (!in_array($value, [0, 1, false, true], true)) throw new VkResponseException("Результат VK должен быть 0, 1, false или true.");
		return (bool)$value;
	}

	/**
	 * Получаем целочисленный идентификатор, возвращённый методом VK.
	 * Нулевое значение сохраняется; строку с цифрами не подменяем числом.
	 * @param Response $response Проверенный ответ транспорта.
	 * @return int Число в поле response.
	 * @throws VkResponseException Результат не является целым числом.
	 */
	public static function integer(Response $response): int
	{
		$value = $response->getData();
		if (!is_int($value)) throw new VkResponseException("Результат VK должен быть целым числом.");
		return $value;
	}

	/**
	 * Извлекаем обязательный числовой идентификатор из объекта результата.
	 * Например, groups.addCallbackServer возвращает server_id, а не скаляр в response.
	 * @param Response $response Проверенный ответ транспорта.
	 * @param string $field Имя поля идентификатора.
	 * @return int Переданный VK идентификатор.
	 * @throws VkResponseException Поле отсутствует или не является целым числом.
	 */
	public static function integerField(Response $response, string $field): int
	{
		$data = self::array($response);
		if (!is_int($data[$field] ?? null)) throw new VkResponseException("В результате VK отсутствует целочисленное поле $field.");
		return $data[$field];
	}

	/**
	 * Извлекаем обязательное строковое поле объекта результата.
	 * Например, groups.getCallbackConfirmationCode возвращает объект с полем code.
	 * @param Response $response Проверенный ответ транспорта.
	 * @param string $field Имя поля, например code.
	 * @return string Переданная VK строка.
	 * @throws VkResponseException Поле отсутствует или имеет другой тип.
	 */
	public static function stringField(Response $response, string $field): string
	{
		$data = self::array($response);
		if (!is_string($data[$field] ?? null)) {
			throw new VkResponseException("В результате VK отсутствует строковое поле $field.");
		}
		return $data[$field];
	}

	/**
	 * Разбираем четыре документированных варианта результата groups.isMember.
	 * Один user_id без extended даёт 0/1; extended даёт объект. `user_ids` возвращает массив объектов.
	 * @param Response $response Проверенный ответ транспорта.
	 * @param bool $multiple Передан параметр user_ids.
	 * @param bool $extended Запрошены дополнительные сведения о членстве.
	 * @return bool|GroupMembership|list<GroupMembership> Результат с учётом параметров запроса.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public static function membership(Response $response, bool $multiple, bool $extended): bool|GroupMembership|array
	{
		if ($multiple) return self::models($response, GroupMembership::class);
		if ($extended) return self::model($response, GroupMembership::class);
		return self::boolean($response);
	}

}
