<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\VkBrownClient;
use PHPUnit\Framework\TestCase;

class MessageEventTest extends TestCase
{

	public static function MockData($data): array
	{
		$raw = file_get_contents($data);
		return json_decode($raw, true);
	}

	public static function testsForMessageEventData()
	{
		$data = self::MockData(__DIR__ . "/Response/messageEvent.json");
		$update = (new VkBrownClient())->setUpdate($data["object"])->getUpdate();
		$messageEvent = $update->getMessageEvent();

		self::assertSame(111111111, $messageEvent->getUserId());
		self::assertSame(222222222, $messageEvent->getPeerId());
		self::assertSame("863e06ef1e79", $messageEvent->getEventId());
		self::assertSame(900, $messageEvent->getConversationMessageId());

		self::assertIsArray($payload = $messageEvent->getPayload());
		self::assertSame("wonderful_action_name", $payload["action"]);
		self::assertSame(1234, $payload["someCustomDataHere"]);
	}

}
