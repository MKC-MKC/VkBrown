<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Helper\UploadSaveResponseNormalizer;

abstract class VkBrownServerAbstract
{
	public static bool $debug;
	private int|null $resolvedGroupId = null;

	public function __construct(
		private readonly string          $token,
		private readonly string|int|null $groupId = null,
		private readonly string|null     $confirmation = null,
		private string|null              $version = null,
		private string|null              $url = null,
										 $debug = false,
	)
	{
		$this->version = !empty($version) ? $version : "5.199";
		$this->url = !empty($url) ? $url : "https://api.vk.ru/";
		self::$debug = filter_var($debug, FILTER_VALIDATE_BOOLEAN);
	}

	/**
	 * Метод возвращает API URL.
	 * @return string
	 */
	protected function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * Метод возвращает токен доступа.
	 * @return string
	 */
	public function getToken(): string
	{
		return $this->token;
	}

	/**
	 * Метод возвращает ID группы.
	 * @return string
	 */
	public function getGroupId(): string
	{
		return (string)($this->groupId ?? "");
	}

	/**
	 * Метод возвращает ID группы в числовом виде.
	 * Если ID не был передан явно, пытаемся один раз получить его через `groups.getById` по текущему group token.
	 *
	 * @return int
	 * @throws VkMainException
	 */
	public function resolveGroupId(): int
	{
		# Если ID уже был разрешён ранее в этом экземпляре SDK, повторный сетевой вызов не нужен.
		if ($this->resolvedGroupId !== null) {
			return $this->resolvedGroupId;
		}

		# Если ID пришёл в конструктор явно, считаем это источником истины и просто кэшируем числовое значение.
		$groupId = $this->getGroupId();
		if ($groupId !== "" && preg_match('/^\d+$/', $groupId) === 1) {
			return $this->resolvedGroupId = (int)$groupId;
		}

		# Иначе делаем fallback-вызов groups.getById, который VK умеет обслуживать по самому group token без явного group_id.
		$response = $this->sendRequest("groups.getById");
		$rawResponse = $response instanceof Response ? $response->getRaw() : $response;
		$groups = is_array($rawResponse) ? ($rawResponse["groups"] ?? []) : [];
		$resolvedGroupId = $groups[0]["id"] ?? null;

		# Если VK не вернул ожидаемый список групп, считаем, что SDK не смог безопасно определить group_id.
		if (!is_int($resolvedGroupId) && !(is_string($resolvedGroupId) && preg_match('/^\d+$/', $resolvedGroupId) === 1)) {
			throw new VkMainException("Unable to resolve VK group_id from token");
		}

		# После успешного разрешения сохраняем значение в объекте SDK, чтобы не дёргать API повторно.
		return $this->resolvedGroupId = (int)$resolvedGroupId;
	}

	/**
	 * Метод возвращает версию API.
	 * @return string
	 */
	public function getVersion(): string
	{
		return $this->version;
	}

	/**
	 * Метод возвращает код подтверждения сервера.
	 * @return string|null
	 */
	public function getConfirmation(): string|null
	{
		return $this->confirmation;
	}

	public function getMe(): Objects\User
	{
		return new Objects\User($this->sendRequest(method: "users.get")->getObject());
	}

	/**
	 * Метод отправляет сообщение.
	 * @see https://dev.vk.com/ru/method/messages.send
	 */
	public function sendMessage(
		int|string  $peerId,
		string      $text,
		int|null    $userId = null,
		string|null $peerIds = null,
		string|null $domain = null,
		int|null    $chatId = null,
		string|null $userIds = null, /** @deprecated from 5.138 */
		string|null $lat = null,
		string|null $long = null,
		string|null $attachment = null,
		int|null    $replyTo = null, /** @deprecated from 5.221 */
		string|null $forwardMessages = null, /** @deprecated from 5.221 */
		string|null $forward = null,
		int|null    $stickerId = null,
		int|null    $groupId = null,
		array|null  $keyboard = null,
		string|null $template = null,
		string|null $payload = null,
		string|null $contentSource = null,
		bool|null   $dontParseLinks = null,
		bool|null   $disableMentions = null,
		string|null $intent = null,
		int|null    $subscribeId = null,
		int|null    $randomId = null
	)
	{
		$params = [
			"peer_id" => $peerId,
			"message" => $text,
			"random_id" => $randomId ?? mt_rand(0, 2147483647),
		];

		if ($userId !== null) $params["user_id"] = $userId;
		if ($peerIds !== null) $params["peer_ids"] = $peerIds;
		if ($domain !== null) $params["domain"] = $domain;
		if ($chatId !== null) $params["chat_id"] = $chatId;
		if ($userIds !== null) $params["user_ids"] = $userIds;
		if ($lat !== null) $params["lat"] = $lat;
		if ($long !== null) $params["long"] = $long;
		if ($attachment !== null) $params["attachment"] = $attachment;
		if ($replyTo !== null) $params["reply_to"] = $replyTo;
		if ($forwardMessages !== null) $params["forward_messages"] = $forwardMessages;
		if ($forward !== null) $params["forward"] = $forward;
		if ($stickerId !== null) $params["sticker_id"] = $stickerId;
		if ($groupId !== null) $params["group_id"] = $groupId;
		if ($keyboard !== null) $params["keyboard"] = json_encode($keyboard);
		if ($template !== null) $params["template"] = $template;
		if ($payload !== null) $params["payload"] = $payload;
		if ($contentSource !== null) $params["content_source"] = $contentSource;
		if ($dontParseLinks !== null) $params["dont_parse_links"] = (int)$dontParseLinks;
		if ($disableMentions !== null) $params["disable_mentions"] = (int)$disableMentions;
		if ($intent !== null) $params["intent"] = $intent;
		if ($subscribeId !== null) $params["subscribe_id"] = $subscribeId;

		return $this->sendRequest("messages.send", $params);
	}

	/**
	 * Удаляет сообщение.
	 * @see https://dev.vk.com/ru/method/messages.delete
	 */
	public function deleteMessages(
		array|null      $messageIds = null,
		array|null      $cmIds = null,
		string|int|null $peerId = null,
		string|int|null $groupId = null,
		bool            $deleteForAll = true,
		bool|null       $spam = null,
		int|null        $reason = null,
	): mixed
	{
		$params = [];
		if ($messageIds !== null) $params["message_ids"] = implode(",", array_map("strval", $messageIds));
		if ($cmIds !== null) $params["cmids"] = implode(",", array_map("strval", $cmIds));
		if ($peerId !== null) $params["peer_id"] = (int)$peerId;
		if ($groupId !== null) $params["group_id"] = (int)$groupId;
		if ($deleteForAll !== null) $params["delete_for_all"] = (int)$deleteForAll;
		if ($spam !== null) $params["spam"] = (int)$spam;
		if ($reason !== null) $params["reason"] = $reason;

		return $this->sendRequest("messages.delete", $params);
	}

	/**
	 * Редактирует сообщение.
	 * @see https://dev.vk.com/ru/method/messages.edit
	 */
	public function editMessage(
		int|string  $peerId,
		int|null    $messageId = null,
		int|null    $cmId = null,
		string|null $message = null,
		string|null $lat = null,
		string|null $long = null,
		string|null $attachment = null,
		bool|null   $keepForwardMessages = null,
		bool|null   $keepSnippets = null,
		int|null    $groupId = null,
		bool|null   $dontParseLinks = null,
		bool|null   $disableMentions = null,
		string|null $template = null,
		array|null  $keyboard = null
	)
	{
		$params = ["peer_id" => $peerId];
		if ($messageId !== null) $params["message_id"] = $messageId;
		if ($cmId !== null) $params["cmid"] = $cmId;
		if ($message !== null) $params["message"] = $message;
		if ($lat !== null) $params["lat"] = $lat;
		if ($long !== null) $params["long"] = $long;
		if ($attachment !== null) $params["attachment"] = $attachment;
		if ($keepForwardMessages !== null) $params["keep_forward_messages"] = (int)$keepForwardMessages;
		if ($keepSnippets !== null) $params["keep_snippets"] = (int)$keepSnippets;
		if ($groupId !== null) $params["group_id"] = $groupId;
		if ($dontParseLinks !== null) $params["dont_parse_links"] = (int)$dontParseLinks;
		if ($disableMentions !== null) $params["disable_mentions"] = (int)$disableMentions;
		if ($template !== null) $params["template"] = $template;
		if ($keyboard !== null) $params["keyboard"] = json_encode($keyboard);

		return $this->sendRequest("messages.edit", $params);
	}

