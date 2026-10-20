<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Enums\KeyboardColor;
use Haikiri\VkBrown\Enums\KeyboardType;
use Haikiri\VkBrown\Helper\KeyboardHelper as K;
use InvalidArgumentException;
use LogicException;
use PHPUnit\Framework\Attributes\DataProvider;

final class KeyboardHelperTest extends HttpTestCase
{
	public function testKeyboardAndPayloadAreEncodedAtTheirOwnJsonLevels(): void
	{
		$server = $this->server([["response" => 42]]);
		$keyboard = K::inlineKeyboard([[K::callbackButton("Подтвердить", ["action" => "confirm", "id" => 0], KeyboardColor::GREEN)]]);
		self::assertSame(42, $server->sendMessage(123, "Тест", randomId: 0, keyboard: $keyboard));
		$decoded = $this->decodeJson($this->fields(0)["keyboard"]);
		self::assertTrue($decoded["inline"]);
		self::assertFalse($decoded["one_time"]);
		self::assertSame('{"action":"confirm","id":0}', $decoded["buttons"][0][0]["action"]["payload"]);
		self::assertSame("positive", $decoded["buttons"][0][0]["color"]);
	}

	public function testUnicodeLimitsAndReadyJsonAndEmptyObject(): void
	{
		$button = K::textButton(str_repeat("я", 40), '{"action":"help"}');
		self::assertSame('{"action":"help"}', $button["action"]["payload"]);
		self::assertSame("{}", K::callbackButton("Тест", [])["action"]["payload"]);
		self::assertSame(["buttons" => [], "one_time" => false, "inline" => false], K::keyboard([]));
	}

	public function testLinkAndLocationDoNotHaveColorOrInventedLabels(): void
	{
		$link = K::openLinkButton("Открыть", "https://example.test");
		self::assertSame("open_link", $link["action"]["type"]);
		self::assertArrayNotHasKey("color", $link);
		self::assertSame(["action" => ["type" => "location"]], K::locationButton());
	}

	#[DataProvider("invalidKeyboards")]
	public function testRejectsDocumentedViolations(string $scenario): void
	{
		$this->expectException(InvalidArgumentException::class);
		match ($scenario) {
			"label" => K::textButton(str_repeat("я", 41)),
			"payload-length" => K::callbackButton("Тест", ["x" => str_repeat("я", 250)]),
			"payload-list" => K::textButton("Тест", [1, 2]),
			"payload-json-list" => K::textButton("Тест", "[]"),
			"payload-invalid" => K::textButton("Тест", "{"),
			"link-color" => K::buildAction(KeyboardType::LINK, "Тест", KeyboardColor::BLUE, link: "https://example.test"),
			"inline-count" => K::inlineKeyboard(array_fill(0, 3, array_fill(0, 4, K::textButton("Тест")))),
			"regular-count" => K::keyboard(array_fill(0, 9, array_fill(0, 5, K::textButton("Тест")))),
			"row-count" => K::keyboard([array_fill(0, 6, K::textButton("Тест"))]),
			"location-row" => K::keyboard([[K::locationButton(), K::textButton("A"), K::textButton("B")]]),
			"inline-one-time" => K::buildKeyboard([], true, true),
			"manual-payload-array" => K::keyboard([[["action" => ["type" => "text", "label" => "A", "payload" => ["x" => 1]]]]]),
			default => throw new LogicException("Неизвестный сценарий теста клавиатуры."),
		};
	}

	/**
	 * Собираем нарушения отдельных ограничений официального контракта клавиатур.
	 *
	 * Проверяем длины Unicode, JSON-объект, число кнопок и совместимость полей.
	 * @return iterable<string, array{string}> Названия сценариев с некорректной конфигурацией.
	 */
	public static function invalidKeyboards(): iterable
	{
		yield "label" => ["label"];
		yield "payload-length" => ["payload-length"];
		yield "payload-list" => ["payload-list"];
		yield "payload-json-list" => ["payload-json-list"];
		yield "payload-invalid" => ["payload-invalid"];
		yield "link-color" => ["link-color"];
		yield "inline-count" => ["inline-count"];
		yield "regular-count" => ["regular-count"];
		yield "row-count" => ["row-count"];
		yield "location-row" => ["location-row"];
		yield "inline-one-time" => ["inline-one-time"];
		yield "manual-payload-array" => ["manual-payload-array"];
	}
}
