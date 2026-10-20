<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

final class GetMessagesByIdTest extends HttpTestCase
{
	public function testRealMessageRetainsPagingExtendedObjectsAndTypedAttachments(): void
	{
		$data = $this->fixture("messages-get-by-id");
		$server = $this->server([$data]);
		$result = $server->getMessagesById(messageIds: [123], extended: true, fields: ["photo_200"]);
		self::assertSame($data["response"], $result->getAsArray());
		self::assertSame(1, $result->getCount());
		$message = $result->getItems()[0];
		self::assertSame("Тест", $message->getText());
		self::assertSame("photo123_123_REDACTED", $message->getAttachments()[0]->getPhoto()->getAttachment());
		self::assertSame("txt", $message->getAttachments()[1]->getDoc()->getExt());
		self::assertSame("sdk_test", json_decode($message->getKeyboard()->getButtons()[0][0]["action"]["payload"], true)["action"]);
		self::assertSame("123", $this->fields(0)["message_ids"]);
		self::assertSame("1", $this->fields(0)["extended"]);
	}

	public function testMessageIdsAndConversationIdsUseDifferentFields(): void
	{
		$data = $this->fixture("messages-get-by-cmid");
		$server = $this->server([$data]);
		$result = $server->getMessagesByConversationMessageId(123, [713], extended: true);
		self::assertSame(713, $result->getItems()[0]->getConversationMessageId());
		self::assertSame("713", $this->fields(0)["conversation_message_ids"]);
		self::assertArrayNotHasKey("message_ids", $this->fields(0));
	}
}