	/**
	 * Возвращает сообщения по их идентификаторам.
	 * @see https://dev.vk.com/ru/method/messages.getById
	 * @return Objects\Message[]
	 */
	public function getMessagesById(
		array           $messageIds,
		int|string|null $peerId = null,
		string|null     $cmIds = null,
		int|null        $groupId = null,
		int|null        $previewLength = null,
		bool|null       $extended = null,
		string|null     $fields = null,
	): array
	{
		$params = [];
		$params["message_ids"] = implode(",", array_map("strval", $messageIds));
		if ($peerId !== null) $params["peer_id"] = $peerId;
		if ($cmIds !== null) $params["cmids"] = $cmIds;
		if ($groupId !== null) $params["group_id"] = $groupId;
		if ($previewLength !== null) $params["preview_length"] = $previewLength;
		if ($extended !== null) $params["extended"] = (int)$extended;
		if ($fields !== null) $params["fields"] = $fields;

		$response = $this->sendRequest("messages.getById", $params);
		return array_map(static fn(array $item): Objects\Message => new Objects\Message($item), $response?->getItems() ?? []);
	}

	/**
	 * Метод позволяет получить информацию о пользователях.
	 * @see https://dev.vk.com/ru/method/users.get
	 * @return Objects\User[]
	 */
	public function getUsers(array $userIds, array|null $fields = null, string $nameCase = "nom"): array
	{
		$params = [];
		$params["user_ids"] = implode(",", array_map("strval", $userIds));
		if ($fields !== null) $params["fields"] = implode(",", array_map("strval", $fields));
		if ($nameCase !== null) $params["name_case"] = $nameCase;

		$response = $this->sendRequest("users.get", $params);
		return array_map(static fn(array $item): Objects\User => new Objects\User($item), $response->getRaw() ?? []);
	}

	/**
	 * Отправляет событие с действием, которое произойдет при нажатии на callback-кнопку.
	 * @see https://dev.vk.com/ru/method/messages.sendMessageEventAnswer
	 */
	public function sendMessageEventAnswer(string $eventId, int|string $userId, int|string $peerId, array $eventData)
	{
		$params = [
			"event_id" => $eventId,
			"user_id" => (int)$userId,
			"peer_id" => (int)$peerId,
			"event_data" => $eventData,
		];

		return $this->sendRequest("messages.sendMessageEventAnswer", $params);
	}

