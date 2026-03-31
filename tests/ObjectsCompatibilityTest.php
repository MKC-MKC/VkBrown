<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Objects\City;
use Haikiri\VkBrown\Objects\FormatData;
use Haikiri\VkBrown\Objects\Message;
use Haikiri\VkBrown\Objects\User;
use PHPUnit\Framework\TestCase;

class ObjectsCompatibilityTest extends TestCase
{

	public function test_message_returns_format_data_object(): void
	{
		$message = new Message([
			"format_data" => [
				"version" => "1",
				"items" => [
					[
						"offset" => 0,
						"length" => 5,
						"type" => "bold",
					],
				],
			],
		]);

		$formatData = $message->getFormatData();

		self::assertInstanceOf(FormatData::class, $formatData);
		self::assertSame("1", $formatData->getVersion());
		self::assertSame(
			[
				[
					"offset" => 0,
					"length" => 5,
					"type" => "bold",
				],
			],
			$formatData->getItems(),
		);
	}

	public function test_user_returns_city_object(): void
	{
		$user = new User([
			"city" => [
				"id" => 1,
				"title" => "Москва",
			],
		]);

		$city = $user->getCity();

		self::assertInstanceOf(City::class, $city);
		self::assertSame(1, $city->getId());
		self::assertSame("Москва", $city->getTitle());
	}

}
