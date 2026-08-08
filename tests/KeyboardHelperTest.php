<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Enums\KeyboardColor;
use Haikiri\VkBrown\Helper\KeyboardHelper;
use PHPUnit\Framework\TestCase;

final class KeyboardHelperTest extends TestCase
{

	public function testBuildsFullRegularKeyboard(): void
	{
		$keyboard = KeyboardHelper::keyboard([
			[
				KeyboardHelper::textButton(label: "Red", payload: ["button" => "1"], color: KeyboardColor::RED),
				KeyboardHelper::textButton("Green", ["button" => "2"], KeyboardColor::GREEN),
				KeyboardHelper::textButton("Blue", ["button" => "3"], KeyboardColor::BLUE),
				KeyboardHelper::textButton("White", ["button" => "4"], KeyboardColor::GRAY),
			],
		]);

		$expected = [
			"buttons" => [
				[
					[
						"action" => [
							"label" => "Red",
							"type" => "text",
							"payload" => ["button" => "1"],
						],
						"color" => "negative",
					],
					[
						"action" => [
							"label" => "Green",
							"type" => "text",
							"payload" => ["button" => "2"],
						],
						"color" => "positive",
					],
					[
						"action" => [
							"label" => "Blue",
							"type" => "text",
							"payload" => ["button" => "3"],
						],
						"color" => "primary",
					],
					[
						"action" => [
							"label" => "White",
							"type" => "text",
							"payload" => ["button" => "4"],
						],
						"color" => "secondary",
					],
				],
			],
			"one_time" => false,
		];

		self::assertSame($expected, $keyboard);
	}

	public function testBuildsInlineKeyboardWithCallbackButton(): void
	{
		$keyboard = KeyboardHelper::inlineKeyboard([
			[
				KeyboardHelper::callbackButton(
					label: "Confirm",
					payload: [
						"action" => "confirm",
						"message_id" => 42,
					],
					color: KeyboardColor::GREEN,
				),
			],
		]);

		self::assertSame([
			"buttons" => [
				[
					[
						"action" => [
							"label" => "Confirm",
							"type" => "callback",
							"payload" => [
								"action" => "confirm",
								"message_id" => 42,
							],
						],
						"color" => "positive",
					],
				],
			],
			"inline" => true,
		], $keyboard);
	}

	public function testBuildsLinkButtonWithoutOptionalFields(): void
	{
		$button = KeyboardHelper::openLinkButton(
			label: "Open",
			link: "https://example.com",
		);

		self::assertSame([
			"action" => [
				"label" => "Open",
				"type" => "open_link",
				"link" => "https://example.com",
			],
		], $button);
	}

}
