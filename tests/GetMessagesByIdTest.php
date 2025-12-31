<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Tests\Mock\VkBrownServerMock;
use PHPUnit\Framework\TestCase;

class GetMessagesByIdTest extends TestCase
{

	private static bool $debug = false;
	private static ?string $token = "vk1.a.Too.Long.Group.Token";
	private static VkBrownServerMock $server;

	public static function MockData($data, $isFile = true): void
	{
		self::$server = new VkBrownServerMock(
			token: self::$token,
			groupId: "123456789",
			mockedData: $isFile ? file_get_contents($data) : $data,
			debug: self::$debug,
		);
	}

	public static function test_1()
	{
		self::MockData(__DIR__ . "/Response/getMessagesById.json");
		$messages = self::$server->getMessagesById(messageIds: [1, 2, 3]);

		foreach ($messages as $message) {
			echo "Message ID: " . $message->getId() . "\n";
			echo "Is Deleted: " . ($message->isDeleted() ? "Yes" : "No") . "\n";
			echo "From User ID: " . $message->getFromId() . "\n";
			echo "Text: " . $message->getMessageText() . "\n";
			echo "-----------------------\n\n";
		}

		self::assertIsArray($messages, "Ожидался массив сообщений");
		self::assertCount(3, $messages, "Ожидалось ровно 3 сообщения");

		$m = $messages[0];
		self::assertSame(1, $m->getId());
		self::assertFalse($m->isDeleted());
		self::assertSame(596011113, $m->getFromId());
		self::assertSame("Это сообщение отправлено пользователем!", $m->getMessageText());

		$m = $messages[1];
		self::assertSame(2, $m->getId());
		self::assertTrue($m->isDeleted());
		self::assertSame(-226352349, $m->getFromId());
		self::assertSame("Это сообщение отправлено администратором", $m->getMessageText());

		$m = $messages[2];
		self::assertSame(3, $m->getId());
		self::assertTrue($m->isDeleted());
		self::assertSame(493272546, $m->getFromId());
		self::assertSame("Это сообщение отправил администратор из ЛС как юзер и удалил его.", $m->getMessageText());
	}

}
