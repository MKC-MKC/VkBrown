<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FlatMethodsCompatibilityTest extends TestCase
{

	#[DataProvider("flatMethodsProvider")]
	public function testFlatMethodsStillDelegateToExpectedVkRoutes(
		string $method,
		array $args,
		string $expectedMethod,
		array $expectedParams,
		bool $needsResponseWrapper = false,
	): void
	{
		$server = new VkBrownServerRecorder();

		if ($needsResponseWrapper) {
			$server->setResponse(Response::fromResponse(["items" => []]));
		}

		$server->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function flatMethodsProvider(): array
	{
		return [
			"sendMessage alias" => [
				"method" => "sendMessage",
				"args" => [123, "Hello", null, null, null, null, null, null, null, null, null, null, null, null, null, ["inline" => true], null, null, null, true, false, null, null, 77],
				"expectedMethod" => "messages.send",
				"expectedParams" => [
					"peer_id" => 123,
					"message" => "Hello",
					"random_id" => 77,
					"keyboard" => "{\"inline\":true}",
					"dont_parse_links" => 1,
					"disable_mentions" => 0,
				],
			],
			"delete alias" => [
				"method" => "deleteMessages",
				"args" => [[1, 2], [3, 4], 10, 20, true, false, 5],
				"expectedMethod" => "messages.delete",
				"expectedParams" => [
					"message_ids" => "1,2",
					"cmids" => "3,4",
					"peer_id" => 10,
					"group_id" => 20,
					"delete_for_all" => 1,
					"spam" => 0,
					"reason" => 5,
				],
			],
			"edit alias" => [
				"method" => "editMessage",
				"args" => [2000000001, 10, 20, "Updated", null, null, null, true, false, 30, true, false, "tpl", ["buttons" => []]],
				"expectedMethod" => "messages.edit",
				"expectedParams" => [
					"peer_id" => 2000000001,
					"message_id" => 10,
					"cmid" => 20,
					"message" => "Updated",
					"keep_forward_messages" => 1,
					"keep_snippets" => 0,
					"group_id" => 30,
					"dont_parse_links" => 1,
					"disable_mentions" => 0,
					"template" => "tpl",
					"keyboard" => "{\"buttons\":[]}",
				],
			],
			"getMessagesById alias" => [
				"method" => "getMessagesById",
				"args" => [[1, 2], 100, "7,8", 30, 40, true, "photo_100"],
				"expectedMethod" => "messages.getById",
				"expectedParams" => [
					"message_ids" => "1,2",
					"peer_id" => 100,
					"cmids" => "7,8",
					"group_id" => 30,
					"preview_length" => 40,
					"extended" => 1,
					"fields" => "photo_100",
				],
				"needsResponseWrapper" => true,
			],
			"sendMessageEventAnswer" => [
				"method" => "sendMessageEventAnswer",
				"args" => ["event-1", 10, 20, ["type" => "open_link"]],
				"expectedMethod" => "messages.sendMessageEventAnswer",
				"expectedParams" => [
					"event_id" => "event-1",
					"user_id" => 10,
					"peer_id" => 20,
					"event_data" => ["type" => "open_link"],
				],
			],
		];
	}

}
