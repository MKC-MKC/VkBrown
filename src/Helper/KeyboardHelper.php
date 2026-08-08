<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Helper;

use Haikiri\VkBrown\Enums\KeyboardColor;
use Haikiri\VkBrown\Enums\KeyboardType;

readonly class KeyboardHelper
{

	/**
	 * Генератор клавиатуры.
	 * @param array $buttons
	 * @param bool $isInline Если false, то клавиатура располагается под полем ввода текста в окне чата.
	 * @param bool $isOneTime Надо ли скрывать клавиатуру после нажатия на кнопку. Работает, только при "inline": false.
	 * @return array
	 */
	public static function buildKeyboard(array $buttons, bool $isInline = false, bool $isOneTime = false): array
	{
		$keyboard = [
			"buttons" => $buttons,
		];

		if ($isInline) {
			$keyboard["inline"] = true;
		} else {
			$keyboard["one_time"] = $isOneTime;
		}

		return $keyboard;
	}

	/**
	 * Генератор кнопки с действием.
	 * @param string $label
	 * @param KeyboardType $type
	 * @param KeyboardColor|null $color
	 * @param array|null $payload
	 * @param string|null $link
	 * @return array
	 */
	public static function buildAction(
		string             $label,
		KeyboardType       $type,
		KeyboardColor|null $color = null,
		?array             $payload = null,
		string|null        $link = null,
	): array
	{
		$button = [
			"action" => [
				"label" => $label,
				"type" => $type->value,
			],
		];

		if ($link !== null) $button["action"]["link"] = $link;
		if ($payload !== null) $button["action"]["payload"] = $payload;
		if ($color !== null) $button["color"] = $color->value;

		return $button;
	}

	/**
	 * Создаём текстовую кнопку.
	 * @param string $label
	 * @param array<string, mixed>|null $payload
	 * @param KeyboardColor|null $color
	 * @return array
	 */
	public static function textButton(string $label, ?array $payload = null, ?KeyboardColor $color = null): array
	{
		return self::buildAction(
			label: $label,
			type: KeyboardType::TEXT,
			color: $color,
			payload: $payload,
		);
	}

	/**
	 * Создаём кнопку-ссылку.
	 * @param string $label
	 * @param string $link
	 * @param array<string, mixed>|null $payload
	 * @param KeyboardColor|null $color
	 * @return array
	 */
	public static function openLinkButton(string $label, string $link, ?array $payload = null, ?KeyboardColor $color = null): array
	{
		return self::buildAction(
			label: $label,
			type: KeyboardType::LINK,
			color: $color,
			payload: $payload,
			link: $link,
		);
	}

	/**
	 * Создаём Callback кнопку.
	 * @param string $label
	 * @param array<string, mixed>|null $payload
	 * @param KeyboardColor|null $color
	 * @return array|array[]
	 */
	public static function callbackButton(string $label, ?array $payload = null, KeyboardColor|null $color = null): array
	{
		return self::buildAction(
			label: $label,
			type: KeyboardType::CALLBACK,
			color: $color,
			payload: $payload,
		);
	}

	/**
	 * Создать обычную клавиатуру под сообщением бота/администратора.
	 * @param array $buttons
	 * @param bool $isOneTime
	 * @return array[]
	 */
	public static function keyboard(array $buttons, bool $isOneTime = false): array
	{
		return self::buildKeyboard(buttons: $buttons, isOneTime: $isOneTime);
	}

	/**
	 * Создать клавиатуру под полем ввода пользователя.
	 * @param array $buttons
	 * @return array[]
	 */
	public static function inlineKeyboard(array $buttons): array
	{
		return self::buildKeyboard(buttons: $buttons, isInline: true);
	}

}
