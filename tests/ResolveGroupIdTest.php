<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\TestCase;

class ResolveGroupIdTest extends TestCase
{

	public function testResolveGroupIdUsesExplicitConstructorValueWithoutApiCall(): void
	{
		$server = new VkBrownServerRecorder(true, "555");

		self::assertSame(555, $server->resolveGroupId());
		self::assertSame("", $server->requestedMethod);
		self::assertSame([], $server->requestedParams);
	}

	public function testResolveGroupIdFallsBackToGroupsGetByIdAndCachesResolvedValue(): void
	{
		$server = new VkBrownServerRecorder(
			Response::fromResponse([
				"groups" => [
					["id" => 321],
				],
			]),
			"",
		);

		self::assertSame(321, $server->resolveGroupId());
		self::assertSame("groups.getById", $server->requestedMethod);
		self::assertSame([], $server->requestedParams);

		$server->requestedMethod = "";
		$server->requestedParams = [];
		$server->setResponse(
			Response::fromResponse([
				"groups" => [
					["id" => 999],
				],
			]),
		);

		self::assertSame(321, $server->resolveGroupId());
		self::assertSame("", $server->requestedMethod);
		self::assertSame([], $server->requestedParams);
	}

}
