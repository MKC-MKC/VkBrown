<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Helper;

use Haikiri\VkBrown\Enums\KeyboardColor;
use Haikiri\VkBrown\Enums\KeyboardType;
use InvalidArgumentException;
use JsonException;
use stdClass;

final class KeyboardHelper
{

	/**
	 * Собираем клавиатуру из строк кнопок и проверяем ограничения VK.
	 *
	 * Обычная клавиатура содержит до 40 кнопок в 10 строках, inline - до 10 кнопок в 6 строках.
	 * В строке допускается до 5 кнопок, а при наличии location - до 2. Пустой список снимает клавиатуру.
	 * @param list<list<array>> $buttons Строки кнопок, например [[self::textButton("Начать")]].
	 * @param bool $isInline Показывать кнопки внутри сообщения, а не под полем ввода.
	 * @param bool $isOneTime Скрывать обычную клавиатуру после использования; недоступно для inline.
	 * @return array Поля buttons, one_time и inline для параметра keyboard.
	 * @throws InvalidArgumentException Нарушены ограничения числа, типов или расположения кнопок.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public static function buildKeyboard(array $buttons, bool $isInline = false, bool $isOneTime = false): array
	{
		if ($isInline && $isOneTime) throw new InvalidArgumentException("one_time недоступен для inline-клавиатуры.");
		if (!array_is_list($buttons) || count($buttons) > ($isInline ? 6 : 10)) {
			throw new InvalidArgumentException("Неверное количество или формат строк клавиатуры.");
		}

		$count = 0;
		foreach ($buttons as $row) {
			if (!is_array($row) || !array_is_list($row) || count($row) < 1 || count($row) > 5) {
				throw new InvalidArgumentException("Строка клавиатуры должна содержать от 1 до 5 кнопок.");
			}
			foreach ($row as $button) {
				self::validateButton($button);
				if ($button["action"]["type"] === KeyboardType::LOCATION->value && count($row) > 2) {
					throw new InvalidArgumentException("В строке с location допускается не больше 2 кнопок.");
				}
			}
			$count += count($row);
		}
		if ($count > ($isInline ? 10 : 40)) throw new InvalidArgumentException("Превышено число кнопок клавиатуры.");

		return ["buttons" => $buttons, "one_time" => $isOneTime, "inline" => $isInline];
	}

	/**
	 * Создаём кнопку указанного типа с корректным JSON-представлением payload.
	 *
	 * Цвет применим только к text и callback. Для location label не передаётся; open_link требует link.
	 * @param KeyboardType $type Тип действия: text, callback, open_link или location.
	 * @param string|null $label Текст кнопки; для text и callback не длиннее 40 символов.
	 * @param KeyboardColor|null $color Цвет text/callback; null оставляет выбор VK.
	 * @param array|string|null $payload JSON-объект до 255 символов, например ["action" => "help"].
	 * @param string|null $link Адрес, открываемый кнопкой open_link.
	 * @return array Объект action с необязательным полем color.
	 * @throws InvalidArgumentException Параметры несовместимы с типом кнопки или payload некорректен.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/key-types
	 */
	public static function buildAction(KeyboardType $type, ?string $label = null, ?KeyboardColor $color = null, array|string|null $payload = null, ?string $link = null): array
	{
		$button = ["action" => ["type" => $type->value]];
		if ($label !== null) $button["action"]["label"] = $label;
		if ($link !== null) $button["action"]["link"] = $link;
		if ($payload !== null) $button["action"]["payload"] = self::encodePayload($payload);
		if ($color !== null) $button["color"] = $color->value;
		self::validateButton($button);

		return $button;
	}

	/**
	 * Создаём текстовую кнопку: нажатие отправляет label сообщением пользователя.
	 *
	 * Дополнительные данные придут в message.payload события message_new как JSON-строка.
	 * @param string $label Текст сообщения и кнопки, до 40 символов.
	 * @param array|string|null $payload Объект с данными команды, до 255 символов после кодирования.
	 * @param KeyboardColor|null $color Цвет кнопки; null использует значение VK.
	 * @return array Кнопка text для одной из строк клавиатуры.
	 * @throws InvalidArgumentException Превышены ограничения label или payload.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/key-types#text
	 */
	public static function textButton(string $label, array|string|null $payload = null, ?KeyboardColor $color = null): array
	{
		return self::buildAction(KeyboardType::TEXT, $label, $color, $payload);
	}

	/**
	 * Создаём кнопку, открывающую ссылку без отправки текста в диалог.
	 *
	 * Цвет у open_link отсутствует по контракту VK.
	 * @param string $label Текст кнопки.
	 * @param string $link URL, открываемый при нажатии.
	 * @param array|string|null $payload Дополнительные данные в виде JSON-объекта до 255 символов.
	 * @return array Кнопка open_link.
	 * @throws InvalidArgumentException Отсутствует ссылка или некорректен payload.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/key-types#open_link
	 */
	public static function openLinkButton(string $label, string $link, array|string|null $payload = null): array
	{
		return self::buildAction(KeyboardType::LINK, $label, payload: $payload, link: $link);
	}

	/**
	 * Создаём callback-кнопку: нажатие вызывает message_event без сообщения пользователя.
	 *
	 * Для завершения ожидания на клиенте ответьте методом sendMessageEventAnswer с event_id нажатия.
	 * @param string $label Текст кнопки, до 40 символов.
	 * @param array|string|null $payload Данные для идентификации действия, например ["action" => "confirm"].
	 * @param KeyboardColor|null $color Цвет кнопки text/callback.
	 * @return array Кнопка callback.
	 * @throws InvalidArgumentException Превышены ограничения label или payload.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/callback-keys
	 */
	public static function callbackButton(string $label, array|string|null $payload = null, ?KeyboardColor $color = null): array
	{
		return self::buildAction(KeyboardType::CALLBACK, $label, $color, $payload);
	}

