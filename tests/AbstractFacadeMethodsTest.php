<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AbstractFacadeMethodsTest extends TestCase
{

	#[DataProvider("facadeMethodsProvider")]
	public function testAbstractFacadeContainsAllImplementedFlatMethods(string $method): void
	{
		$server = new VkBrownServerRecorder();

		self::assertTrue(method_exists($server, $method), "Method {$method} is missing in VkBrownServerAbstract");
	}

	#[DataProvider("delegationProvider")]
	public function testAbstractFacadeDelegatesDirectlyToExpectedVkMethod(
		string $method,
		array $args,
		string $expectedMethod,
		array $expectedParams,
		mixed $response = true,
	): void
	{
		$server = new VkBrownServerRecorder($response);

		$server->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function facadeMethodsProvider(): array
	{
		return array_map(
			static fn(string $method): array => [$method],
			[
				"createChat",
				"deleteChatPhoto",
				"deleteConversation",
				"deleteReaction",
				"editChat",
				"getByConversationMessageId",
				"getConversationMembers",
				"getConversations",
				"getConversationsById",
				"getHistory",
				"getHistoryAttachments",
				"getImportantMessages",
				"getIntentUsers",
				"getInviteLink",
				"getLongPollHistory",
				"getMessagesReactions",
				"getReactedPeers",
				"isMessagesFromGroupAllowed",
				"markAsAnsweredConversation",
				"markAsImportantConversation",
				"markAsRead",
				"pin",
				"removeChatUser",
				"restore",
				"searchConversations",
				"sendReaction",
				"setActivity",
				"setChatPhoto",
				"unpin",
				"messagesGetLongPollServer",
				"messagesSearch",
				"groupsAddAddress",
				"groupsAddCallbackServer",
				"groupsDeleteAddress",
				"groupsDeleteCallbackServer",
				"groupsDisableOnline",
				"groupsEdit",
				"groupsEditAddress",
				"groupsEditCallbackServer",
				"groupsEnableOnline",
				"groupsGetBanned",
				"groupsGetById",
				"groupsGetCallbackConfirmationCode",
				"groupsGetCallbackServers",
				"groupsGetCallbackSettings",
				"groupsGetLongPollServer",
				"groupsGetLongPollSettings",
				"groupsGetMembers",
				"groupsGetOnlineStatus",
				"groupsGetTagList",
				"groupsGetTokenPermissions",
				"groupsIsMember",
				"groupsSetCallbackSettings",
				"groupsSetLongPollSettings",
				"groupsSetSettings",
				"groupsSetUserNote",
				"groupsTagAdd",
				"groupsTagBind",
				"groupsTagDelete",
				"groupsTagUpdate",
				"docsGetById",
				"docsGetMessagesUploadServer",
				"docsGetWallUploadServer",
				"docsSave",
				"docsSearch",
				"photosGetChatUploadServer",
				"photosGetMessagesUploadServer",
				"photosGetOwnerCoverPhotoUploadServer",
				"photosSaveMessagesPhoto",
				"photosSaveOwnerCoverPhoto",
				"boardDeleteComment",
				"boardRestoreComment",
				"wallCloseComments",
				"wallCreateComment",
				"wallOpenComments",
			],
		);
	}

	public static function delegationProvider(): array
	{
		return [
			"messages.setActivity typing" => [
				"method" => "setActivity",
				"args" => [2000000001, "typing", 77, 15],
				"expectedMethod" => "messages.setActivity",
				"expectedParams" => [
					"peer_id" => 2000000001,
					"type" => "typing",
					"group_id" => 77,
					"user_id" => 15,
				],
			],
			"messages.getByConversationMessageId" => [
				"method" => "getByConversationMessageId",
				"args" => [2000000001, [4, 5], true, ["photo_100"], 9],
				"expectedMethod" => "messages.getByConversationMessageId",
				"expectedParams" => [
					"peer_id" => 2000000001,
					"conversation_message_ids" => "4,5",
					"extended" => 1,
					"fields" => "photo_100",
					"group_id" => 9,
				],
				"response" => Response::fromResponse(["items" => []]),
			],
			"messages.getLongPollServer" => [
				"method" => "messagesGetLongPollServer",
				"args" => [true, 55, 19],
				"expectedMethod" => "messages.getLongPollServer",
				"expectedParams" => [
					"need_pts" => 1,
					"group_id" => 55,
					"lp_version" => 19,
				],
			],
			"groups.getById" => [
				"method" => "groupsGetById",
				"args" => [[1, 2], null, ["members_count"]],
				"expectedMethod" => "groups.getById",
				"expectedParams" => [
					"group_ids" => "1,2",
					"group_id" => null,
					"fields" => "members_count",
				],
			],
			"groups.setCallbackSettings" => [
				"method" => "groupsSetCallbackSettings",
				"args" => [1, 2, "5.199", true, false, null, null, null, true, false],
				"expectedMethod" => "groups.setCallbackSettings",
				"expectedParams" => [
					"group_id" => 1,
					"server_id" => 2,
					"api_version" => "5.199",
					"message_new" => 1,
					"message_reply" => 0,
					"message_allow" => null,
					"message_edit" => null,
					"message_deny" => null,
					"message_typing_state" => 1,
					"message_read" => 0,
					"photo_new" => null,
					"audio_new" => null,
					"video_new" => null,
					"wall_reply_new" => null,
					"wall_reply_edit" => null,
					"wall_reply_delete" => null,
					"wall_reply_restore" => null,
					"wall_post_new" => null,
					"wall_repost" => null,
					"wall_schedule_post_new" => null,
					"wall_schedule_post_delete" => null,
					"board_post_new" => null,
					"board_post_edit" => null,
					"board_post_restore" => null,
					"board_post_delete" => null,
					"photo_comment_new" => null,
					"photo_comment_edit" => null,
					"photo_comment_delete" => null,
					"photo_comment_restore" => null,
					"video_comment_new" => null,
					"video_comment_edit" => null,
					"video_comment_delete" => null,
					"video_comment_restore" => null,
					"market_comment_new" => null,
					"market_comment_edit" => null,
					"market_comment_delete" => null,
					"market_comment_restore" => null,
					"market_order_new" => null,
					"market_order_edit" => null,
					"poll_vote_new" => null,
					"group_join" => null,
					"group_leave" => null,
					"group_change_settings" => null,
					"group_change_photo" => null,
					"group_officers_edit" => null,
					"user_block" => null,
					"user_unblock" => null,
					"lead_forms_new" => null,
					"like_add" => null,
					"like_remove" => null,
					"message_event" => null,
					"message_reaction_event" => null,
					"donut_subscription_create" => null,
					"donut_subscription_prolonged" => null,
					"donut_subscription_cancelled" => null,
					"donut_subscription_price_changed" => null,
					"donut_subscription_expired" => null,
					"donut_money_withdraw" => null,
					"donut_money_withdraw_error" => null,
				],
			],
			"docs.save" => [
				"method" => "docsSave",
				"args" => ["file-token", "report.pdf", "a,b", true],
				"expectedMethod" => "docs.save",
				"expectedParams" => [
					"file" => "file-token",
					"title" => "report.pdf",
					"tags" => "a,b",
					"return_tags" => 1,
				],
			],
			"photos.saveMessagesPhoto" => [
				"method" => "photosSaveMessagesPhoto",
				"args" => ["photo-json", 10, "hash-value"],
				"expectedMethod" => "photos.saveMessagesPhoto",
				"expectedParams" => [
					"photo" => "photo-json",
					"server" => 10,
					"hash" => "hash-value",
				],
			],
			"wall.createComment" => [
				"method" => "wallCreateComment",
				"args" => [-1, 10, 1, "Text", 5, ["photo1_2", "doc1_3"], 123, "guid-1"],
				"expectedMethod" => "wall.createComment",
				"expectedParams" => [
					"owner_id" => -1,
					"post_id" => 10,
					"from_group" => 1,
					"message" => "Text",
					"reply_to_comment" => 5,
					"attachments" => "photo1_2,doc1_3",
					"sticker_id" => 123,
					"guid" => "guid-1",
				],
			],
		];
	}

}
