<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class DocsRouteTest extends TestCase
{

	public function testContainsAllGroupAccessibleDocsMethods(): void
	{
		$expectedMethods = [
			"getById",
			"getMessagesUploadServer",
			"getWallUploadServer",
			"save",
			"search",
		];

		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\DocsRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("docsRouteProvider")]
	public function testDocsRouteKeepsMethodMapping(string $method, array $args, string $expectedMethod, array $expectedParams): void
	{
		$server = new VkBrownServerRecorder();

		$server->docs()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public function testSaveNormalizesWrappedDocObjectResponse(): void
	{
		$server = new VkBrownServerRecorder(
			Response::fromResponse([
				"type" => "doc",
				"doc" => [
					"id" => 17,
					"owner_id" => 44,
					"title" => "probe.txt",
				],
			]),
		);

		$documents = $server->docs()->save(["file" => "uploaded-file-token"]);

		self::assertSame(
			[
				[
					"id" => 17,
					"owner_id" => 44,
					"title" => "probe.txt",
				],
			],
			$documents,
		);
	}

	public static function docsRouteProvider(): array
	{
		return [
			"getById" => [
				"method" => "getById",
				"args" => [["docs" => ["1_2", "3_4"], "return_tags" => true]],
				"expectedMethod" => "docs.getById",
				"expectedParams" => ["docs" => "1_2,3_4", "return_tags" => 1],
			],
			"getMessagesUploadServer" => [
				"method" => "getMessagesUploadServer",
				"args" => [["type" => "doc", "peer_id" => 2000000001]],
				"expectedMethod" => "docs.getMessagesUploadServer",
				"expectedParams" => ["type" => "doc", "peer_id" => 2000000001],
			],
			"getWallUploadServer" => [
				"method" => "getWallUploadServer",
				"args" => [["group_id" => 1]],
				"expectedMethod" => "docs.getWallUploadServer",
				"expectedParams" => ["group_id" => 1],
			],
			"save" => [
				"method" => "save",
				"args" => [["file" => "uploaded", "title" => "Doc", "tags" => ["a", "b"], "return_tags" => false]],
				"expectedMethod" => "docs.save",
				"expectedParams" => ["file" => "uploaded", "title" => "Doc", "tags" => "a,b", "return_tags" => 0],
			],
			"search" => [
				"method" => "search",
				"args" => [["q" => "contract", "search_own" => true, "count" => 10, "offset" => 5, "return_tags" => false]],
				"expectedMethod" => "docs.search",
				"expectedParams" => ["q" => "contract", "search_own" => 1, "count" => 10, "offset" => 5, "return_tags" => 0],
			],
		];
	}

}
