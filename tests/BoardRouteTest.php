<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BoardRouteTest extends TestCase
{

	public function testContainsAllGroupAccessibleBoardMethods(): void
	{
		$expectedMethods = [
			"deleteComment",
			"restoreComment",
		];

		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\BoardRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("boardRouteProvider")]
	public function testBoardRouteKeepsMethodMapping(string $method, array $args, string $expectedMethod, array $expectedParams): void
	{
		$server = new VkBrownServerRecorder();

		$server->board()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function boardRouteProvider(): array
	{
		return [
			"deleteComment" => [
				"method" => "deleteComment",
				"args" => [["group_id" => 1, "topic_id" => 2, "comment_id" => 3]],
				"expectedMethod" => "board.deleteComment",
				"expectedParams" => ["group_id" => 1, "topic_id" => 2, "comment_id" => 3],
			],
			"restoreComment" => [
				"method" => "restoreComment",
				"args" => [["group_id" => 1, "topic_id" => 2, "comment_id" => 3]],
				"expectedMethod" => "board.restoreComment",
				"expectedParams" => ["group_id" => 1, "topic_id" => 2, "comment_id" => 3],
			],
		];
	}

}
