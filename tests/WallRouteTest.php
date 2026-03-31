<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class WallRouteTest extends TestCase
{

	public function testContainsAllGroupAccessibleWallMethods(): void
	{
		$expectedMethods = [
			"closeComments",
			"createComment",
			"openComments",
		];

		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\WallRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("wallRouteProvider")]
	public function testWallRouteKeepsMethodMapping(string $method, array $args, string $expectedMethod, array $expectedParams): void
	{
		$server = new VkBrownServerRecorder();

		$server->wall()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function wallRouteProvider(): array
	{
		return [
			"closeComments" => [
				"method" => "closeComments",
				"args" => [["owner_id" => -1, "post_id" => 10]],
				"expectedMethod" => "wall.closeComments",
				"expectedParams" => ["owner_id" => -1, "post_id" => 10],
			],
			"createComment" => [
				"method" => "createComment",
				"args" => [[
					"owner_id" => -1,
					"post_id" => 10,
					"from_group" => 1,
					"message" => "Hi",
					"reply_to_comment" => 2,
					"attachments" => "photo1_1",
					"sticker_id" => 123,
					"guid" => "abc",
				]],
				"expectedMethod" => "wall.createComment",
				"expectedParams" => [
					"owner_id" => -1,
					"post_id" => 10,
					"from_group" => 1,
					"message" => "Hi",
					"reply_to_comment" => 2,
					"attachments" => "photo1_1",
					"sticker_id" => 123,
					"guid" => "abc",
				],
			],
			"openComments" => [
				"method" => "openComments",
				"args" => [["owner_id" => -1, "post_id" => 10]],
				"expectedMethod" => "wall.openComments",
				"expectedParams" => ["owner_id" => -1, "post_id" => 10],
			],
		];
	}

}
