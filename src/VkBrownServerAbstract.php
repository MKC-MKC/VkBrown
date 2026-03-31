<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Route\BoardRoute;
use Haikiri\VkBrown\Route\DocsRoute;
use Haikiri\VkBrown\Route\GroupsRoute;
use Haikiri\VkBrown\Route\MessagesRoute;
use Haikiri\VkBrown\Route\PhotosRoute;
use Haikiri\VkBrown\Route\WallRoute;

abstract class VkBrownServerAbstract
{
	public static bool $debug;
	private int|null $resolvedGroupId = null;
	private BoardRoute|null $boardRoute = null;
	private DocsRoute|null $docsRoute = null;
	private MessagesRoute|null $messagesRoute = null;
	private GroupsRoute|null $groupsRoute = null;
	private PhotosRoute|null $photosRoute = null;
	private WallRoute|null $wallRoute = null;

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
		$response = $this->groups()->getById();
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

	public function messages(): MessagesRoute
	{
		return $this->messagesRoute ??= new MessagesRoute($this);
	}

	public function docs(): DocsRoute
	{
		return $this->docsRoute ??= new DocsRoute($this);
	}

	public function photos(): PhotosRoute
	{
		return $this->photosRoute ??= new PhotosRoute($this);
	}

	public function board(): BoardRoute
	{
		return $this->boardRoute ??= new BoardRoute($this);
	}

	public function wall(): WallRoute
	{
		return $this->wallRoute ??= new WallRoute($this);
	}

	public function groups(): GroupsRoute
	{
		return $this->groupsRoute ??= new GroupsRoute($this);
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
	 * @noinspection SpellCheckingInspection
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
	 * @noinspection SpellCheckingInspection
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
	 * @noinspection SpellCheckingInspection
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
		return array_map(fn(array $item): Objects\Message => new Objects\Message($item), $response?->getItems() ?? []);
	}

	/**
	 * Метод позволяет получить информацию о пользователях.
	 * @see https://dev.vk.com/ru/method/users.get
	 * @param array $userIds Массив идентификаторов пользователей.
	 * @param array|null $fields Массив полей, которые необходимо вернуть.
	 * @param string $nameCase Падеж для склонения имени и фамилии пользователя. Именительный по умолчанию.
	 * @return Objects\User[]
	 */
	public function getUsers(array $userIds, array|null $fields = null, string $nameCase = "nom"): array
	{
		$params = [];
		$params["user_ids"] = implode(",", array_map("strval", $userIds));
		if ($fields !== null) $params["fields"] = implode(",", array_map("strval", $fields));
		if ($nameCase !== null) $params["name_case"] = $nameCase;

		$response = $this->sendRequest("users.get", $params);
		return array_map(fn(array $item): Objects\User => new Objects\User($item), $response->getRaw() ?? []);
	}

	/**
	 * Метод отправляет событие с действием, которое произойдет при нажатии на callback-кнопку.
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

}
