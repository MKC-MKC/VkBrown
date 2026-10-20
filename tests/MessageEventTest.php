<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\VkBrownClient;

final class MessageEventTest extends HttpTestCase
{
	public function testCallbackEventCanEditByCmidAndAnswerWithButtonEventId(): void
	{
		$data = $this->decodeJson(file_get_contents(__DIR__ . "/Response/messageEvent.json"));
		$event = (new VkBrownClient())->setUpdate($data)->getUpdate()->getMessageEvent();
		$server = $this->server([$this->fixture("messages-edit"), ["response" => 1]]);
		self::assertSame("wonderful_action_name", $event->getPayloadAction());
		self::assertTrue($server->editMessage(peerId: $event->getPeerId(), message: "Изменено", cmid: $event->getConversationMessageId()));
		self::assertSame("Изменено", $this->fields(0)["message"]);
		self::assertSame("900", $this->fields(0)["cmid"]);
		self::assertArrayNotHasKey("message_id", $this->fields(0));
		self::assertTrue($server->sendMessageEventAnswer($event->getEventId(), $event->getUserId(), $event->getPeerId(), ["type" => "show_snackbar", "text" => "Готово"]));
		self::assertSame($data["object"]["event_id"], $this->fields(1)["event_id"]);
		self::assertNotSame($data["event_id"], $this->fields(1)["event_id"]);
		self::assertSame(["type" => "show_snackbar", "text" => "Готово"], json_decode($this->fields(1)["event_data"], true));
	}
}
