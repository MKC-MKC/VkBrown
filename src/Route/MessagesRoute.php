<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

use Haikiri\VkBrown\Objects\Message;

class MessagesRoute extends AbstractRoute
{

	/**
	 * Метод создаёт беседу от имени сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function createChat(array $params = []): mixed
	{
		return $this->request("messages.createChat", $params, ["user_ids"]);
	}

	/**
	 * Метод удаляет сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function delete(array $params = []): mixed
	{
		return $this->request("messages.delete", $params, ["message_ids", "cmids"]);
	}

	/**
	 * Метод удаляет обложку беседы.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteChatPhoto(array $params = []): mixed
	{
		return $this->request("messages.deleteChatPhoto", $params);
	}

	/**
	 * Метод удаляет диалог.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteConversation(array $params = []): mixed
	{
		return $this->request("messages.deleteConversation", $params);
	}

	/**
	 * Метод удаляет реакцию на сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteReaction(array $params = []): mixed
	{
		return $this->request("messages.deleteReaction", $params);
	}

	/**
	 * Метод редактирует сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function edit(array $params = []): mixed
	{
		return $this->request("messages.edit", $params);
	}

	/**
	 * Метод редактирует название беседы.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function editChat(array $params = []): mixed
	{
		return $this->request("messages.editChat", $params);
	}

	/**
	 * Метод возвращает сообщения по conversation_message_id.
	 *
	 * @param array $params
	 * @return Message[]
	 */
	public function getByConversationMessageId(array $params = []): array
	{
		$response = $this->request("messages.getByConversationMessageId", $params, ["conversation_message_ids", "fields"]);
		return array_map(static fn(array $item): Message => new Message($item), $response?->getItems() ?? []);
	}

	/**
	 * Метод возвращает сообщения по message_id.
	 *
	 * @param array $params
	 * @return Message[]
	 */
	public function getById(array $params = []): array
	{
		$response = $this->request("messages.getById", $params, ["message_ids", "cmids", "fields"]);
		return array_map(static fn(array $item): Message => new Message($item), $response?->getItems() ?? []);
	}

	/**
	 * Метод возвращает участников диалога.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getConversationMembers(array $params = []): mixed
	{
		return $this->request("messages.getConversationMembers", $params, ["fields", "member_ids"]);
	}

	/**
	 * Метод возвращает список диалогов.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getConversations(array $params = []): mixed
	{
		return $this->request("messages.getConversations", $params, ["fields"]);
	}

	/**
	 * Метод возвращает диалоги по peer_id.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getConversationsById(array $params = []): mixed
	{
		return $this->request("messages.getConversationsById", $params, ["peer_ids", "fields"]);
	}

	/**
	 * Метод возвращает историю сообщений.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getHistory(array $params = []): mixed
	{
		return $this->request("messages.getHistory", $params, ["fields"]);
	}

	/**
	 * Метод возвращает вложения из истории сообщений.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getHistoryAttachments(array $params = []): mixed
	{
		return $this->request("messages.getHistoryAttachments", $params, ["attachment_types", "fields"]);
	}

	/**
	 * Метод возвращает важные сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getImportantMessages(array $params = []): mixed
	{
		return $this->request("messages.getImportantMessages", $params, ["fields"]);
	}

	/**
	 * Метод возвращает пользователей по intent.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getIntentUsers(array $params = []): mixed
	{
		return $this->request("messages.getIntentUsers", $params, ["fields"]);
	}

	/**
	 * Метод возвращает ссылку-приглашение в беседу.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getInviteLink(array $params = []): mixed
	{
		return $this->request("messages.getInviteLink", $params);
	}

	/**
	 * Метод возвращает Long Poll историю.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getLongPollHistory(array $params = []): mixed
	{
		return $this->request("messages.getLongPollHistory", $params, ["fields"]);
	}

	/**
	 * Метод возвращает Long Poll сервер для сообщений.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getLongPollServer(array $params = []): mixed
	{
		return $this->request("messages.getLongPollServer", $params);
	}

	/**
	 * Метод возвращает реакции по сообщениям.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getMessagesReactions(array $params = []): mixed
	{
		return $this->request("messages.getMessagesReactions", $params, ["cmids"]);
	}

	/**
	 * Метод возвращает peer'ы, поставившие реакцию.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getReactedPeers(array $params = []): mixed
	{
		return $this->request("messages.getReactedPeers", $params);
	}

	/**
	 * Метод проверяет, можно ли писать пользователю от имени сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function isMessagesFromGroupAllowed(array $params = []): mixed
	{
		return $this->request("messages.isMessagesFromGroupAllowed", $params);
	}

	/**
	 * Метод помечает диалог как отвеченный или неотвеченный.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function markAsAnsweredConversation(array $params = []): mixed
	{
		return $this->request("messages.markAsAnsweredConversation", $params);
	}

	/**
	 * Метод помечает диалог как важный или обычный.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function markAsImportantConversation(array $params = []): mixed
	{
		return $this->request("messages.markAsImportantConversation", $params);
	}

	/**
	 * Метод помечает сообщения как прочитанные.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function markAsRead(array $params = []): mixed
	{
		return $this->request("messages.markAsRead", $params, ["message_ids"]);
	}

	/**
	 * Метод закрепляет сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function pin(array $params = []): mixed
	{
		return $this->request("messages.pin", $params);
	}

	/**
	 * Метод исключает участника из беседы.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function removeChatUser(array $params = []): mixed
	{
		return $this->request("messages.removeChatUser", $params);
	}

	/**
	 * Метод восстанавливает удалённое сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function restore(array $params = []): mixed
	{
		return $this->request("messages.restore", $params);
	}

	/**
	 * Метод ищет сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function search(array $params = []): mixed
	{
		return $this->request("messages.search", $params, ["fields"]);
	}

	/**
	 * Метод ищет диалоги.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function searchConversations(array $params = []): mixed
	{
		return $this->request("messages.searchConversations", $params, ["fields"]);
	}

	/**
	 * Метод отправляет сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function send(array $params = []): mixed
	{
		return $this->request("messages.send", $params, ["peer_ids", "user_ids"]);
	}

	/**
	 * Метод отправляет ответ на callback-событие клавиатуры.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function sendMessageEventAnswer(array $params = []): mixed
	{
		return $this->request("messages.sendMessageEventAnswer", $params);
	}

	/**
	 * Метод отправляет реакцию на сообщение.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function sendReaction(array $params = []): mixed
	{
		return $this->request("messages.sendReaction", $params);
	}

	/**
	 * Метод обновляет статус активности в диалоге.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function setActivity(array $params = []): mixed
	{
		return $this->request("messages.setActivity", $params);
	}

	/**
	 * Метод устанавливает фотографию беседы по уже загруженному `file`.
	 *
	 * @param array|string $params
	 * @return mixed
	 */
	public function setChatPhoto(array|string $params): mixed
	{
		# Метод оставлен гибким, чтобы можно было передавать либо готовый массив параметров, либо просто строковый `file`.
		if (is_string($params)) $params = ["file" => $params];

		return $this->request("messages.setChatPhoto", $params);
	}

	/**
	 * Метод снимает закрепление с сообщения.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function unpin(array $params = []): mixed
	{
		return $this->request("messages.unpin", $params);
	}

}