	/**
	 * Создаёт чат с несколькими участниками.
	 * @see https://dev.vk.com/ru/method/messages.createChat
	 */
	public function createChat(array|null $userIds = null, string|null $title = null, int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("messages.createChat", [
			"user_ids" => $userIds !== null ? implode(",", array_map("strval", $userIds)) : null,
			"title" => $title,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Позволяет удалить фотографию мультидиалога.
	 * @see https://dev.vk.com/ru/method/messages.deleteChatPhoto
	 */
	public function deleteChatPhoto(int|string|null $chatId = null, int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("messages.deleteChatPhoto", [
			"chat_id" => $chatId,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Удаляет беседу.
	 * @see https://dev.vk.com/ru/method/messages.deleteConversation
	 */
	public function deleteConversation(int|string|null $userId = null, int|string|null $peerId = null, int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("messages.deleteConversation", [
			"user_id" => $userId,
			"peer_id" => $peerId,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Удаление ранее поставленной реакции
	 * @see https://dev.vk.com/ru/method/messages.deleteReaction
	 */
	public function deleteReaction(int|string|null $peerId = null, int|string|null $cmid = null): mixed
	{
		return $this->sendRequest("messages.deleteReaction", [
			"peer_id" => $peerId,
			"cmid" => $cmid,
		]);
	}

	/**
	 * Изменяет название беседы.
	 * @see https://dev.vk.com/ru/method/messages.editChat
	 */
	public function editChat(int|string|null $chatId = null, string|null $title = null): mixed
	{
		return $this->sendRequest("messages.editChat", [
			"chat_id" => $chatId,
			"title" => $title,
		]);
	}

	/**
	 * Возвращает сообщения по conversation_message_id.
	 * @see https://dev.vk.com/ru/method/messages.getByConversationMessageId
	 * @return Objects\Message[]
	 */
	public function getByConversationMessageId(
		int|string|null $peerId = null,
		array|null      $conversationMessageIds = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): array
	{
		$response = $this->sendRequest("messages.getByConversationMessageId", [
			"peer_id" => $peerId,
			"conversation_message_ids" => $conversationMessageIds !== null ? implode(",", array_map("strval", $conversationMessageIds)) : null,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);

		return array_map(static fn(array $item): Objects\Message => new Objects\Message($item), $response?->getItems() ?? []);
	}

	/**
	 * Метод получает список участников беседы.
	 * @see https://dev.vk.com/ru/method/messages.getConversationMembers
	 */
	public function getConversationMembers(
		int|string|null $peerId = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
		array|null      $memberIds = null,
	): mixed
	{
		return $this->sendRequest("messages.getConversationMembers", [
			"peer_id" => $peerId,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
			"member_ids" => $memberIds !== null ? implode(",", array_map("strval", $memberIds)) : null,
		]);
	}

	/**
	 * Возвращает список бесед пользователя.
	 * @see https://dev.vk.com/ru/method/messages.getConversations
	 */
	public function getConversations(
		int|string|null $offset = null,
		int|string|null $count = null,
		string|null     $filter = null,
		bool|null       $extended = null,
		int|string|null $startMessageId = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.getConversations", [
			"offset" => $offset,
			"count" => $count,
			"filter" => $filter,
			"extended" => $extended !== null ? (int)$extended : null,
			"start_message_id" => $startMessageId,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Позволяет получить беседу по её идентификатору.
	 * @see https://dev.vk.com/ru/method/messages.getConversationsById
	 */
	public function getConversationsById(
		array|null      $peerIds = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.getConversationsById", [
			"peer_ids" => $peerIds !== null ? implode(",", array_map("strval", $peerIds)) : null,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает историю сообщений для указанного диалога.
	 * @see https://dev.vk.com/ru/method/messages.getHistory
	 */
	public function getHistory(
		int|string|null $offset = null,
		int|string|null $count = null,
		int|string|null $userId = null,
		int|string|null $peerId = null,
		int|string|null $startMessageId = null,
		int|null        $rev = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.getHistory", [
			"offset" => $offset,
			"count" => $count,
			"user_id" => $userId,
			"peer_id" => $peerId,
			"start_message_id" => $startMessageId,
			"rev" => $rev,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает материалы диалога или беседы.
	 * @see https://dev.vk.com/ru/method/messages.getHistoryAttachments
	 */
	public function getHistoryAttachments(
		array|null      $attachmentTypes = null,
		int|string|null $groupId = null,
		int|string|null $peerId = null,
		int|string|null $cmid = null,
		int|string|null $attachmentPosition = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $maxForwardsLevel = null,
		bool|null       $messageVideo = null,
		string|null     $mediaType = null,
		string|null     $startFrom = null,
		bool|null       $preserveOrder = null,
		bool|null       $photoSizes = null,
	): mixed
	{
		return $this->sendRequest("messages.getHistoryAttachments", [
			"attachment_types" => $attachmentTypes !== null ? implode(",", array_map("strval", $attachmentTypes)) : null,
			"group_id" => $groupId,
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"attachment_position" => $attachmentPosition,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"max_forwards_level" => $maxForwardsLevel,
			"message_video" => $messageVideo !== null ? (int)$messageVideo : null,
			"media_type" => $mediaType,
			"start_from" => $startFrom,
			"preserve_order" => $preserveOrder !== null ? (int)$preserveOrder : null,
			"photo_sizes" => $photoSizes !== null ? (int)$photoSizes : null,
		]);
	}

	/**
	 * Возвращает список важных сообщений пользователя.
	 * @see https://dev.vk.com/ru/method/messages.getImportantMessages
	 */
	public function getImportantMessages(
		int|string|null $count = null,
		int|string|null $offset = null,
		int|string|null $startMessageId = null,
		int|string|null $previewLength = null,
		array|null      $fields = null,
		bool|null       $extended = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.getImportantMessages", [
			"count" => $count,
			"offset" => $offset,
			"start_message_id" => $startMessageId,
			"preview_length" => $previewLength,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"extended" => $extended !== null ? (int)$extended : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Метод возвращает пользователей по intent.
	 * @see https://dev.vk.com/ru/method/messages.getIntentUsers
	 */
	public function getIntentUsers(
		string|null     $intent = null,
		int|string|null $subscribeId = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		bool|null       $extended = null,
		string|null     $nameCase = null,
		array|null      $fields = null,
	): mixed
	{
		return $this->sendRequest("messages.getIntentUsers", [
			"intent" => $intent,
			"subscribe_id" => $subscribeId,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended !== null ? (int)$extended : null,
			"name_case" => $nameCase,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
		]);
	}

	/**
	 * Получает ссылку для приглашения пользователя в беседу.
	 * @see https://dev.vk.com/ru/method/messages.getInviteLink
	 */
	public function getInviteLink(int|string|null $peerId = null, bool|null $reset = null, int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("messages.getInviteLink", [
			"peer_id" => $peerId,
			"reset" => $reset !== null ? (int)$reset : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает обновления в личных сообщениях пользователя.
	 * @see https://dev.vk.com/ru/method/messages.getLongPollHistory
	 */
	public function getLongPollHistory(
		int|null        $ts = null,
		int|null        $pts = null,
		int|string|null $previewLength = null,
		bool|null       $onlines = null,
		array|null      $fields = null,
		int|string|null $eventsLimit = null,
		int|string|null $msgsLimit = null,
		int|string|null $maxMsgId = null,
		int|string|null $groupId = null,
		int|string|null $lpVersion = null,
		int|string|null $lastN = null,
		bool|null       $credentials = null,
		bool|null       $extended = null,
	): mixed
	{
		return $this->sendRequest("messages.getLongPollHistory", [
			"ts" => $ts,
			"pts" => $pts,
			"preview_length" => $previewLength,
			"onlines" => $onlines !== null ? (int)$onlines : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"events_limit" => $eventsLimit,
			"msgs_limit" => $msgsLimit,
			"max_msg_id" => $maxMsgId,
			"group_id" => $groupId,
			"lp_version" => $lpVersion,
			"last_n" => $lastN,
			"credentials" => $credentials !== null ? (int)$credentials : null,
			"extended" => $extended !== null ? (int)$extended : null,
		]);
	}

	/**
	 * Получить актуальные счётчики реакций на сообщения
	 * @see https://dev.vk.com/ru/method/messages.getMessagesReactions
	 */
	public function getMessagesReactions(int|string|null $peerId = null, array|null $cmids = null): mixed
	{
		return $this->sendRequest("messages.getMessagesReactions", [
			"peer_id" => $peerId,
			"cmids" => $cmids !== null ? implode(",", array_map("strval", $cmids)) : null,
		]);
	}

	/**
	 * Получить список пользователей и сообществ, которые поставили реакцию на сообщение
	 * @see https://dev.vk.com/ru/method/messages.getReactedPeers
	 */
	public function getReactedPeers(
		int|string|null $peerId = null,
		int|string|null $cmid = null,
		int|string|null $reactionId = null,
	): mixed
	{
		return $this->sendRequest("messages.getReactedPeers", [
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"reaction_id" => $reactionId,
		]);
	}

	/**
	 * Возвращает информацию о том, разрешена ли отправка сообщений от сообщества пользователю.
	 * @see https://dev.vk.com/ru/method/messages.isMessagesFromGroupAllowed
	 */
	public function isMessagesFromGroupAllowed(int|string|null $groupId = null, int|string|null $userId = null): mixed
	{
		return $this->sendRequest("messages.isMessagesFromGroupAllowed", [
			"group_id" => $groupId,
			"user_id" => $userId,
		]);
	}

	/**
	 * Помечает беседу как отвеченную либо снимает отметку.
	 * @see https://dev.vk.com/ru/method/messages.markAsAnsweredConversation
	 */
	public function markAsAnsweredConversation(
		int|string|null $peerId = null,
		bool|null       $answered = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.markAsAnsweredConversation", [
			"peer_id" => $peerId,
			"answered" => $answered !== null ? (int)$answered : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Помечает беседу как важную либо снимает отметку.
	 * @see https://dev.vk.com/ru/method/messages.markAsImportantConversation
	 */
	public function markAsImportantConversation(
		int|string|null $peerId = null,
		bool|null       $important = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.markAsImportantConversation", [
			"peer_id" => $peerId,
			"important" => $important !== null ? (int)$important : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Метод помечает сообщения как прочитанные.
	 * @see https://dev.vk.com/ru/method/messages.markAsRead
	 */
	public function markAsRead(
		array|null      $messageIds = null,
		int|string|null $peerId = null,
		int|string|null $startMessageId = null,
		int|string|null $groupId = null,
		bool|null       $markConversationAsRead = null,
		int|string|null $upToCmid = null,
	): mixed
	{
		return $this->sendRequest("messages.markAsRead", [
			"message_ids" => $messageIds !== null ? implode(",", array_map("strval", $messageIds)) : null,
			"peer_id" => $peerId,
			"start_message_id" => $startMessageId,
			"group_id" => $groupId,
			"mark_conversation_as_read" => $markConversationAsRead !== null ? (int)$markConversationAsRead : null,
			"up_to_cmid" => $upToCmid,
		]);
	}

	/**
	 * Закрепляет сообщение.
	 * @see https://dev.vk.com/ru/method/messages.pin
	 */
	public function pin(int|string|null $peerId = null, int|string|null $messageId = null, int|string|null $cmid = null): mixed
	{
		return $this->sendRequest("messages.pin", [
			"peer_id" => $peerId,
			"message_id" => $messageId,
			"cmid" => $cmid,
		]);
	}

	/**
	 * Исключает из мультидиалога пользователя, если текущий пользователь или сообщество является администратором беседы либо текущий пользователь пригласил исключаемого пользователя.
	 * @see https://dev.vk.com/ru/method/messages.removeChatUser
	 */
	public function removeChatUser(
		int|string|null $chatId = null,
		int|string|null $userId = null,
		int|string|null $memberId = null,
	): mixed
	{
		return $this->sendRequest("messages.removeChatUser", [
			"chat_id" => $chatId,
			"user_id" => $userId,
			"member_id" => $memberId,
		]);
	}

	/**
	 * Восстанавливает удаленное сообщение.
	 * @see https://dev.vk.com/ru/method/messages.restore
	 */
	public function restore(
		int|string|null $messageId = null,
		int|string|null $groupId = null,
		int|string|null $cmid = null,
		int|string|null $peerId = null,
	): mixed
	{
		return $this->sendRequest("messages.restore", [
			"message_id" => $messageId,
			"group_id" => $groupId,
			"cmid" => $cmid,
			"peer_id" => $peerId,
		]);
	}

	/**
	 * Позволяет искать диалоги.
	 * @see https://dev.vk.com/ru/method/messages.searchConversations
	 */
	public function searchConversations(
		string|null     $q = null,
		int|string|null $count = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.searchConversations", [
			"q" => $q,
			"count" => $count,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Метод установки реакции на сообщение
	 * @see https://dev.vk.com/ru/method/messages.sendReaction
	 */
	public function sendReaction(
		int|string|null $peerId = null,
		int|string|null $cmid = null,
		int|string|null $reactionId = null,
	): mixed
	{
		return $this->sendRequest("messages.sendReaction", [
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"reaction_id" => $reactionId,
		]);
	}

	/**
	 * Изменяет статус набора текста пользователем в диалоге.
	 * @see https://dev.vk.com/ru/method/messages.setActivity
	 */
	public function setActivity(
		int|string|null $peerId = null,
		string          $type = "typing",
		int|string|null $groupId = null,
		int|string|null $userId = null,
	): mixed
	{
		return $this->sendRequest("messages.setActivity", [
			"peer_id" => $peerId,
			"type" => $type,
			"group_id" => $groupId,
			"user_id" => $userId,
		]);
	}

	/**
	 * Метод сохраняет обложку беседы после её успешной загрузки на сервер.
	 * @see https://dev.vk.com/ru/method/messages.setChatPhoto
	 */
	public function setChatPhoto(string $file): mixed
	{
		return $this->sendRequest("messages.setChatPhoto", [
			"file" => $file,
		]);
	}

	/**
	 * Открепляет сообщение.
	 * @see https://dev.vk.com/ru/method/messages.unpin
	 */
	public function unpin(int|string|null $peerId = null, int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("messages.unpin", [
			"peer_id" => $peerId,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает данные, необходимые для подключения к Long Poll серверу.
	 * @see https://dev.vk.com/ru/method/messages.getLongPollServer
	 */
	public function messagesGetLongPollServer(
		bool|null       $needPts = null,
		int|string|null $groupId = null,
		int|string|null $lpVersion = null,
	): mixed
	{
		return $this->sendRequest("messages.getLongPollServer", [
			"need_pts" => $needPts !== null ? (int)$needPts : null,
			"group_id" => $groupId,
			"lp_version" => $lpVersion,
		]);
	}

	/**
	 * Возвращает список найденных личных сообщений текущего пользователя по введенной строке поиска.
	 * @see https://dev.vk.com/ru/method/messages.search
	 */
	public function messagesSearch(
		string|null     $q = null,
		int|string|null $peerId = null,
		int|null        $date = null,
		int|string|null $previewLength = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		bool|null       $extended = null,
		array|null      $fields = null,
		int|string|null $groupId = null,
	): mixed
	{
		return $this->sendRequest("messages.search", [
			"q" => $q,
			"peer_id" => $peerId,
			"date" => $date,
			"preview_length" => $previewLength,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended !== null ? (int)$extended : null,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"group_id" => $groupId,
		]);
	}

	/**
	 * Позволяет добавить адрес в сообщество.
	 * Список адресов может быть получен методом groups.getAddresses.
	 * @see https://dev.vk.com/ru/method/groups.addAddress
	 */
	public function groupsAddAddress(
		int|string|null $groupId = null,
		string|null     $title = null,
		string|null     $address = null,
		string|null     $additionalAddress = null,
		int|string|null $cityId = null,
		int|string|null $metroId = null,
		float|null      $latitude = null,
		float|null      $longitude = null,
		string|null     $phone = null,
		string|null     $workInfoStatus = null,
		string|null     $timetable = null,
		bool|null       $isMainAddress = null,
	): mixed
	{
		return $this->sendRequest("groups.addAddress", [
			"group_id" => $groupId,
			"title" => $title,
			"address" => $address,
			"additional_address" => $additionalAddress,
			"city_id" => $cityId,
			"metro_id" => $metroId,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"phone" => $phone,
			"work_info_status" => $workInfoStatus,
			"timetable" => $timetable,
			"is_main_address" => $isMainAddress !== null ? (int)$isMainAddress : null,
		]);
	}

	/**
	 * Добавляет сервер для Callback API в сообщество.
	 * @see https://dev.vk.com/ru/method/groups.addCallbackServer
	 */
	public function groupsAddCallbackServer(
		int|string|null $groupId = null,
		string|null     $url = null,
		string|null     $title = null,
		string|null     $secretKey = null,
	): mixed
	{
		return $this->sendRequest("groups.addCallbackServer", [
			"group_id" => $groupId,
			"url" => $url,
			"title" => $title,
			"secret_key" => $secretKey,
		]);
	}

	/**
	 * Удаляет адрес сообщества.
	 * @see https://dev.vk.com/ru/method/groups.deleteAddress
	 */
	public function groupsDeleteAddress(int|string|null $groupId = null, int|string|null $addressId = null): mixed
	{
		return $this->sendRequest("groups.deleteAddress", [
			"group_id" => $groupId,
			"address_id" => $addressId,
		]);
	}

	/**
	 * Удаляет сервер для Callback API из сообщества.
	 * @see https://dev.vk.com/ru/method/groups.deleteCallbackServer
	 */
	public function groupsDeleteCallbackServer(int|string|null $groupId = null, int|string|null $serverId = null): mixed
	{
		return $this->sendRequest("groups.deleteCallbackServer", [
			"group_id" => $groupId,
			"server_id" => $serverId,
		]);
	}

	/**
	 * Выключает статус «онлайн» в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.disableOnline
	 */
	public function groupsDisableOnline(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.disableOnline", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Метод редактирует настройки сообщества.
	 * @see https://dev.vk.com/ru/method/groups.edit
	 */
	public function groupsEdit(
		int|string|null $groupId = null,
		string|null     $title = null,
		string|null     $description = null,
		string|null     $screenName = null,
		int|null        $access = null,
		string|null     $website = null,
		int|null        $subject = null,
		string|null     $email = null,
		string|null     $phone = null,
		string|null     $rss = null,
		int|null        $eventStartDate = null,
		int|null        $eventFinishDate = null,
		int|string|null $eventGroupId = null,
		int|string|null $publicCategory = null,
		int|string|null $publicSubcategory = null,
		string|null     $publicDate = null,
		int|null        $wall = null,
		int|null        $topics = null,
		int|null        $photos = null,
		int|null        $video = null,
		int|null        $audio = null,
		bool|null       $links = null,
		bool|null       $events = null,
		bool|null       $places = null,
		bool|null       $contacts = null,
		int|null        $docs = null,
		int|null        $wiki = null,
		bool|null       $messages = null,
		bool|null       $articles = null,
		bool|null       $addresses = null,
		int|null        $ageLimits = null,
		bool|null       $market = null,
		string|null     $marketButtons = null,
		bool|null       $marketComments = null,
		array|null      $marketCountry = null,
		array|null      $marketCity = null,
		int|string|null $marketCurrency = null,
		int|string|null $marketContact = null,
		int|string|null $marketWiki = null,
		bool|null       $obsceneFilter = null,
		bool|null       $obsceneStopwords = null,
		bool|null       $toxicFilter = null,
		bool|null       $disableRepliesFromGroups = null,
		array|null      $obsceneWords = null,
		int|null        $mainSection = null,
		int|null        $secondarySection = null,
		int|string|null $country = null,
		int|string|null $city = null,
	): mixed
	{
		return $this->sendRequest("groups.edit", [
			"group_id" => $groupId,
			"title" => $title,
			"description" => $description,
			"screen_name" => $screenName,
			"access" => $access,
			"website" => $website,
			"subject" => $subject,
			"email" => $email,
			"phone" => $phone,
			"rss" => $rss,
			"event_start_date" => $eventStartDate,
			"event_finish_date" => $eventFinishDate,
			"event_group_id" => $eventGroupId,
			"public_category" => $publicCategory,
			"public_subcategory" => $publicSubcategory,
			"public_date" => $publicDate,
			"wall" => $wall,
			"topics" => $topics,
			"photos" => $photos,
			"video" => $video,
			"audio" => $audio,
			"links" => $links !== null ? (int)$links : null,
			"events" => $events !== null ? (int)$events : null,
			"places" => $places !== null ? (int)$places : null,
			"contacts" => $contacts !== null ? (int)$contacts : null,
			"docs" => $docs,
			"wiki" => $wiki,
			"messages" => $messages !== null ? (int)$messages : null,
			"articles" => $articles !== null ? (int)$articles : null,
			"addresses" => $addresses !== null ? (int)$addresses : null,
			"age_limits" => $ageLimits,
			"market" => $market !== null ? (int)$market : null,
			"market_buttons" => $marketButtons,
			"market_comments" => $marketComments !== null ? (int)$marketComments : null,
			"market_country" => $marketCountry,
			"market_city" => $marketCity,
			"market_currency" => $marketCurrency,
			"market_contact" => $marketContact,
			"market_wiki" => $marketWiki,
			"obscene_filter" => $obsceneFilter !== null ? (int)$obsceneFilter : null,
			"obscene_stopwords" => $obsceneStopwords !== null ? (int)$obsceneStopwords : null,
			"toxic_filter" => $toxicFilter !== null ? (int)$toxicFilter : null,
			"disable_replies_from_groups" => $disableRepliesFromGroups !== null ? (int)$disableRepliesFromGroups : null,
			"obscene_words" => $obsceneWords,
			"main_section" => $mainSection,
			"secondary_section" => $secondarySection,
			"country" => $country,
			"city" => $city,
		]);
	}

	/**
	 * Метод редактирует адрес в сообществе. Чтобы получить список адресов, вызовите метод groups.getAddresses.
	 * @see https://dev.vk.com/ru/method/groups.editAddress
	 */
	public function groupsEditAddress(
		int|string|null $groupId = null,
		int|string|null $addressId = null,
		string|null     $title = null,
		string|null     $address = null,
		string|null     $additionalAddress = null,
		int|string|null $cityId = null,
		int|string|null $metroId = null,
		float|null      $latitude = null,
		float|null      $longitude = null,
		string|null     $phone = null,
		string|null     $workInfoStatus = null,
		string|null     $timetable = null,
		bool|null       $isMainAddress = null,
	): mixed
	{
		return $this->sendRequest("groups.editAddress", [
			"group_id" => $groupId,
			"address_id" => $addressId,
			"title" => $title,
			"address" => $address,
			"additional_address" => $additionalAddress,
			"city_id" => $cityId,
			"metro_id" => $metroId,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"phone" => $phone,
			"work_info_status" => $workInfoStatus,
			"timetable" => $timetable,
			"is_main_address" => $isMainAddress !== null ? (int)$isMainAddress : null,
		]);
	}

	/**
	 * Редактирует данные сервера для Callback API в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.editCallbackServer
	 */
	public function groupsEditCallbackServer(
		int|string|null $groupId = null,
		int|string|null $serverId = null,
		string|null     $url = null,
		string|null     $title = null,
		string|null     $secretKey = null,
	): mixed
	{
		return $this->sendRequest("groups.editCallbackServer", [
			"group_id" => $groupId,
			"server_id" => $serverId,
			"url" => $url,
			"title" => $title,
			"secret_key" => $secretKey,
		]);
	}

	/**
	 * Включает статус «онлайн» в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.enableOnline
	 */
	public function groupsEnableOnline(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.enableOnline", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает список забаненных пользователей и сообществ в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.getBanned
	 */
	public function groupsGetBanned(
		int|string|null $groupId = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		array|null      $fields = null,
		int|string|null $ownerId = null,
	): mixed
	{
		return $this->sendRequest("groups.getBanned", [
			"group_id" => $groupId,
			"offset" => $offset,
			"count" => $count,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"owner_id" => $ownerId,
		]);
	}

	/**
	 * Возвращает информацию о заданном сообществе или о нескольких сообществах.
	 * @see https://dev.vk.com/ru/method/groups.getById
	 */
	public function groupsGetById(array|null $groupIds = null, string|null $groupId = null, array|null $fields = null): mixed
	{
		return $this->sendRequest("groups.getById", [
			"group_ids" => $groupIds !== null ? implode(",", array_map("strval", $groupIds)) : null,
			"group_id" => $groupId,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
		]);
	}

	/**
	 * Позволяет получить строку, необходимую для подтверждения адреса сервера в Callback API.
	 * @see https://dev.vk.com/ru/method/groups.getCallbackConfirmationCode
	 */
	public function groupsGetCallbackConfirmationCode(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.getCallbackConfirmationCode", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Получает информацию о серверах для Callback API в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.getCallbackServers
	 */
	public function groupsGetCallbackServers(int|string|null $groupId = null, array|null $serverIds = null): mixed
	{
		return $this->sendRequest("groups.getCallbackServers", [
			"group_id" => $groupId,
			"server_ids" => $serverIds !== null ? implode(",", array_map("strval", $serverIds)) : null,
		]);
	}

	/**
	 * Позволяет получить настройки уведомлений Callback API для сообщества.
	 * @see https://dev.vk.com/ru/method/groups.getCallbackSettings
	 */
	public function groupsGetCallbackSettings(int|string|null $groupId = null, int|string|null $serverId = null): mixed
	{
		return $this->sendRequest("groups.getCallbackSettings", [
			"group_id" => $groupId,
			"server_id" => $serverId,
		]);
	}

	/**
	 * Возвращает данные для подключения к Bots Longpoll API.
	 * @see https://dev.vk.com/ru/method/groups.getLongPollServer
	 */
	public function groupsGetLongPollServer(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.getLongPollServer", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Получает настройки Bots Longpoll API для сообщества.
	 * @see https://dev.vk.com/ru/method/groups.getLongPollSettings
	 */
	public function groupsGetLongPollSettings(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.getLongPollSettings", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает список участников сообщества.
	 * @see https://dev.vk.com/ru/method/groups.getMembers
	 */
	public function groupsGetMembers(
		string|null     $groupId = null,
		string|null     $sort = null,
		int|string|null $offset = null,
		int|string|null $count = null,
		array|null      $fields = null,
		string|null     $filter = null,
	): mixed
	{
		return $this->sendRequest("groups.getMembers", [
			"group_id" => $groupId,
			"sort" => $sort,
			"offset" => $offset,
			"count" => $count,
			"fields" => $fields !== null ? implode(",", array_map("strval", $fields)) : null,
			"filter" => $filter,
		]);
	}

	/**
	 * Получает информацию о статусе «онлайн» в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.getOnlineStatus
	 */
	public function groupsGetOnlineStatus(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.getOnlineStatus", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает список тегов сообщества
	 * @see https://dev.vk.com/ru/method/groups.getTagList
	 */
	public function groupsGetTagList(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("groups.getTagList", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Возвращает настройки прав для ключа доступа сообщества.
	 * @see https://dev.vk.com/ru/method/groups.getTokenPermissions
	 */
	public function groupsGetTokenPermissions(): mixed
	{
		return $this->sendRequest("groups.getTokenPermissions");
	}

	/**
	 * Возвращает информацию о том, является ли пользователь участником сообщества.
	 * @see https://dev.vk.com/ru/method/groups.isMember
	 */
	public function groupsIsMember(
		string|null     $groupId = null,
		int|string|null $userId = null,
		array|null      $userIds = null,
		bool|null       $extended = null,
	): mixed
	{
		return $this->sendRequest("groups.isMember", [
			"group_id" => $groupId,
			"user_id" => $userId,
			"user_ids" => $userIds !== null ? implode(",", array_map("strval", $userIds)) : null,
			"extended" => $extended !== null ? (int)$extended : null,
		]);
	}

	/**
	 * Позволяет задать настройки уведомлений о событиях в Callback API.
	 * @see https://dev.vk.com/ru/method/groups.setCallbackSettings
	 */
	public function groupsSetCallbackSettings(
		int|string|null $groupId = null,
		int|string|null $serverId = null,
		string|null     $apiVersion = null,
		bool|null       $messageNew = null,
		bool|null       $messageReply = null,
		bool|null       $messageAllow = null,
		bool|null       $messageEdit = null,
		bool|null       $messageDeny = null,
		bool|null       $messageTypingState = null,
		bool|null       $messageRead = null,
		bool|null       $photoNew = null,
		bool|null       $audioNew = null,
		bool|null       $videoNew = null,
		bool|null       $wallReplyNew = null,
		bool|null       $wallReplyEdit = null,
		bool|null       $wallReplyDelete = null,
		bool|null       $wallReplyRestore = null,
		bool|null       $wallPostNew = null,
		bool|null       $wallRepost = null,
		bool|null       $wallSchedulePostNew = null,
		bool|null       $wallSchedulePostDelete = null,
		bool|null       $boardPostNew = null,
		bool|null       $boardPostEdit = null,
		bool|null       $boardPostRestore = null,
		bool|null       $boardPostDelete = null,
		bool|null       $photoCommentNew = null,
		bool|null       $photoCommentEdit = null,
		bool|null       $photoCommentDelete = null,
		bool|null       $photoCommentRestore = null,
		bool|null       $videoCommentNew = null,
		bool|null       $videoCommentEdit = null,
		bool|null       $videoCommentDelete = null,
		bool|null       $videoCommentRestore = null,
		bool|null       $marketCommentNew = null,
		bool|null       $marketCommentEdit = null,
		bool|null       $marketCommentDelete = null,
		bool|null       $marketCommentRestore = null,
		bool|null       $marketOrderNew = null,
		bool|null       $marketOrderEdit = null,
		bool|null       $pollVoteNew = null,
		bool|null       $groupJoin = null,
		bool|null       $groupLeave = null,
		bool|null       $groupChangeSettings = null,
		bool|null       $groupChangePhoto = null,
		bool|null       $groupOfficersEdit = null,
		bool|null       $userBlock = null,
		bool|null       $userUnblock = null,
		bool|null       $leadFormsNew = null,
		bool|null       $likeAdd = null,
		bool|null       $likeRemove = null,
		bool|null       $messageEvent = null,
		bool|null       $messageReactionEvent = null,
		bool|null       $donutSubscriptionCreate = null,
		bool|null       $donutSubscriptionProlonged = null,
		bool|null       $donutSubscriptionCancelled = null,
		bool|null       $donutSubscriptionPriceChanged = null,
		bool|null       $donutSubscriptionExpired = null,
		bool|null       $donutMoneyWithdraw = null,
		bool|null       $donutMoneyWithdrawError = null,
	): mixed
	{
		return $this->sendRequest("groups.setCallbackSettings", [
			"group_id" => $groupId,
			"server_id" => $serverId,
			"api_version" => $apiVersion,
			"message_new" => $messageNew !== null ? (int)$messageNew : null,
			"message_reply" => $messageReply !== null ? (int)$messageReply : null,
			"message_allow" => $messageAllow !== null ? (int)$messageAllow : null,
			"message_edit" => $messageEdit !== null ? (int)$messageEdit : null,
			"message_deny" => $messageDeny !== null ? (int)$messageDeny : null,
			"message_typing_state" => $messageTypingState !== null ? (int)$messageTypingState : null,
			"message_read" => $messageRead !== null ? (int)$messageRead : null,
			"photo_new" => $photoNew !== null ? (int)$photoNew : null,
			"audio_new" => $audioNew !== null ? (int)$audioNew : null,
			"video_new" => $videoNew !== null ? (int)$videoNew : null,
			"wall_reply_new" => $wallReplyNew !== null ? (int)$wallReplyNew : null,
			"wall_reply_edit" => $wallReplyEdit !== null ? (int)$wallReplyEdit : null,
			"wall_reply_delete" => $wallReplyDelete !== null ? (int)$wallReplyDelete : null,
			"wall_reply_restore" => $wallReplyRestore !== null ? (int)$wallReplyRestore : null,
			"wall_post_new" => $wallPostNew !== null ? (int)$wallPostNew : null,
			"wall_repost" => $wallRepost !== null ? (int)$wallRepost : null,
			"wall_schedule_post_new" => $wallSchedulePostNew !== null ? (int)$wallSchedulePostNew : null,
			"wall_schedule_post_delete" => $wallSchedulePostDelete !== null ? (int)$wallSchedulePostDelete : null,
			"board_post_new" => $boardPostNew !== null ? (int)$boardPostNew : null,
			"board_post_edit" => $boardPostEdit !== null ? (int)$boardPostEdit : null,
			"board_post_restore" => $boardPostRestore !== null ? (int)$boardPostRestore : null,
			"board_post_delete" => $boardPostDelete !== null ? (int)$boardPostDelete : null,
			"photo_comment_new" => $photoCommentNew !== null ? (int)$photoCommentNew : null,
			"photo_comment_edit" => $photoCommentEdit !== null ? (int)$photoCommentEdit : null,
			"photo_comment_delete" => $photoCommentDelete !== null ? (int)$photoCommentDelete : null,
			"photo_comment_restore" => $photoCommentRestore !== null ? (int)$photoCommentRestore : null,
			"video_comment_new" => $videoCommentNew !== null ? (int)$videoCommentNew : null,
			"video_comment_edit" => $videoCommentEdit !== null ? (int)$videoCommentEdit : null,
			"video_comment_delete" => $videoCommentDelete !== null ? (int)$videoCommentDelete : null,
			"video_comment_restore" => $videoCommentRestore !== null ? (int)$videoCommentRestore : null,
			"market_comment_new" => $marketCommentNew !== null ? (int)$marketCommentNew : null,
			"market_comment_edit" => $marketCommentEdit !== null ? (int)$marketCommentEdit : null,
			"market_comment_delete" => $marketCommentDelete !== null ? (int)$marketCommentDelete : null,
			"market_comment_restore" => $marketCommentRestore !== null ? (int)$marketCommentRestore : null,
			"market_order_new" => $marketOrderNew !== null ? (int)$marketOrderNew : null,
			"market_order_edit" => $marketOrderEdit !== null ? (int)$marketOrderEdit : null,
			"poll_vote_new" => $pollVoteNew !== null ? (int)$pollVoteNew : null,
			"group_join" => $groupJoin !== null ? (int)$groupJoin : null,
			"group_leave" => $groupLeave !== null ? (int)$groupLeave : null,
			"group_change_settings" => $groupChangeSettings !== null ? (int)$groupChangeSettings : null,
			"group_change_photo" => $groupChangePhoto !== null ? (int)$groupChangePhoto : null,
			"group_officers_edit" => $groupOfficersEdit !== null ? (int)$groupOfficersEdit : null,
			"user_block" => $userBlock !== null ? (int)$userBlock : null,
			"user_unblock" => $userUnblock !== null ? (int)$userUnblock : null,
			"lead_forms_new" => $leadFormsNew !== null ? (int)$leadFormsNew : null,
			"like_add" => $likeAdd !== null ? (int)$likeAdd : null,
			"like_remove" => $likeRemove !== null ? (int)$likeRemove : null,
			"message_event" => $messageEvent !== null ? (int)$messageEvent : null,
			"message_reaction_event" => $messageReactionEvent !== null ? (int)$messageReactionEvent : null,
			"donut_subscription_create" => $donutSubscriptionCreate !== null ? (int)$donutSubscriptionCreate : null,
			"donut_subscription_prolonged" => $donutSubscriptionProlonged !== null ? (int)$donutSubscriptionProlonged : null,
			"donut_subscription_cancelled" => $donutSubscriptionCancelled !== null ? (int)$donutSubscriptionCancelled : null,
			"donut_subscription_price_changed" => $donutSubscriptionPriceChanged !== null ? (int)$donutSubscriptionPriceChanged : null,
			"donut_subscription_expired" => $donutSubscriptionExpired !== null ? (int)$donutSubscriptionExpired : null,
			"donut_money_withdraw" => $donutMoneyWithdraw !== null ? (int)$donutMoneyWithdraw : null,
			"donut_money_withdraw_error" => $donutMoneyWithdrawError !== null ? (int)$donutMoneyWithdrawError : null,
		]);
	}

	/**
	 * Задаёт настройки для Bots Long Poll API в сообществе.
	 * @see https://dev.vk.com/ru/method/groups.setLongPollSettings
	 */
	public function groupsSetLongPollSettings(
		int|string|null $groupId = null,
		bool|null       $enabled = null,
		string|null     $apiVersion = null,
		bool|null       $messageNew = null,
		bool|null       $messageReply = null,
		bool|null       $messageAllow = null,
		bool|null       $messageDeny = null,
		bool|null       $messageEdit = null,
		bool|null       $messageTypingState = null,
		bool|null       $messageRead = null,
		bool|null       $photoNew = null,
		bool|null       $audioNew = null,
		bool|null       $videoNew = null,
		bool|null       $wallReplyNew = null,
		bool|null       $wallReplyEdit = null,
		bool|null       $wallReplyDelete = null,
		bool|null       $wallReplyRestore = null,
		bool|null       $wallPostNew = null,
		bool|null       $wallRepost = null,
		bool|null       $boardPostNew = null,
		bool|null       $boardPostEdit = null,
		bool|null       $boardPostRestore = null,
		bool|null       $boardPostDelete = null,
		bool|null       $photoCommentNew = null,
		bool|null       $photoCommentEdit = null,
		bool|null       $photoCommentDelete = null,
		bool|null       $photoCommentRestore = null,
		bool|null       $videoCommentNew = null,
		bool|null       $videoCommentEdit = null,
		bool|null       $videoCommentDelete = null,
		bool|null       $videoCommentRestore = null,
		bool|null       $marketCommentNew = null,
		bool|null       $marketCommentEdit = null,
		bool|null       $marketCommentDelete = null,
		bool|null       $marketCommentRestore = null,
		bool|null       $pollVoteNew = null,
		bool|null       $groupJoin = null,
		bool|null       $groupLeave = null,
		bool|null       $groupChangeSettings = null,
		bool|null       $groupChangePhoto = null,
		bool|null       $groupOfficersEdit = null,
		bool|null       $userBlock = null,
		bool|null       $userUnblock = null,
		bool|null       $likeAdd = null,
		bool|null       $likeRemove = null,
		bool|null       $messageEvent = null,
		bool|null       $messageReactionEvent = null,
		bool|null       $donutSubscriptionCreate = null,
		bool|null       $donutSubscriptionProlonged = null,
		bool|null       $donutSubscriptionCancelled = null,
		bool|null       $donutSubscriptionPriceChanged = null,
		bool|null       $donutSubscriptionExpired = null,
		bool|null       $donutMoneyWithdraw = null,
		bool|null       $donutMoneyWithdrawError = null,
	): mixed
	{
		return $this->sendRequest("groups.setLongPollSettings", [
			"group_id" => $groupId,
			"enabled" => $enabled !== null ? (int)$enabled : null,
			"api_version" => $apiVersion,
			"message_new" => $messageNew !== null ? (int)$messageNew : null,
			"message_reply" => $messageReply !== null ? (int)$messageReply : null,
			"message_allow" => $messageAllow !== null ? (int)$messageAllow : null,
			"message_deny" => $messageDeny !== null ? (int)$messageDeny : null,
			"message_edit" => $messageEdit !== null ? (int)$messageEdit : null,
			"message_typing_state" => $messageTypingState !== null ? (int)$messageTypingState : null,
			"message_read" => $messageRead !== null ? (int)$messageRead : null,
			"photo_new" => $photoNew !== null ? (int)$photoNew : null,
			"audio_new" => $audioNew !== null ? (int)$audioNew : null,
			"video_new" => $videoNew !== null ? (int)$videoNew : null,
			"wall_reply_new" => $wallReplyNew !== null ? (int)$wallReplyNew : null,
			"wall_reply_edit" => $wallReplyEdit !== null ? (int)$wallReplyEdit : null,
			"wall_reply_delete" => $wallReplyDelete !== null ? (int)$wallReplyDelete : null,
			"wall_reply_restore" => $wallReplyRestore !== null ? (int)$wallReplyRestore : null,
			"wall_post_new" => $wallPostNew !== null ? (int)$wallPostNew : null,
			"wall_repost" => $wallRepost !== null ? (int)$wallRepost : null,
			"board_post_new" => $boardPostNew !== null ? (int)$boardPostNew : null,
			"board_post_edit" => $boardPostEdit !== null ? (int)$boardPostEdit : null,
			"board_post_restore" => $boardPostRestore !== null ? (int)$boardPostRestore : null,
			"board_post_delete" => $boardPostDelete !== null ? (int)$boardPostDelete : null,
			"photo_comment_new" => $photoCommentNew !== null ? (int)$photoCommentNew : null,
			"photo_comment_edit" => $photoCommentEdit !== null ? (int)$photoCommentEdit : null,
			"photo_comment_delete" => $photoCommentDelete !== null ? (int)$photoCommentDelete : null,
			"photo_comment_restore" => $photoCommentRestore !== null ? (int)$photoCommentRestore : null,
			"video_comment_new" => $videoCommentNew !== null ? (int)$videoCommentNew : null,
			"video_comment_edit" => $videoCommentEdit !== null ? (int)$videoCommentEdit : null,
			"video_comment_delete" => $videoCommentDelete !== null ? (int)$videoCommentDelete : null,
			"video_comment_restore" => $videoCommentRestore !== null ? (int)$videoCommentRestore : null,
			"market_comment_new" => $marketCommentNew !== null ? (int)$marketCommentNew : null,
			"market_comment_edit" => $marketCommentEdit !== null ? (int)$marketCommentEdit : null,
			"market_comment_delete" => $marketCommentDelete !== null ? (int)$marketCommentDelete : null,
			"market_comment_restore" => $marketCommentRestore !== null ? (int)$marketCommentRestore : null,
			"poll_vote_new" => $pollVoteNew !== null ? (int)$pollVoteNew : null,
			"group_join" => $groupJoin !== null ? (int)$groupJoin : null,
			"group_leave" => $groupLeave !== null ? (int)$groupLeave : null,
			"group_change_settings" => $groupChangeSettings !== null ? (int)$groupChangeSettings : null,
			"group_change_photo" => $groupChangePhoto !== null ? (int)$groupChangePhoto : null,
			"group_officers_edit" => $groupOfficersEdit !== null ? (int)$groupOfficersEdit : null,
			"user_block" => $userBlock !== null ? (int)$userBlock : null,
			"user_unblock" => $userUnblock !== null ? (int)$userUnblock : null,
			"like_add" => $likeAdd !== null ? (int)$likeAdd : null,
			"like_remove" => $likeRemove !== null ? (int)$likeRemove : null,
			"message_event" => $messageEvent !== null ? (int)$messageEvent : null,
			"message_reaction_event" => $messageReactionEvent !== null ? (int)$messageReactionEvent : null,
			"donut_subscription_create" => $donutSubscriptionCreate !== null ? (int)$donutSubscriptionCreate : null,
			"donut_subscription_prolonged" => $donutSubscriptionProlonged !== null ? (int)$donutSubscriptionProlonged : null,
			"donut_subscription_cancelled" => $donutSubscriptionCancelled !== null ? (int)$donutSubscriptionCancelled : null,
			"donut_subscription_price_changed" => $donutSubscriptionPriceChanged !== null ? (int)$donutSubscriptionPriceChanged : null,
			"donut_subscription_expired" => $donutSubscriptionExpired !== null ? (int)$donutSubscriptionExpired : null,
			"donut_money_withdraw" => $donutMoneyWithdraw !== null ? (int)$donutMoneyWithdraw : null,
			"donut_money_withdraw_error" => $donutMoneyWithdrawError !== null ? (int)$donutMoneyWithdrawError : null,
		]);
	}

	/**
	 * Устанавливает настройки сообщества
	 * @see https://dev.vk.com/ru/method/groups.setSettings
	 */
	public function groupsSetSettings(
		int|string|null $groupId = null,
		bool|null       $messages = null,
		bool|null       $botsCapabilities = null,
		bool|null       $botsStartButton = null,
		bool|null       $botsAddToChat = null,
		bool|null       $botOnlineBookingEnabled = null,
	): mixed
	{
		return $this->sendRequest("groups.setSettings", [
			"group_id" => $groupId,
			"messages" => $messages !== null ? (int)$messages : null,
			"bots_capabilities" => $botsCapabilities !== null ? (int)$botsCapabilities : null,
			"bots_start_button" => $botsStartButton !== null ? (int)$botsStartButton : null,
			"bots_add_to_chat" => $botsAddToChat !== null ? (int)$botsAddToChat : null,
			"bot_online_booking_enabled" => $botOnlineBookingEnabled !== null ? (int)$botOnlineBookingEnabled : null,
		]);
	}

	/**
	 * Позволяет создать или отредактировать заметку о пользователе в рамках переписки пользователя с сообществом
	 * @see https://dev.vk.com/ru/method/groups.setUserNote
	 */
	public function groupsSetUserNote(int|string|null $groupId = null, int|string|null $userId = null, string|null $note = null): mixed
	{
		return $this->sendRequest("groups.setUserNote", [
			"group_id" => $groupId,
			"user_id" => $userId,
			"note" => $note,
		]);
	}

	/**
	 * Позволяет добавить новый тег в сообщество.
	 * @see https://dev.vk.com/ru/method/groups.tagAdd
	 */
	public function groupsTagAdd(int|string|null $groupId = null, string|null $tagName = null, string|null $tagColor = null): mixed
	{
		return $this->sendRequest("groups.tagAdd", [
			"group_id" => $groupId,
			"tag_name" => $tagName,
			"tag_color" => $tagColor,
		]);
	}

	/**
	 * Позволяет «привязывать» и «отвязывать» теги сообщества к беседам.
	 * @see https://dev.vk.com/ru/method/groups.tagBind
	 */
	public function groupsTagBind(
		int|string|null $groupId = null,
		int|string|null $tagId = null,
		int|string|null $userId = null,
		string|null     $act = null,
	): mixed
	{
		return $this->sendRequest("groups.tagBind", [
			"group_id" => $groupId,
			"tag_id" => $tagId,
			"user_id" => $userId,
			"act" => $act,
		]);
	}

	/**
	 * Позволяет удалить тег сообщества.
	 * @see https://dev.vk.com/ru/method/groups.tagDelete
	 */
	public function groupsTagDelete(int|string|null $groupId = null, int|string|null $tagId = null): mixed
	{
		return $this->sendRequest("groups.tagDelete", [
			"group_id" => $groupId,
			"tag_id" => $tagId,
		]);
	}

	/**
	 * Позволяет переименовать существующий тег.
	 * @see https://dev.vk.com/ru/method/groups.tagUpdate
	 */
	public function groupsTagUpdate(int|string|null $groupId = null, int|string|null $tagId = null, string|null $tagName = null): mixed
	{
		return $this->sendRequest("groups.tagUpdate", [
			"group_id" => $groupId,
			"tag_id" => $tagId,
			"tag_name" => $tagName,
		]);
	}

	/**
	 * Возвращает информацию о документах по их идентификаторам.
	 * @see https://dev.vk.com/ru/method/docs.getById
	 */
	public function docsGetById(array|null $docs = null, bool|null $returnTags = null): mixed
	{
		return $this->sendRequest("docs.getById", [
			"docs" => $docs !== null ? implode(",", array_map("strval", $docs)) : null,
			"return_tags" => $returnTags !== null ? (int)$returnTags : null,
		]);
	}

	/**
	 * Метод получает адрес сервера для загрузки файла в личное сообщение.
	 * @see https://dev.vk.com/ru/method/docs.getMessagesUploadServer
	 */
	public function docsGetMessagesUploadServer(string|null $type = null, int|string|null $peerId = null): mixed
	{
		return $this->sendRequest("docs.getMessagesUploadServer", [
			"type" => $type,
			"peer_id" => $peerId,
		]);
	}

	/**
	 * Метод возвращает upload-сервер для загрузки документа на стену.
	 * @see https://dev.vk.com/ru/method/docs.getWallUploadServer
	 */
	public function docsGetWallUploadServer(int|string|null $groupId = null): mixed
	{
		return $this->sendRequest("docs.getWallUploadServer", [
			"group_id" => $groupId,
		]);
	}

	/**
	 * Метод сохраняет загруженный документ.
	 * @see https://dev.vk.com/ru/method/docs.save
	 */
	public function docsSave(
		string|null $file = null,
		string|null $title = null,
		string|null $tags = null,
		bool|null   $returnTags = null,
	): mixed
	{
		return UploadSaveResponseNormalizer::normalizeDocsSaveResponse($this->sendRequest("docs.save", [
			"file" => $file,
			"title" => $title,
			"tags" => $tags,
			"return_tags" => $returnTags !== null ? (int)$returnTags : null,
		]));
	}

	/**
	 * Метод выполняет поиск документов.
	 * @see https://dev.vk.com/ru/method/docs.search
	 */
	public function docsSearch(
		string|null     $q = null,
		bool|null       $searchOwn = null,
		int|string|null $count = null,
		int|string|null $offset = null,
		bool|null       $returnTags = null,
	): mixed
	{
		return $this->sendRequest("docs.search", [
			"q" => $q,
			"search_own" => $searchOwn !== null ? (int)$searchOwn : null,
			"count" => $count,
			"offset" => $offset,
			"return_tags" => $returnTags !== null ? (int)$returnTags : null,
		]);
	}

	/**
	 * Метод получает адрес сервера для загрузки обложки чата.
	 * @see https://dev.vk.com/ru/method/photos.getChatUploadServer
	 */
	public function photosGetChatUploadServer(
		int|string|null $chatId = null,
		int|null        $cropX = null,
		int|null        $cropY = null,
		int|null        $cropWidth = null,
	): mixed
	{
		return $this->sendRequest("photos.getChatUploadServer", [
			"chat_id" => $chatId,
			"crop_x" => $cropX,
			"crop_y" => $cropY,
			"crop_width" => $cropWidth,
		]);
	}

	/**
	 * Метод получает адрес сервера для загрузки фотографии в личное сообщение пользователя или в сообщение сообщества.
	 * @see https://dev.vk.com/ru/method/photos.getMessagesUploadServer
	 */
	public function photosGetMessagesUploadServer(int|string|null $peerId = null): mixed
	{
		return $this->sendRequest("photos.getMessagesUploadServer", [
			"peer_id" => $peerId,
		]);
	}

	/**
	 * Метод получает адрес сервера для загрузки обложки сообщества.
	 * @see https://dev.vk.com/ru/method/photos.getOwnerCoverPhotoUploadServer
	 */
	public function photosGetOwnerCoverPhotoUploadServer(
		int|string|null $groupId = null,
		int|null        $cropX = null,
		int|null        $cropY = null,
		int|null        $cropX2 = null,
		int|null        $cropY2 = null,
		bool|null       $isVideoCover = null,
	): mixed
	{
		return $this->sendRequest("photos.getOwnerCoverPhotoUploadServer", [
			"group_id" => $groupId,
			"crop_x" => $cropX,
			"crop_y" => $cropY,
			"crop_x2" => $cropX2,
			"crop_y2" => $cropY2,
			"is_video_cover" => $isVideoCover !== null ? (int)$isVideoCover : null,
		]);
	}

	/**
	 * Метод сохраняет фотографию в личном сообщении после её успешной загрузки на сервер.
	 * @see https://dev.vk.com/ru/method/photos.saveMessagesPhoto
	 */
	public function photosSaveMessagesPhoto(string|null $photo = null, int|null $server = null, string|null $hash = null): mixed
	{
		return UploadSaveResponseNormalizer::normalizeListResponse($this->sendRequest("photos.saveMessagesPhoto", [
			"photo" => $photo,
			"server" => $server,
			"hash" => $hash,
		]));
	}

	/**
	 * Метод сохраняет обложку сообщества или профиля пользователя после её успешной загрузки на сервер.
	 * @see https://dev.vk.com/ru/method/photos.saveOwnerCoverPhoto
	 */
	public function photosSaveOwnerCoverPhoto(
		int|null    $cropX = null,
		int|null    $cropHeight = null,
		int|null    $cropY = null,
		int|null    $cropWidth = null,
		string|null $responseJson = null,
		string|null $hash = null,
		string|null $photo = null,
		bool|null   $isVideoCover = null,
	): mixed
	{
		return $this->sendRequest("photos.saveOwnerCoverPhoto", [
			"crop_x" => $cropX,
			"crop_height" => $cropHeight,
			"crop_y" => $cropY,
			"crop_width" => $cropWidth,
			"response_json" => $responseJson,
			"hash" => $hash,
			"photo" => $photo,
			"is_video_cover" => $isVideoCover !== null ? (int)$isVideoCover : null,
		]);
	}

	/**
	 * Метод удаляет комментарий в обсуждении сообщества.
	 * @see https://dev.vk.com/ru/method/board.deleteComment
	 */
	public function boardDeleteComment(
		int|string|null $groupId = null,
		int|string|null $topicId = null,
		int|string|null $commentId = null,
	): mixed
	{
		return $this->sendRequest("board.deleteComment", [
			"group_id" => $groupId,
			"topic_id" => $topicId,
			"comment_id" => $commentId,
		]);
	}

	/**
	 * Метод восстанавливает комментарий в обсуждении сообщества.
	 * @see https://dev.vk.com/ru/method/board.restoreComment
	 */
	public function boardRestoreComment(
		int|string|null $groupId = null,
		int|string|null $topicId = null,
		int|string|null $commentId = null,
	): mixed
	{
		return $this->sendRequest("board.restoreComment", [
			"group_id" => $groupId,
			"topic_id" => $topicId,
			"comment_id" => $commentId,
		]);
	}

	/**
	 * Выключает комментирование записи.
	 * @see https://dev.vk.com/ru/method/wall.closeComments
	 */
	public function wallCloseComments(int|string|null $ownerId = null, int|string|null $postId = null): mixed
	{
		return $this->sendRequest("wall.closeComments", [
			"owner_id" => $ownerId,
			"post_id" => $postId,
		]);
	}

	/**
	 * Добавляет комментарий к записи на стене.
	 * @see https://dev.vk.com/ru/method/wall.createComment
	 */
	public function wallCreateComment(
		int|string|null $ownerId = null,
		int|string|null $postId = null,
		int|string|null $fromGroup = null,
		string|null     $message = null,
		int|string|null $replyToComment = null,
		array|null      $attachments = null,
		int|null        $stickerId = null,
		string|null     $guid = null,
	): mixed
	{
		return $this->sendRequest("wall.createComment", [
			"owner_id" => $ownerId,
			"post_id" => $postId,
			"from_group" => $fromGroup,
			"message" => $message,
			"reply_to_comment" => $replyToComment,
			"attachments" => $attachments !== null ? implode(",", array_map("strval", $attachments)) : null,
			"sticker_id" => $stickerId,
			"guid" => $guid,
		]);
	}

	/**
	 * Включает комментирование записи.
	 * @see https://dev.vk.com/ru/method/wall.openComments
	 */
	public function wallOpenComments(int|string|null $ownerId = null, int|string|null $postId = null): mixed
	{
		return $this->sendRequest("wall.openComments", [
			"owner_id" => $ownerId,
			"post_id" => $postId,
		]);
	}

}
