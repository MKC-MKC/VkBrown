<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class GroupsRouteTest extends TestCase
{

	/**
	 * Метод фиксирует полный публичный контракт `groups.*`, который доступен для group token.
	 */
	public function testContainsAllGroupAccessibleGroupsMethods(): void
	{
		$expectedMethods = [
			"addAddress",
			"addCallbackServer",
			"deleteAddress",
			"deleteCallbackServer",
			"disableOnline",
			"edit",
			"editAddress",
			"editCallbackServer",
			"enableOnline",
			"getBanned",
			"getById",
			"getCallbackConfirmationCode",
			"getCallbackServers",
			"getCallbackSettings",
			"getLongPollServer",
			"getLongPollSettings",
			"getMembers",
			"getOnlineStatus",
			"getTagList",
			"getTokenPermissions",
			"isMember",
			"setCallbackSettings",
			"setLongPollSettings",
			"setSettings",
			"setUserNote",
			"tagAdd",
			"tagBind",
			"tagDelete",
			"tagUpdate",
		];

		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\GroupsRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("groupsRouteProvider")]
	public function testGroupsRouteNormalizesParamsAndKeepsMethodMapping(
		string $method,
		array $args,
		string $expectedMethod,
		array $expectedParams,
	): void
	{
		$server = new VkBrownServerRecorder();

		$server->groups()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function groupsRouteProvider(): array
	{
		return [
			"addAddress" => [
				"method" => "addAddress",
				"args" => [["group_id" => 1, "title" => "Office", "latitude" => 55.75, "longitude" => 37.61]],
				"expectedMethod" => "groups.addAddress",
				"expectedParams" => ["group_id" => 1, "title" => "Office", "latitude" => 55.75, "longitude" => 37.61],
			],
			"getById" => [
				"method" => "getById",
				"args" => [["group_ids" => [1, 2], "fields" => ["members_count", "description"]]],
				"expectedMethod" => "groups.getById",
				"expectedParams" => ["group_ids" => "1,2", "fields" => "members_count,description"],
			],
			"getCallbackServers" => [
				"method" => "getCallbackServers",
				"args" => [["group_id" => 1, "server_ids" => [10, 11]]],
				"expectedMethod" => "groups.getCallbackServers",
				"expectedParams" => ["group_id" => 1, "server_ids" => "10,11"],
			],
			"getTokenPermissions" => [
				"method" => "getTokenPermissions",
				"args" => [],
				"expectedMethod" => "groups.getTokenPermissions",
				"expectedParams" => [],
			],
			"isMember" => [
				"method" => "isMember",
				"args" => [["group_id" => 1, "user_ids" => [10, 11], "extended" => true]],
				"expectedMethod" => "groups.isMember",
				"expectedParams" => ["group_id" => 1, "user_ids" => "10,11", "extended" => 1],
			],
			"setLongPollSettings" => [
				"method" => "setLongPollSettings",
				"args" => [["group_id" => 1, "enabled" => true, "message_new" => true, "message_reply" => false]],
				"expectedMethod" => "groups.setLongPollSettings",
				"expectedParams" => ["group_id" => 1, "enabled" => 1, "message_new" => 1, "message_reply" => 0],
			],
			"setCallbackSettings" => [
				"method" => "setCallbackSettings",
				"args" => [["group_id" => 1, "server_id" => 2, "message_new" => true, "message_event" => false]],
				"expectedMethod" => "groups.setCallbackSettings",
				"expectedParams" => ["group_id" => 1, "server_id" => 2, "message_new" => 1, "message_event" => 0],
			],
			"setSettings" => [
				"method" => "setSettings",
				"args" => [["group_id" => 1, "messages" => true, "bots_capabilities" => true, "bots_start_button" => false]],
				"expectedMethod" => "groups.setSettings",
				"expectedParams" => ["group_id" => 1, "messages" => 1, "bots_capabilities" => 1, "bots_start_button" => 0],
			],
			"setUserNote" => [
				"method" => "setUserNote",
				"args" => [["group_id" => 1, "user_id" => 44, "note" => "VIP"]],
				"expectedMethod" => "groups.setUserNote",
				"expectedParams" => ["group_id" => 1, "user_id" => 44, "note" => "VIP"],
			],
			"tagBind" => [
				"method" => "tagBind",
				"args" => [["group_id" => 1, "tag_id" => 5, "user_id" => 44, "act" => "bind"]],
				"expectedMethod" => "groups.tagBind",
				"expectedParams" => ["group_id" => 1, "tag_id" => 5, "user_id" => 44, "act" => "bind"],
			],
		];
	}

}