	/**
	 * Создаём кнопку отправки местоположения.
	 *
	 * VK сам показывает текст и окно выбора; координаты приходят в message.geo.coordinates.
	 * @param array|string|null $payload Дополнительный JSON-объект до 255 символов.
	 * @return array Кнопка location без label и color.
	 * @throws InvalidArgumentException Некорректен payload.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard/key-types#location
	 */
	public static function locationButton(array|string|null $payload = null): array
	{
		return self::buildAction(KeyboardType::LOCATION, payload: $payload);
	}

	/**
	 * Создаём клавиатуру под полем ввода сообщения.
	 *
	 * Передайте пустой список для удаления существующей клавиатуры у пользователя.
	 * @param list<list<array>> $buttons Строки кнопок, до 10 строк и 40 кнопок.
	 * @param bool $isOneTime Скрывать клавиатуру после нажатия.
	 * @return array Данные параметра keyboard; JSON-кодирование выполнит транспорт.
	 * @throws InvalidArgumentException Нарушены ограничения VK.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public static function keyboard(array $buttons, bool $isOneTime = false): array
	{
		return self::buildKeyboard($buttons, isOneTime: $isOneTime);
	}

	/**
	 * Создаём клавиатуру внутри сообщения бота.
	 *
	 * Допускается до 6 строк и 10 кнопок, по 5 в каждой строке.
	 * @param list<list<array>> $buttons Строки кнопок inline-клавиатуры.
	 * @return array Данные параметра keyboard; JSON-кодирование выполнит транспорт.
	 * @throws InvalidArgumentException Нарушены ограничения VK.
	 * @see https://dev.vk.ru/ru/api/bots/development/keyboard
	 */
	public static function inlineKeyboard(array $buttons): array
	{
		return self::buildKeyboard($buttons, isInline: true);
	}

	/**
	 * Кодируем объект payload ровно один раз и проверяем длину результата.
	 *
	 * Пустой массив PHP означает пустой JSON-объект {}; непустой список объектом не является.
	 * @param array|string $payload Словарь или готовая строка JSON-объекта.
	 * @return string JSON-объект до 255 символов.
	 * @throws InvalidArgumentException Передан список, повреждённый JSON или слишком длинные данные.
	 */
	private static function encodePayload(array|string $payload): string
	{
		try {
			if (is_array($payload)) {
				if ($payload !== [] && array_is_list($payload)) throw new InvalidArgumentException("Payload кнопки должен быть JSON-объектом.");
				$payload = json_encode((object)$payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
			}
			if (!json_decode($payload, false, 512, JSON_THROW_ON_ERROR) instanceof stdClass) {
				throw new InvalidArgumentException("Payload кнопки должен быть JSON-объектом.");
			}
		} catch (JsonException) {
			throw new InvalidArgumentException("Payload кнопки содержит некорректный JSON.");
		}
		if (self::length($payload) > 255) throw new InvalidArgumentException("Payload кнопки длиннее 255 символов.");

		return $payload;
	}

	/**
	 * Проверяем кнопку, в том числе собранную вызывающим кодом вручную.
	 *
	 * Данные не исправляем молча: нарушение контракта должно быть видно до HTTP-запроса.
	 * @param mixed $button Объект кнопки с action и необязательным color.
	 * @return void
	 * @throws InvalidArgumentException Поля не соответствуют одному из поддерживаемых типов.
	 */
	private static function validateButton(mixed $button): void
	{
		$action = is_array($button) ? ($button["action"] ?? null) : null;
		$type = is_array($action) && is_string($action["type"] ?? null) ? KeyboardType::tryFrom($action["type"]) : null;
		if ($type === null) throw new InvalidArgumentException("Неизвестный тип кнопки.");
		$colored = in_array($type, [KeyboardType::TEXT, KeyboardType::CALLBACK], true);
		if ($type === KeyboardType::LOCATION) {
			if (isset($action["label"])) throw new InvalidArgumentException("У location отсутствует label.");
		} elseif (!is_string($action["label"] ?? null) || $action["label"] === "" || ($colored && self::length($action["label"]) > 40)) {
			throw new InvalidArgumentException("Некорректный текст кнопки.");
		}
		if ($type === KeyboardType::LINK && (!is_string($action["link"] ?? null) || $action["link"] === "")) {
			throw new InvalidArgumentException("У open_link необходимо указать link.");
		}
		if (array_key_exists("color", $button) && (!$colored || !is_string($button["color"]) || KeyboardColor::tryFrom($button["color"]) === null)) {
			throw new InvalidArgumentException("Цвет применим только к text/callback и должен соответствовать цветам VK.");
		}
		if (array_key_exists("payload", $action)) {
			if (!is_string($action["payload"])) throw new InvalidArgumentException("Payload кнопки должен быть JSON-строкой.");
			self::encodePayload($action["payload"]);
		}
	}

	/**
	 * Считаем символы UTF-8 для ограничений VK независимо от наличия расширения mbstring.
	 *
	 * Невалидный UTF-8 нельзя передавать в JSON-запросе.
	 * @param string $value Проверяемый текст.
	 * @return int Число символов Unicode.
	 * @throws InvalidArgumentException Строка не является UTF-8.
	 */
	private static function length(string $value): int
	{
		$count = preg_match_all('/./us', $value);
		if ($count === false) throw new InvalidArgumentException("Текст должен быть в UTF-8.");
		return $count;
	}

}
