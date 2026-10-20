<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Objects\MessageSendResult;
use InvalidArgumentException;

final class MessagesTest extends HttpTestCase
{
	public function testSingleAndMultipleRecipientsKeepTheirRealResultTypes(): void
	{
		$single = $this->fixture("messages-send");
		$batch = $this->fixture("messages-send-batch");
		$server = $this->server([$single, $batch]);
		self::assertSame($single["response"], $server->sendMessage(123, "Тест", randomId: 0));
		self::assertSame("0", $this->fields(0)["random_id"]);
		$results = $server->sendMessage(text: "Тест", peerIds: [123]);
		self::assertInstanceOf(MessageSendResult::class, $results[0]);
		self::assertSame($batch["response"][0], $results[0]->getAsArray());
		self::assertNull($results[0]->getError());
		self::assertGreaterThan(0, (int)$this->fields(1)["random_id"]);
		self::assertLessThanOrEqual(2147483647, (int)$this->fields(1)["random_id"]);
		self::assertSame("123", $this->fields(1)["peer_ids"]);
	}

	public function testPartialFailureDoesNotDiscardOtherRecipients(): void
	{
		$server = $this->server([["response" => [
			["peer_id" => 123, "message_id" => 7, "conversation_message_id" => 9],
			["peer_id" => 456, "message_id" => 0, "conversation_message_id" => 0, "error" => ["code" => 901, "description" => "Can't send messages for users without permission"]],
		]]]);
		$results = $server->sendMessage(text: "Тест", peerIds: [123, 456]);
		self::assertCount(2, $results);
		self::assertSame(7, $results[0]->getMessageId());
		self::assertSame(901, $results[1]->getError()["code"]);
		self::assertCount(1, $this->history);
	}

	public function testDeletionKeepsStatusesByConversationMessageId(): void
	{
		$data = $this->fixture("messages-delete");
		$server = $this->server([$data]);
		$result = $server->deleteMessages(deleteForAll: true, peerId: 123, cmids: [713]);
		self::assertSame($data["response"], $result);
		self::assertSame(1, $result[0]["response"]);
		self::assertSame("713", $this->fields(0)["cmids"]);
		self::assertArrayNotHasKey("message_ids", $this->fields(0));
	}

	public function testSendingWithoutTargetFailsBeforeHttp(): void
	{
		$server = $this->server([]);
		$this->expectException(InvalidArgumentException::class);
		$server->sendMessage(text: "Тест");
	}

	public function testRandomIdMustFitVkInt32(): void
	{
		$server = $this->server([]);
		$this->expectException(InvalidArgumentException::class);
		$server->sendMessage(123, "Тест", randomId: 2147483648);
	}

	public function testReactionResultKeepsReactionsAndCounters(): void
	{
		$server = $this->server([["response" => ["count" => 1,
			"reactions" => [["user_id" => 123, "reaction_id" => 5]],
			"counters" => [["reaction_id" => 5, "count" => 1, "user_ids" => [123]]],
			"profiles" => [["id" => 123]], "groups" => [],
		]]]);
		$result = $server->getMessageReactedPeers(peerId: 123, cmid: 713);
		self::assertSame(5, $result->getReactions()[0]->getReactionId());
		self::assertSame(1, $result->getCounters()[0]->getCount());
		self::assertSame([123], $result->getCounters()[0]->getUserIds());
		self::assertSame(123, $result->getProfiles()[0]->getId());
	}

	public function testWallCommentUsesNegativeOwnerAndReturnsIdentifier(): void
	{
		$server = $this->server([["response" => ["comment_id" => 3, "parents_stack" => [1, 2]]]]);
		$result = $server->createWallComment(postId: 7, text: "Тест", attachments: ["photo-123_9"], guid: "comment-1");
		self::assertSame(3, $result->getCommentId());
		self::assertSame([1, 2], $result->getParentsStack());
		self::assertSame("-123", $this->fields(0)["owner_id"]);
		self::assertSame("photo-123_9", $this->fields(0)["attachments"]);
		self::assertSame("comment-1", $this->fields(0)["guid"]);
	}
}
