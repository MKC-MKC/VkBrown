<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\GroupMember;
use Haikiri\VkBrown\Objects\GroupMembership;
use Haikiri\VkBrown\Objects\User;

final class GroupsTest extends HttpTestCase
{
	public function testOwnCommunityAndUsersHaveAvatarsWithoutAnotherToken(): void
	{
		$server = $this->server([$this->fixture("groups-get-me"), $this->fixture("users-get")]);
		self::assertSame("https://example.test/redacted", $server->getMe(fields: ["photo_200"])->getPhoto200());
		self::assertSame("123", $this->fields(0)["group_ids"]);
		self::assertArrayNotHasKey("group_id", $this->fields(0));
		$users = $server->getUsers([123], ["photo_200", "city"]);
		self::assertSame("https://example.test/redacted", $users[0]->getPhoto200());
		self::assertInstanceOf(User::class, $users[0]);
		self::assertSame("Bearer TEST-TOKEN", $this->history[1]["request"]->getHeaderLine("Authorization"));
	}

	public function testMemberResultsKeepIdsProfilesAndRolesAsRequested(): void
	{
		$server = $this->server([
			$this->fixture("groups-get-members"), $this->fixture("groups-get-members-fields"),
			["response" => ["count" => 1, "items" => [["id" => 123, "role" => "administrator", "photo_200" => "https://example.test/avatar"]]]],
		]);
		$ids = $server->getGroupMembers(count: 1);
		self::assertSame([123], $ids->getItems());
		self::assertGreaterThanOrEqual(1, $ids->getCount());
		$profiles = $server->getGroupMembers(count: 1, fields: ["photo_200"]);
		self::assertInstanceOf(User::class, $profiles->getItems()[0]);
		self::assertNotNull($profiles->getNextFrom());
		$managers = $server->getGroupMembers(fields: ["photo_200"], filter: "managers");
		self::assertInstanceOf(GroupMember::class, $managers->getItems()[0]);
		self::assertSame("administrator", $managers->getItems()[0]->getRole());
		self::assertSame("https://example.test/avatar", $managers->getItems()[0]->getPhoto200());
	}

	public function testMembershipSupportsSingleMultipleAndExtendedResults(): void
	{
		$server = $this->server([
			$this->fixture("groups-is-member"), $this->fixture("groups-is-member-extended"),
			["response" => ["member" => 1, "user_id" => 123, "request" => 0]],
		]);
		self::assertFalse($server->isGroupMember(userId: 123));
		$members = $server->isGroupMember(userIds: [123], extended: true);
		self::assertCount(1, $members);
		self::assertSame(123, $members[0]->getUserId());
		self::assertTrue($members[0]->canInvite());
		$single = $server->isGroupMember(userId: 123, extended: true);
		self::assertInstanceOf(GroupMembership::class, $single);
		self::assertTrue($single->isMember());
		self::assertFalse($single->isRequest());
	}

	public function testCallbackAdministrationAndConfirmationUseRealResponseShapes(): void
	{
		$server = $this->server([
			["response" => ["server_id" => 7]], ["response" => 1],
			["response" => ["api_version" => "5.199", "events" => ["message_new" => 1]]],
			$this->fixture("callback-confirmation"),
		]);
		self::assertSame(7, $server->addCallbackServer(url: "https://example.test/callback", title: "Бот"));
		self::assertTrue($server->setCallbackSettings(serverId: 7, messageNew: true));
		self::assertSame("5.199", $this->fields(1)["api_version"]);
		self::assertSame("1", $this->fields(1)["message_new"]);
		self::assertSame(1, $server->getCallbackSettings(serverId: 7)->getEvents()["message_new"]);
		self::assertSame("REDACTED", $server->getCallbackConfirmationCode());
	}

	public function testTagListHasColorAndUseCountAndDefaultCommunity(): void
	{
		$server = $this->server([["response" => [["id" => 1, "name" => "Клиент", "color" => "4bb34b", "uses" => 2]]]]);
		$tags = $server->getGroupTagList();
		self::assertSame("4bb34b", $tags[0]->getColor());
		self::assertSame(2, $tags[0]->getUses());
		self::assertSame("123", $this->fields(0)["group_id"]);
	}

	public function testRealAccessDeniedIsPreservedWithoutSwitchingTokenOrRetry(): void
	{
		$server = $this->server([$this->fixture("groups-get-tag-list")]);
		try {
			$server->getGroupTagList();
			self::fail("Ожидался запрет VK.");
		} catch (VkMainException $exception) {
			self::assertSame(15, $exception->getCode());
			self::assertCount(1, $this->history);
			self::assertSame("method", $exception->getDetails()["request_params"][0]["key"]);
		}
	}

	public function testAddressTimetableUsesJsonInsteadOfPhpArrayFormFields(): void
	{
		$server = $this->server([["response" => ["id" => 9, "title" => "Офис", "latitude" => 55.75, "longitude" => 37.62]]]);
		$timetable = ["mon" => ["open_time" => 540, "close_time" => 1080]];
		$result = $server->addGroupAddress(title: "Офис", address: "Улица", cityId: 1, latitude: 55.75, longitude: 37.62, timetable: $timetable);
		self::assertSame(9, $result->getId());
		self::assertSame(55.75, $result->getLatitude());
		self::assertSame($timetable, json_decode($this->fields(0)["timetable"], true));
		self::assertSame("123", $this->fields(0)["group_id"]);
	}
}
