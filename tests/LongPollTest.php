<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use Haikiri\VkBrown\Exceptions\VkLongPollException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Exceptions\VkTransportException;
use Haikiri\VkBrown\VkBrownClient;
use RuntimeException;

final class LongPollTest extends HttpTestCase
{
	private const SESSION = ["response" => ["key" => "lp-key", "server" => "https://lp.example.test/group", "ts" => "10"]];

	public function testSessionIsReusedAndCursorAdvancesWithNoBearer(): void
	{
		$event = ["type" => "message_new", "v" => "5.199", "group_id" => 123, "event_id" => "delivery-1", "object" => ["message" => ["id" => 0, "text" => "Тест"]]];
		$server = $this->server([self::SESSION, ["ts" => "11", "updates" => [$event]], ["ts" => "12", "updates" => []]], ["headers" => ["Authorization" => "secret-default"], "auth" => ["user", "password"]]);
		self::assertNull($server->getLongPollTimestamp());
		$server->setConnectTimeout(4);
		$updates = $server->getUpdates();
		self::assertSame($event, $updates[0]->getAsArray());
		self::assertSame(0, $updates[0]->getMessage()->getId());
		self::assertSame("11", $server->getLongPollTimestamp());
		self::assertSame([], $server->getUpdates(timeout: 0));
		self::assertCount(3, $this->history);
		self::assertSame("Bearer TEST-TOKEN", $this->history[0]["request"]->getHeaderLine("Authorization"));
		self::assertFalse($this->history[1]["request"]->hasHeader("Authorization"));
		self::assertSame(35, $this->history[1]["options"]["timeout"]);
		self::assertSame(4.0, $this->history[1]["options"]["connect_timeout"]);
		parse_str($this->history[2]["request"]->getUri()->getQuery(), $query);
		self::assertSame("11", $query["ts"]);
	}

	public function testExpiredKeyKeepsOldCursor(): void
	{
		$new = self::SESSION;
		$new["response"]["key"] = "new-key";
		$new["response"]["ts"] = "99";
		$server = $this->server([self::SESSION, ["failed" => 2], $new, ["ts" => "12", "updates" => []]]);
		self::assertSame([], $server->getUpdates("7", 0));
		self::assertSame("7", $server->getLongPollTimestamp());
		$server->getUpdates(timeout: 0);
		parse_str($this->history[3]["request"]->getUri()->getQuery(), $query);
		self::assertSame("7", $query["ts"]);
		self::assertSame("new-key", $query["key"]);
	}

	public function testHistoryLossOneIsVisibleAndNewCursorCanContinue(): void
	{
		$server = $this->server([self::SESSION, ["failed" => 1, "ts" => 30, "extra" => "ignored"], ["ts" => "31", "updates" => []]]);
		try {
			$server->getUpdates(timeout: 0);
			self::fail("Ожидалось сообщение об утрате истории.");
		} catch (VkLongPollException $exception) {
			self::assertSame(1, $exception->getCode());
			self::assertSame("30", $exception->getTimestamp());
		}
		self::assertSame([], $server->getUpdates(timeout: 0));
		self::assertSame("31", $server->getLongPollTimestamp());
	}

	public function testHistoryLossThreeRenewsKeyAndCursor(): void
	{
		$new = self::SESSION;
		$new["response"]["ts"] = "100";
		$server = $this->server([self::SESSION, ["failed" => 3], $new]);
		try {
			$server->getUpdates(timeout: 0);
			self::fail("Ожидалось сообщение об утрате истории.");
		} catch (VkLongPollException $exception) {
			self::assertSame(3, $exception->getCode());
			self::assertSame("100", $server->getLongPollTimestamp());
		}
	}

	public function testNetworkFailureDoesNotRenewOrResetCursor(): void
	{
		$server = $this->server([self::SESSION, new ConnectException("private-url", new Request("GET", "https://lp.example.test"))]);
		try {
			$server->getUpdates("7", 0);
			self::fail("Ожидалась ошибка соединения.");
		} catch (VkTransportException $exception) {
			self::assertSame("7", $server->getLongPollTimestamp());
			self::assertCount(2, $this->history);
			self::assertStringNotContainsString("private-url", $exception->getMessage());
		}
	}

	public function testMalformedBatchDoesNotAdvanceCursor(): void
	{
		$server = $this->server([self::SESSION, ["ts" => "20", "updates" => [["type" => "message_new", "group_id" => 123, "v" => "5.199"]]]]);
		try {
			$server->getUpdates(timeout: 0);
			self::fail("Ожидалась ошибка формата.");
		} catch (VkResponseException) {
			self::assertSame("10", $server->getLongPollTimestamp());
		}
	}

	public function testCallbackConfirmationAndEventHaveExplicitResponses(): void
	{
		$server = $this->server([]);
		$client = new VkBrownClient();
		$confirmation = $client->setUpdate(["type" => "confirmation", "group_id" => 123, "secret" => "callback-secret"])->getUpdate();
		self::assertSame("confirmation-code", $server->getCallbackResponse($confirmation));
		$event = $client->setUpdate(["type" => "message_event", "group_id" => 123, "v" => "5.199", "secret" => "callback-secret", "object" => ["event_id" => "button-id", "payload" => ["action" => "help"]]])->getUpdate();
		self::assertSame("ok", $server->getCallbackResponse($event));
		self::assertCount(0, $this->history);
	}

	public function testCallbackRejectsMissingSecretBeforeConfirmation(): void
	{
		$server = $this->server([]);
		$event = (new VkBrownClient())->setUpdate(["type" => "confirmation", "group_id" => 123])->getUpdate();
		$this->expectException(RuntimeException::class);
		$server->getCallbackResponse($event);
	}
}
