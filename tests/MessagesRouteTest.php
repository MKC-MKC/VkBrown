<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Response;
use Haikiri\VkBrown\Tests\Mock\VkBrownServerRecorder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MessagesRouteTest extends TestCase
{

	/**
	 * Метод фиксирует полный публичный контракт `messages.*`, который доступен для group token
	 * и который библиотека теперь обязана держать без регресса.
	 */
	public function testContainsAllGroupAccessibleMessagesMethods(): void
	{
		$expectedMethods = [
			"createChat",
			"delete",
			"deleteChatPhoto",
			"deleteConversation",
			"deleteReaction",
			"edit",
			"editChat",
			"getByConversationMessageId",
			"getById",
			"getConversationMembers",
			"getConversations",
			"getConversationsById",
			"getHistory",
			"getHistoryAttachments",
			"getImportantMessages",
			"getIntentUsers",
			"getInviteLink",
			"getLongPollHistory",
			"getLongPollServer",
			"getMessagesReactions",
			"getReactedPeers",
			"isMessagesFromGroupAllowed",
			"markAsAnsweredConversation",
			"markAsImportantConversation",
			"markAsRead",
			"pin",
			"removeChatUser",
			"restore",
			"search",
			"searchConversations",
			"send",
			"sendMessageEventAnswer",
			"sendReaction",
			"setActivity",
			"setChatPhoto",
			"unpin",
		];

		# Снимаем реальные публичные методы через reflection, чтобы тест проверял именно публичный API класса.
		$methods = array_values(array_filter(
			get_class_methods(new \Haikiri\VkBrown\Route\MessagesRoute(new VkBrownServerRecorder())),
			static fn(string $method): bool => $method !== "__construct",
		));
		sort($methods);
		sort($expectedMethods);

		self::assertSame($expectedMethods, $methods);
	}

	#[DataProvider("messagesRouteProvider")]
	public function testMessagesRouteNormalizesParamsAndKeepsMethodMapping(
		string $method,
		array $args,
		string $expectedMethod,
		array $expectedParams,
		bool $needsResponseWrapper = false,
	): void
	{
		$server = new VkBrownServerRecorder();

		# Для методов, которые превращают `Response` в массив объектов, подсовываем корректную заглушку,
		# чтобы проверить не только вызов, но и отсутствие падения на пост-обработке ответа.
		if ($needsResponseWrapper) {
			$server->setResponse(Response::fromResponse(["items" => []]));
		}

		$server->messages()->{$method}(...$args);

		self::assertSame($expectedMethod, $server->requestedMethod);
		self::assertSame($expectedParams, $server->requestedParams);
	}

	public static function messagesRouteProvider(): array
	{
		return [
			"createChat" => [
				"method" => "createChat",
				"args" => [["user_ids" => [1, 2], "title" => "Test chat", "group_id" => 7]],
				"expectedMethod" => "messages.createChat",
				"expectedParams" => ["user_ids" => "1,2", "title" => "Test chat", "group_id" => 7],
			],
			"delete" => [
				"method" => "delete",
				"args" => [["message_ids" => [11, 12], "cmids" => [21, 22], "peer_id" => 2000000001, "delete_for_all" => true, "spam" => false]],
				"expectedMethod" => "messages.delete",
				"expectedParams" => ["message_ids" => "11,12", "cmids" => "21,22", "peer_id" => 2000000001, "delete_for_all" => 1, "spam" => 0],
			],
			"getById" => [
				"method" => "getById",
				"args" => [["message_ids" => [1, 2], "cmids" => [3, 4], "fields" => ["photo_100", "sex"], "extended" => true]],
				"expectedMethod" => "messages.getById",
				"expectedParams" => ["message_ids" => "1,2", "cmids" => "3,4", "fields" => "photo_100,sex", "extended" => 1],
				"needsResponseWrapper" => true,
			],
			"getByConversationMessageId" => [
				"method" => "getByConversationMessageId",
				"args" => [["peer_id" => 2000000001, "conversation_message_ids" => [5, 6], "fields" => ["nickname"], "extended" => true]],
				"expectedMethod" => "messages.getByConversationMessageId",
				"expectedParams" => ["peer_id" => 2000000001, "conversation_message_ids" => "5,6", "fields" => "nickname", "extended" => 1],
				"needsResponseWrapper" => true,
			],
			"getConversationsById" => [
				"method" => "getConversationsById",
				"args" => [["peer_ids" => [1, 2000000001], "fields" => ["photo_100"], "extended" => true, "group_id" => 8]],
				"expectedMethod" => "messages.getConversationsById",
				"expectedParams" => ["peer_ids" => "1,2000000001", "fields" => "photo_100", "extended" => 1, "group_id" => 8],
			],
			"getHistoryAttachments" => [
				"method" => "getHistoryAttachments",
				"args" => [[
					"attachment_types" => ["photo", "video"],
					"fields" => ["photo_50"],
					"extended" => true,
					"message_video" => false,
					"preserve_order" => true,
					"photo_sizes" => true,
				]],
				"expectedMethod" => "messages.getHistoryAttachments",
				"expectedParams" => [
					"attachment_types" => "photo,video",
					"fields" => "photo_50",
					"extended" => 1,
					"message_video" => 0,
					"preserve_order" => 1,
					"photo_sizes" => 1,
				],
			],
			"markAsRead" => [
				"method" => "markAsRead",
				"args" => [["message_ids" => [91, 92], "peer_id" => 10, "mark_conversation_as_read" => true]],
				"expectedMethod" => "messages.markAsRead",
				"expectedParams" => ["message_ids" => "91,92", "peer_id" => 10, "mark_conversation_as_read" => 1],
			],
			"send" => [
				"method" => "send",
				"args" => [[
					"peer_id" => 123,
					"peer_ids" => [123, 124],
					"user_ids" => [125, 126],
					"message" => "Hello",
					"dont_parse_links" => true,
					"disable_mentions" => false,
				]],
				"expectedMethod" => "messages.send",
				"expectedParams" => [
					"peer_id" => 123,
					"peer_ids" => "123,124",
					"user_ids" => "125,126",
					"message" => "Hello",
					"dont_parse_links" => 1,
					"disable_mentions" => 0,
				],
			],
			"sendMessageEventAnswer" => [
				"method" => "sendMessageEventAnswer",
				"args" => [["event_id" => "e1", "user_id" => 1, "peer_id" => 2, "event_data" => ["type" => "show_snackbar"]]],
				"expectedMethod" => "messages.sendMessageEventAnswer",
				"expectedParams" => ["event_id" => "e1", "user_id" => 1, "peer_id" => 2, "event_data" => ["type" => "show_snackbar"]],
			],
			"setChatPhoto" => [
				"method" => "setChatPhoto",
				"args" => ["uploaded-file-token"],
				"expectedMethod" => "messages.setChatPhoto",
				"expectedParams" => ["file" => "uploaded-file-token"],
			],
			"unpin" => [
				"method" => "unpin",
				"args" => [["peer_id" => 2000000001, "group_id" => 7]],
				"expectedMethod" => "messages.unpin",
				"expectedParams" => ["peer_id" => 2000000001, "group_id" => 7],
			],
		];
	}

}
