<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PhotosRouteTest extends TestCase
{

	public function testContainsAllGroupAccessiblePhotosMethods(): void
	{
		$expectedMethods = [
			"getChatUploadServer",
			"getMessagesUploadServer",
			"getOwnerCoverPhotoUploadServer",
			"saveMessagesPhoto",
			"saveOwnerCoverPhoto",
		];

		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\PhotosRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("photosRouteProvider")]
	public function testPhotosRouteKeepsMethodMapping(string $method, array $args, string $expectedMethod, array $expectedParams): void
	{
		$server = new VkBrownServerRecorder();

		$server->photos()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function photosRouteProvider(): array
	{
		return [
			"getChatUploadServer" => [
				"method" => "getChatUploadServer",
				"args" => [["chat_id" => 5, "crop_x" => 1, "crop_y" => 2, "crop_width" => 300]],
				"expectedMethod" => "photos.getChatUploadServer",
				"expectedParams" => ["chat_id" => 5, "crop_x" => 1, "crop_y" => 2, "crop_width" => 300],
			],
			"getMessagesUploadServer" => [
				"method" => "getMessagesUploadServer",
				"args" => [["peer_id" => 2000000001]],
				"expectedMethod" => "photos.getMessagesUploadServer",
				"expectedParams" => ["peer_id" => 2000000001],
			],
			"getOwnerCoverPhotoUploadServer" => [
				"method" => "getOwnerCoverPhotoUploadServer",
				"args" => [["group_id" => 1, "crop_x" => 10, "crop_y" => 20, "crop_x2" => 100, "crop_y2" => 200, "is_video_cover" => true]],
				"expectedMethod" => "photos.getOwnerCoverPhotoUploadServer",
				"expectedParams" => ["group_id" => 1, "crop_x" => 10, "crop_y" => 20, "crop_x2" => 100, "crop_y2" => 200, "is_video_cover" => 1],
			],
			"saveMessagesPhoto" => [
				"method" => "saveMessagesPhoto",
				"args" => [["photo" => "[]", "server" => 10, "hash" => "abc"]],
				"expectedMethod" => "photos.saveMessagesPhoto",
				"expectedParams" => ["photo" => "[]", "server" => 10, "hash" => "abc"],
			],
			"saveOwnerCoverPhoto" => [
				"method" => "saveOwnerCoverPhoto",
				"args" => [["crop_x" => 1, "crop_height" => 2, "crop_y" => 3, "crop_width" => 4, "response_json" => "{}", "hash" => "h", "photo" => "p", "is_video_cover" => false]],
				"expectedMethod" => "photos.saveOwnerCoverPhoto",
				"expectedParams" => ["crop_x" => 1, "crop_height" => 2, "crop_y" => 3, "crop_width" => 4, "response_json" => "{}", "hash" => "h", "photo" => "p", "is_video_cover" => 0],
			],
		];
	}

}
