<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\ChatPhoto;
use Haikiri\VkBrown\Objects\ConversationByIdList;
use Haikiri\VkBrown\Objects\ConversationList;
use Haikiri\VkBrown\Objects\ConversationMembers;
use Haikiri\VkBrown\Objects\CreateChatResult;
use Haikiri\VkBrown\Objects\DeletedConversation;
use Haikiri\VkBrown\Objects\HistoryAttachments;
use Haikiri\VkBrown\Objects\ImportantMessages;
use Haikiri\VkBrown\Objects\InviteLink;
use Haikiri\VkBrown\Objects\Keyboard;
use Haikiri\VkBrown\Objects\Message;
use Haikiri\VkBrown\Objects\MessageList;
use Haikiri\VkBrown\Objects\MessagePermission;
use Haikiri\VkBrown\Objects\MessageReactions;
use Haikiri\VkBrown\Objects\MessageSendResult;
use Haikiri\VkBrown\Objects\ReactedPeers;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Messages
{

	/**
	 * Создаём чат с несколькими участниками.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string|null $userIds Идентификаторы пользователей списком либо через запятую.
	 * @param string|null $title Название создаваемого или изменяемого объекта.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return CreateChatResult Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.createChat
	 */
	public function createChat(
		array|string|null $userIds = null,
		string|null       $title = null,
		int|string|null   $groupId = null,
	): CreateChatResult
	{
		$params = [
			"user_ids" => $userIds,
			"title" => $title,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.createChat", $params);
		return ResponseHydrator::model($response, CreateChatResult::class);
	}

	/**
	 * Удаляет сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Сохраняем исходные статусы удаления VK. При cmids результат содержит peer_id, conversation_message_id и
	 * response для каждого сообщения.
	 * @param array|string|null $messageIds Список идентификаторов сообщений, разделённых через запятую.
	 * @param bool|null $spam Пометить сообщения как спам (доступен только с ключом доступа пользователя).
	 * @param int|null $reason Идентификатор причины блокировки
	 * @param int|string|null $groupId Идентификатор сообщества (для сообщений сообщества с ключом доступа
	 * пользователя). Если не указан, используется сообщество сервера.
	 * @param bool|null $deleteForAll 1 - если сообщение нужно удалить для получателей.
	 * @param int|string|null $peerId Идентификатор беседы, из которого необходимо удалить сообщения по cmids . Для
	 * пользователя: • id пользователя. Для групповой беседы: • 2000000000 + id беседы. Для сообщества: • -id
	 * сообщества.
	 * @param array|string|null $cmids Массив идентификаторов сообщений из беседы.
	 * @return array<int|string, mixed> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.delete
	 */
	public function deleteMessages(
		array|string|null $messageIds = null,
		bool|null         $spam = null,
		int|null          $reason = null,
		int|string|null   $groupId = null,
		bool|null         $deleteForAll = null,
		int|string|null   $peerId = null,
		array|string|null $cmids = null,
	): array
	{
		$params = [
			"message_ids" => $messageIds,
			"spam" => $spam,
			"reason" => $reason,
			"group_id" => $groupId ?? $this->getGroupId(),
			"delete_for_all" => $deleteForAll,
			"peer_id" => $peerId,
			"cmids" => $cmids,
		];

		$response = $this->sendRequest("messages.delete", $params);
		return ResponseHydrator::array($response);
	}

	/**
	 * Удаляем фотографию беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $chatId Идентификатор беседы без смещения 2000000000.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return ChatPhoto Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.deleteChatPhoto
	 */
	public function deleteChatPhoto(
		int|string      $chatId,
		int|string|null $groupId = null,
	): ChatPhoto
	{
		$params = [
			"chat_id" => $chatId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.deleteChatPhoto", $params);
		return ResponseHydrator::model($response, ChatPhoto::class);
	}

	/**
	 * Удаляем беседу.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $userId Идентификатор пользователя.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return DeletedConversation Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.deleteConversation
	 */
	public function deleteConversation(
		int|string|null $userId = null,
		int|string|null $peerId = null,
		int|string|null $groupId = null,
	): DeletedConversation
	{
		$params = [
			"user_id" => $userId,
			"peer_id" => $peerId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.deleteConversation", $params);
		return ResponseHydrator::model($response, DeletedConversation::class);
	}

	/**
	 * Удаляем ранее поставленную реакцию на сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является глобальным
	 * message_id.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.deleteReaction
	 */
	public function deleteMessageReaction(
		int|string $peerId,
		int|string $cmid,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"cmid" => $cmid,
		];

		$response = $this->sendRequest("messages.deleteReaction", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Редактирует сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Передайте message_id или cmid. Для callback-кнопки conversation_message_id события передаётся как cmid
	 * вместе с peer_id.
	 * @param int|string $peerId Идентификатор назначения. Для пользователя: • id пользователя. Для групповой
	 * беседы: • 2000000000 + id беседы. Для сообщества: • -id сообщества. Обязательный параметр
	 * @param string|null $message Текст сообщения. Обязательный параметр, если не задан параметр attachment . Макс.
	 * длина = 4096
	 * @param float|null $lat Географическая широта (от -90 до 90).
	 * @param float|null $long Географическая долгота (от -180 до 180).
	 * @param array|string|null $attachment Медиавложения к личному сообщению, перечисленные через запятую. Каждое
	 * прикрепление представлено в формате: <type><owner_id>_<media_id> <type> - тип медиавложения: • photo -
	 * фотография; • video - видеозапись; • audio - аудиозапись; • doc - документ; • wall - запись на стене; •
	 * market - товар. <owner_id> - идентификатор владельца медиавложения (обратите внимание, если объект находится
	 * в сообществе, этот параметр должен быть отрицательным). <media_id> - идентификатор медиавложения. Например:
	 * photo100172_166443618 Параметр является обязательным, если не задан параметр message . В случае, если
	 * прикрепляется объект, принадлежащий другому пользователю следует добавлять к вложению его access_key в
	 * формате <type><owner_id>_<media_id>_<access_key> , Например: video85635407_165186811_69dff3de4372ae9b6e
	 * @param bool|null $keepForwardMessages 1 , чтобы сохранить прикреплённые пересланные сообщения.
	 * @param bool|null $keepSnippets 1 , чтобы сохранить прикреплённые внешние ссылки (сниппеты).
	 * @param int|string|null $groupId Идентификатор сообщества (для сообщений сообщества с ключом доступа
	 * пользователя). Если не указан, используется сообщество сервера.
	 * @param bool|null $dontParseLinks 1 - не создавать сниппет ссылки из сообщения.
	 * @param bool|null $disableMentions 1 - отключить уведомление об упоминании в сообщении.
	 * @param int|string|null $messageId Идентификатор сообщения.
	 * @param int|string|null $cmid conversation_message_id сообщения.
	 * @param array|string|null $template Объект, описывающий шаблоны сообщений .
	 * @param Keyboard|array|string|null $keyboard Объект, описывающий клавиатуру бота .
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.edit
	 */
	public function editMessage(
		int|string                 $peerId,
		string|null                $message = null,
		float|null                 $lat = null,
		float|null                 $long = null,
		array|string|null          $attachment = null,
		bool|null                  $keepForwardMessages = null,
		bool|null                  $keepSnippets = null,
		int|string|null            $groupId = null,
		bool|null                  $dontParseLinks = null,
		bool|null                  $disableMentions = null,
		int|string|null            $messageId = null,
		int|string|null            $cmid = null,
		array|string|null          $template = null,
		Keyboard|array|string|null $keyboard = null,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"message" => $message,
			"lat" => $lat,
			"long" => $long,
			"attachment" => $attachment,
			"keep_forward_messages" => $keepForwardMessages,
			"keep_snippets" => $keepSnippets,
			"group_id" => $groupId ?? $this->getGroupId(),
			"dont_parse_links" => $dontParseLinks,
			"disable_mentions" => $disableMentions,
			"message_id" => $messageId,
			"cmid" => $cmid,
			"template" => $template,
			"keyboard" => $keyboard,
		];

		$response = $this->sendRequest("messages.edit", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Изменяем название беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $chatId Идентификатор беседы без смещения 2000000000.
	 * @param string|null $title Название создаваемого или изменяемого объекта.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.editChat
	 */
	public function editChat(
		int|string  $chatId,
		string|null $title = null,
	): bool
	{
		$params = [
			"chat_id" => $chatId,
			"title" => $title,
		];

		$response = $this->sendRequest("messages.editChat", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Получаем сообщения по их conversation_message_id.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param array|string $conversationMessageIds Идентификаторы сообщений внутри диалога,
	 * conversation_message_id.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return MessageList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getByConversationMessageId
	 */
	public function getMessagesByConversationMessageId(
		int|string        $peerId,
		array|string      $conversationMessageIds,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): MessageList
	{
		$params = [
			"peer_id" => $peerId,
			"conversation_message_ids" => $conversationMessageIds,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getByConversationMessageId", $params);
		return ResponseHydrator::model($response, MessageList::class);
	}

	/**
	 * Возвращает сообщения по их идентификаторам.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string|null $messageIds Идентификаторы сообщений. Максимум 100 идентификаторов.
	 * @param int|null $previewLength Количество символов, по которому нужно обрезать сообщение. Укажите 0 , если
	 * вы не хотите обрезать сообщение (по умолчанию сообщения не обрезаются).
	 * @param bool|null $extended 1 - возвращать дополнительные поля.
	 * @param array|string|null $fields Список дополнительных полей для пользователей и сообществ .
	 * @param int|string|null $groupId Идентификатор сообщества (для сообщений сообщества с ключом доступа
	 * пользователя). Если не указан, используется сообщество сервера.
	 * @param array|string|null $cmids Массив идентификаторов сообщений из беседы.
	 * @param int|string|null $peerId Идентификатор получателя сообщения: • Для пользователя -
	 * ИДЕНТИФИКАТОР_ПОЛЬЗОВАТЕЛЯ . • Для групповой беседы - 2000000000 + ИДЕНТИФИКАТОР_БЕСЕДЫ . • Для сообщества -
	 * -ИДЕНТИФИКАТОР_СООБЩЕСТВА .
	 * @return MessageList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getById
	 */
	public function getMessagesById(
		array|string|null $messageIds = null,
		int|null          $previewLength = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
		array|string|null $cmids = null,
		int|string|null   $peerId = null,
	): MessageList
	{
		$params = [
			"message_ids" => $messageIds,
			"preview_length" => $previewLength,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
			"cmids" => $cmids,
			"peer_id" => $peerId,
		];

		$response = $this->sendRequest("messages.getById", $params);
		return ResponseHydrator::model($response, MessageList::class);
	}

	/**
	 * Получаем список участников беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|null $offset Смещение относительно начала списка.
	 * @param int|null $count Количество результатов на странице.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @param array|string|null $memberIds Идентификаторы участников беседы, информацию о которых требуется
	 * вернуть.
	 * @return ConversationMembers Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationMembers
	 */
	public function getConversationMembers(
		int|string        $peerId,
		int|null          $offset = null,
		int|null          $count = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
		array|string|null $memberIds = null,
	): ConversationMembers
	{
		$params = [
			"peer_id" => $peerId,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
			"member_ids" => $memberIds,
		];

		$response = $this->sendRequest("messages.getConversationMembers", $params);
		return ResponseHydrator::model($response, ConversationMembers::class);
	}

	/**
	 * Возвращает список бесед пользователя.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|null $offset Смещение, необходимое для выборки определенного подмножества бесед.
	 * @param int|null $count Количество бесед, которое необходимо получить (но не более 200).
	 * @param string|null $filter Типы бесед, которые нужно вернуть, перечисленные через запятую. Может принимать
	 * следующие значения: • all - все беседы; • important - беседы, отмеченные важными (доступно только в
	 * сообщениях сообществ); • unanswered - беседы, отмеченные непрочтенными (доступно только в сообщениях
	 * сообществ); • unread - беседы, в которых есть непрочтенные сообщения. • archive - беседы, находящиеся в
	 * архиве. По умолчанию будут возвращены все беседы.
	 * @param bool|null $extended Если указать в качестве этого параметра 1, то будет возвращена информация о
	 * пользователях и сообществах.
	 * @param int|string|null $startMessageId Идентификатор сообщения, начиная с которого нужно вернуть историю
	 * переписки.
	 * @param array|string|null $fields Список дополнительных полей для пользователей и сообществ .
	 * @param int|string|null $groupId Идентификатор сообщества (доступно с токеном сообщества). Если не указан,
	 * используется сообщество сервера.
	 * @return ConversationList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getConversations
	 */
	public function getConversations(
		int|null          $offset = null,
		int|null          $count = null,
		string|null       $filter = null,
		bool|null         $extended = null,
		int|string|null   $startMessageId = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): ConversationList
	{
		$params = [
			"offset" => $offset,
			"count" => $count,
			"filter" => $filter,
			"extended" => $extended,
			"start_message_id" => $startMessageId,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getConversations", $params);
		return ResponseHydrator::model($response, ConversationList::class);
	}

	/**
	 * Получаем беседы по их идентификаторам.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string $peerIds Идентификаторы диалогов списком или через запятую; результат содержит отдельный
	 * статус каждого адресата.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return ConversationByIdList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getConversationsById
	 */
	public function getConversationsById(
		array|string      $peerIds,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): ConversationByIdList
	{
		$params = [
			"peer_ids" => $peerIds,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getConversationsById", $params);
		return ResponseHydrator::model($response, ConversationByIdList::class);
	}

	/**
	 * Возвращает историю сообщений для указанного диалога.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|null $offset Смещение, необходимое для выборки определённого подмножества сообщений, должен быть
	 * >= 0 , если не передан параметр start_message_id , и должен быть <= 0 , если передан.
	 * @param int|null $count Количество сообщений, которое необходимо получить (но не более 200).
	 * @param int|string|null $userId Идентификатор пользователя, историю переписки с которым необходимо вернуть.
	 * @param int|string|null $peerId Идентификатор назначения. Для пользователя: • id пользователя. Для групповой
	 * беседы: • 2000000000 + id беседы (недоступно для вызовов от имени сообщества). Для сообщества: • -id
	 * сообщества.
	 * @param int|string|null $startMessageId Если значение > 0 , то это идентификатор сообщения, начиная с
	 * которого нужно вернуть историю переписки, если передано значение -1 , то к значению параметра offset
	 * прибавляется количество входящих непрочитанных сообщений в конце диалога (подробности смотрите ниже).
	 * @param int|null $rev 1 - возвращать сообщения в хронологическом порядке. 0 - возвращать сообщения в обратном
	 * хронологическом порядке (по умолчанию).
	 * @param bool|null $extended Если указать в качестве этого параметра 1 , то будет возвращена информация о
	 * пользователях, являющихся авторами сообщений. По умолчанию 0 .
	 * @param array|string|null $fields Список дополнительных полей профилей, которые необходимо вернуть. Смотрите
	 * подробное описание .
	 * @param int|string|null $groupId Идентификатор сообщества (для сообщений сообщества с ключом доступа
	 * пользователя). Если не указан, используется сообщество сервера.
	 * @return MessageList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getHistory
	 */
	public function getMessageHistory(
		int|null          $offset = null,
		int|null          $count = null,
		int|string|null   $userId = null,
		int|string|null   $peerId = null,
		int|string|null   $startMessageId = null,
		int|null          $rev = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): MessageList
	{
		$params = [
			"offset" => $offset,
			"count" => $count,
			"user_id" => $userId,
			"peer_id" => $peerId,
			"start_message_id" => $startMessageId,
			"rev" => $rev,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getHistory", $params);
		return ResponseHydrator::model($response, MessageList::class);
	}

	/**
	 * Получаем материалы диалога или беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string|null $attachmentTypes Типы вложений, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является
	 * глобальным message_id.
	 * @param int|null $attachmentPosition Позиция вложения в сообщении, с которой начинается выборка.
	 * @param int|null $offset Смещение относительно начала списка.
	 * @param int|null $count Количество результатов на странице.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|null $maxForwardsLevel Максимальная глубина вложенности пересланных сообщений в выборке.
	 * @param bool|null $messageVideo Уведомлять о видеосообщениях: 1 - включить, 0 - выключить.
	 * @param string|null $mediaType Тип выбираемых материалов: photo, video, audio, doc, link и другие
	 * поддерживаемые VK типы.
	 * @param string|null $startFrom Указатель страницы из поля next_from предыдущего ответа.
	 * @param bool|null $preserveOrder Сохранять порядок результатов, соответствующий переданным идентификаторам.
	 * @param bool|null $photoSizes Возвращать фотографии с размерами в поле sizes.
	 * @return HistoryAttachments Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getHistoryAttachments
	 */
	public function getMessageHistoryAttachments(
		array|string|null $attachmentTypes = null,
		int|string|null   $groupId = null,
		int|string|null   $peerId = null,
		int|string|null   $cmid = null,
		int|null          $attachmentPosition = null,
		int|null          $offset = null,
		int|null          $count = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|null          $maxForwardsLevel = null,
		bool|null         $messageVideo = null,
		string|null       $mediaType = null,
		string|null       $startFrom = null,
		bool|null         $preserveOrder = null,
		bool|null         $photoSizes = null,
	): HistoryAttachments
	{
		$params = [
			"attachment_types" => $attachmentTypes,
			"group_id" => $groupId ?? $this->getGroupId(),
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"attachment_position" => $attachmentPosition,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended,
			"fields" => $fields,
			"max_forwards_level" => $maxForwardsLevel,
			"message_video" => $messageVideo,
			"media_type" => $mediaType,
			"start_from" => $startFrom,
			"preserve_order" => $preserveOrder,
			"photo_sizes" => $photoSizes,
		];

		$response = $this->sendRequest("messages.getHistoryAttachments", $params);
		return ResponseHydrator::model($response, HistoryAttachments::class);
	}

	/**
	 * Получаем список важных сообщений.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|null $count Количество результатов на странице.
	 * @param int|null $offset Смещение относительно начала списка.
	 * @param int|string|null $startMessageId Идентификатор сообщения, с которого начинается выборка.
	 * @param int|null $previewLength Число символов, до которого обрезается текст сообщения в ответе.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return ImportantMessages Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getImportantMessages
	 */
	public function getImportantMessages(
		int|null          $count = null,
		int|null          $offset = null,
		int|string|null   $startMessageId = null,
		int|null          $previewLength = null,
		array|string|null $fields = null,
		bool|null         $extended = null,
		int|string|null   $groupId = null,
	): ImportantMessages
	{
		$params = [
			"count" => $count,
			"offset" => $offset,
			"start_message_id" => $startMessageId,
			"preview_length" => $previewLength,
			"fields" => $fields,
			"extended" => $extended,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getImportantMessages", $params);
		return ResponseHydrator::model($response, ImportantMessages::class);
	}

	/**
	 * Получаем ссылку для приглашения в беседу.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param bool|null $reset Создать новую ссылку приглашения вместо действующей.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return InviteLink Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getInviteLink
	 */
	public function getInviteLink(
		int|string      $peerId,
		bool|null       $reset = null,
		int|string|null $groupId = null,
	): InviteLink
	{
		$params = [
			"peer_id" => $peerId,
			"reset" => $reset,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.getInviteLink", $params);
		return ResponseHydrator::model($response, InviteLink::class);
	}

	/**
	 * Получаем актуальные счётчики реакций на сообщения.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param array|string $cmids Список conversation_message_id сообщений в диалоге peer_id.
	 * @return MessageReactions Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getMessagesReactions
	 */
	public function getMessagesReactions(
		int|string   $peerId,
		array|string $cmids,
	): MessageReactions
	{
		$params = [
			"peer_id" => $peerId,
			"cmids" => $cmids,
		];

		$response = $this->sendRequest("messages.getMessagesReactions", $params);
		return ResponseHydrator::model($response, MessageReactions::class);
	}

	/**
	 * Получаем пользователей и сообщества, поставившие реакцию на сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является глобальным
	 * message_id.
	 * @param int|string|null $reactionId Идентификатор реакции VK.
	 * @return ReactedPeers Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.getReactedPeers
	 */
	public function getMessageReactedPeers(
		int|string      $peerId,
		int|string      $cmid,
		int|string|null $reactionId = null,
	): ReactedPeers
	{
		$params = [
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"reaction_id" => $reactionId,
		];

		$response = $this->sendRequest("messages.getReactedPeers", $params);
		return ResponseHydrator::model($response, ReactedPeers::class);
	}

	/**
	 * Проверяем, разрешена ли отправка сообщений от сообщества пользователю.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $userId Идентификатор пользователя.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return MessagePermission Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.isMessagesFromGroupAllowed
	 */
	public function isMessagesFromGroupAllowed(
		int|string      $userId,
		int|string|null $groupId = null,
	): MessagePermission
	{
		$params = [
			"user_id" => $userId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.isMessagesFromGroupAllowed", $params);
		return ResponseHydrator::model($response, MessagePermission::class);
	}

	/**
	 * Помечаем беседу как отвеченную либо снимаем отметку.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param bool|null $answered Отметить беседу как отвеченную: true устанавливает отметку, false снимает.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.markAsAnsweredConversation
	 */
	public function markAsAnsweredConversation(
		int|string      $peerId,
		bool|null       $answered = null,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"answered" => $answered,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.markAsAnsweredConversation", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Помечаем беседу как важную либо снимаем отметку.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param bool|null $important Отметить беседу как важную: true устанавливает отметку, false снимает.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.markAsImportantConversation
	 */
	public function markAsImportantConversation(
		int|string      $peerId,
		bool|null       $important = null,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"important" => $important,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.markAsImportantConversation", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Помечаем сообщения как прочитанные.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param array|string|null $messageIds Глобальные идентификаторы сообщений; не заменяют
	 * conversation_message_id.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $startMessageId Идентификатор сообщения, с которого начинается выборка.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @param bool|null $markConversationAsRead Одновременно отметить диалог как прочитанный.
	 * @param int|string|null $upToCmid Отметить прочитанными сообщения до указанного conversation_message_id
	 * включительно.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.markAsRead
	 */
	public function markAsRead(
		array|string|null $messageIds = null,
		int|string|null   $peerId = null,
		int|string|null   $startMessageId = null,
		int|string|null   $groupId = null,
		bool|null         $markConversationAsRead = null,
		int|string|null   $upToCmid = null,
	): bool
	{
		$params = [
			"message_ids" => $messageIds,
			"peer_id" => $peerId,
			"start_message_id" => $startMessageId,
			"group_id" => $groupId ?? $this->getGroupId(),
			"mark_conversation_as_read" => $markConversationAsRead,
			"up_to_cmid" => $upToCmid,
		];

		$response = $this->sendRequest("messages.markAsRead", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Закрепляем сообщение в беседе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $messageId Глобальный идентификатор сообщения. Для идентификатора внутри диалога
	 * используйте cmid.
	 * @param int|string|null $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является
	 * глобальным message_id.
	 * @return Message Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.pin
	 */
	public function pinMessage(
		int|string      $peerId,
		int|string|null $messageId = null,
		int|string|null $cmid = null,
	): Message
	{
		$params = [
			"peer_id" => $peerId,
			"message_id" => $messageId,
			"cmid" => $cmid,
		];

		$response = $this->sendRequest("messages.pin", $params);
		return ResponseHydrator::model($response, Message::class);
	}

	/**
	 * Исключаем участника из беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $chatId Идентификатор беседы без смещения 2000000000.
	 * @param int|string|null $userId Идентификатор пользователя.
	 * @param int|string|null $memberId Идентификатор участника беседы: пользователя или сообщества.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.removeChatUser
	 */
	public function removeChatUser(
		int|string      $chatId,
		int|string|null $userId = null,
		int|string|null $memberId = null,
	): bool
	{
		$params = [
			"chat_id" => $chatId,
			"user_id" => $userId,
			"member_id" => $memberId,
		];

		$response = $this->sendRequest("messages.removeChatUser", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Восстанавливаем удалённое сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $messageId Глобальный идентификатор сообщения. Для идентификатора внутри диалога
	 * используйте cmid.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @param int|string|null $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является
	 * глобальным message_id.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.restore
	 */
	public function restoreMessage(
		int|string|null $messageId = null,
		int|string|null $groupId = null,
		int|string|null $cmid = null,
		int|string|null $peerId = null,
	): bool
	{
		$params = [
			"message_id" => $messageId,
			"group_id" => $groupId ?? $this->getGroupId(),
			"cmid" => $cmid,
			"peer_id" => $peerId,
		];

		$response = $this->sendRequest("messages.restore", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Ищем сообщения по введённой строке.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string|null $q Строка поискового запроса.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|null $date Время в формате Unix timestamp для ограничения выборки сообщений.
	 * @param int|null $previewLength Число символов, до которого обрезается текст сообщения в ответе.
	 * @param int|null $offset Смещение относительно начала списка.
	 * @param int|null $count Количество результатов на странице.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return MessageList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.search
	 */
	public function searchMessages(
		string|null       $q = null,
		int|string|null   $peerId = null,
		int|null          $date = null,
		int|null          $previewLength = null,
		int|null          $offset = null,
		int|null          $count = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): MessageList
	{
		$params = [
			"q" => $q,
			"peer_id" => $peerId,
			"date" => $date,
			"preview_length" => $previewLength,
			"offset" => $offset,
			"count" => $count,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.search", $params);
		return ResponseHydrator::model($response, MessageList::class);
	}

	/**
	 * Ищем беседы.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string|null $q Строка поискового запроса.
	 * @param int|null $count Количество результатов на странице.
	 * @param bool|null $extended Возвращать дополнительные сведения об объектах.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return ConversationByIdList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.searchConversations
	 */
	public function searchConversations(
		string|null       $q = null,
		int|null          $count = null,
		bool|null         $extended = null,
		array|string|null $fields = null,
		int|string|null   $groupId = null,
	): ConversationByIdList
	{
		$params = [
			"q" => $q,
			"count" => $count,
			"extended" => $extended,
			"fields" => $fields,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.searchConversations", $params);
		return ResponseHydrator::model($response, ConversationByIdList::class);
	}

	/**
	 * Метод отправляет сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Для одного адресата возвращается message_id, для peer_ids/user_ids - список результатов с отдельными
	 * ошибками. random_id создаётся один раз, если не указан; автоматических повторов нет.
	 * @param int|string|null $peerId Необязательный параметр. Идентификатор получателя сообщения: • Для
	 * пользователя - ИДЕНТИФИКАТОР_ПОЛЬЗОВАТЕЛЯ . • Для групповой беседы - 2000000000 + ИДЕНТИФИКАТОР_БЕСЕДЫ . •
	 * Для сообщества - -ИДЕНТИФИКАТОР_СООБЩЕСТВА .
	 * @param string|null $text Необязательный параметр. Текст личного сообщения. Обязательный параметр , если не
	 * задан параметр attachment . Макс. длина = 9000
	 * @param int|string|null $userId Обязательный параметр. Идентификатор пользователя, которому отправляется
	 * сообщение. Вместо него можно использовать peer_id .
	 * @param int|null $randomId Обязательный параметр. Уникальный (в привязке к идентификатору приложения и
	 * идентификатору отправителя) идентификатор, предназначенный для предотвращения повторной отправки одного и
	 * того же сообщения. Сохраняется вместе с сообщением и доступен в истории сообщений. Возможные значения: • 0 -
	 * проверка на уникальность не нужна. • Любое другое число в пределах int32 - проверка на уникальность нужна.
	 * Переданный в запросе random_id используется для проверки уникальности сообщений в заданном диалоге за
	 * последний час (но не более 100 последних сообщений).
	 * @param array|string|null $peerIds Необязательный параметр. Идентификаторы получателей сообщения,
	 * перечисленные через запятую. Максимальное количество идентификаторов - 100. Примечание. Доступно только для
	 * ключа доступа сообщества.
	 * @param string|null $domain Необязательный параметр. Короткий адрес пользователя. Пример: persik_ryzhiy .
	 * @param int|string|null $chatId Необязательный параметр. Идентификатор беседы, в которую отправляется
	 * сообщение.
	 * @param float|null $lat Необязательный параметр. Географическая широта в градусах. Диапазон значений: от -90
	 * до 90 .
	 * @param float|null $long Необязательный параметр. Географическая долгота в градусах. Диапазон значений: от
	 * -180 до 180 .
	 * @param array|string|null $attachment Необязательный параметр. Объект или несколько объектов, приложенных к
	 * записи. Обязательный параметр , если не задан параметр message . К записи можно приложить медиа или ссылку
	 * на внешнюю страницу. Если объектов несколько, укажите их через запятую , . Формат описания медиавложения:
	 * {type}{owner_id}_{media_id} , где: • type - тип медиавложения: • photo - фотография. • video - видеозапись.
	 * • audio - аудиозапись. • doc - файл. • wall - запись на стене. • market - товар. • poll - опрос. • question
	 * - вопрос. • owner_id - идентификатор владельца медиавложения. Идентификатор сообщества должен начинаться со
	 * знака - . • media_id - идентификатор медиавложения. Если прикрепляется медиавложение, которое принадлежит
	 * другому пользователю, добавьте к формату описания медиавложения ключ доступа:
	 * {type}{owner_id}_{media_id}_{access_key} . Макс. длина = 9000
	 * @param int|null $replyTo Необязательный параметр. Идентификатор сообщения, на которое требуется ответить.
	 * @param array|string|null $forwardMessages Необязательный параметр. Идентификаторы пересылаемых сообщений,
	 * перечисленные через запятую. Пересылаемые сообщения отправителя будут отображаться в теле сообщения у
	 * получателя. Ограничения: • Не более 100 значений на верхнем уровне. • Максимальный уровень вложенности - 45.
	 * • Максимальное количество пересылаемых сообщений - 500.
	 * @param array|string|null $forward Необязательный параметр. JSON-объект со следующими полями: • owner_id -
	 * владелец сообщений. Укажите это поле, если вы хотите переслать сообщения из сообщества в личный диалог. •
	 * peer_id - идентификатор места, из которого необходимо переслать сообщения. • conversation_message_ids -
	 * массив conversation_message_id сообщений, которые необходимо переслать. В параметр можно передать сообщения,
	 * которые: • Находятся в личном диалоге с ботом. • Являются исходящими сообщениями бота. • Написаны после
	 * того, как бот вступил в беседу и появился доступ к сообщениям. • message_ids - массив идентификаторов
	 * сообщений. • is_reply - ответ на сообщения. Укажите это поле, если вы хотите ответить на сообщения в том
	 * чате, в котором находятся сообщения. При этом в conversation_message_ids или message_ids должен находиться
	 * только один элемент.
	 * @param int|string|null $stickerId Необязательный параметр. Идентификатор стикера.
	 * @param int|string|null $groupId Необязательный параметр. Идентификатор сообщества для сообщений сообщества с
	 * ключом доступа пользователя. Если не указан, используется сообщество сервера.
	 * @param Keyboard|array|string|null $keyboard Необязательный параметр. Объект, описывающий клавиатуру
	 * бота .
	 * @param array|string|null $template Необязательный параметр. Объект, описывающий шаблон сообщения .
	 * @param array|string|null $payload Необязательный параметр. Полезные данные.
	 * @param array|string|null $contentSource Необязательный параметр. Объект в формате JSON, описывающий источник
	 * пользовательского контента для чат-ботов .
	 * @param bool|null $dontParseLinks Необязательный параметр. Информация о том, создать ли сниппет ссылки из
	 * сообщения. Возможные значения: • 1 - не создавать сниппет ссылки из сообщения. • 0 - создать сниппет ссылки
	 * из сообщения.
	 * @param bool|null $disableMentions Необязательный параметр. Информация о том, отключить ли уведомление об
	 * упоминании в сообщении. Возможные значения: • 1 - отключить уведомление об упоминании в сообщении. • 0 - не
	 * отключать уведомление об упоминании в сообщении.
	 * @param string|null $intent Необязательный параметр. Строка, описывающая интенты.
	 * @param int|string|null $subscribeId Необязательный параметр. Число, которое будет использоваться для работы
	 * с интентами в будущем.
	 * @param array|string|null $userIds Необязательный параметр. Идентификаторы получателей сообщения,
	 * перечисленные через запятую. Максимальное количество идентификаторов - 100. Примечание. Доступно только для
	 * ключа доступа сообщества.
	 * @return int|list<MessageSendResult> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.send
	 */
	public function sendMessage(
		int|string|null            $peerId = null,
		string|null                $text = null,
		int|string|null            $userId = null,
		int|null                   $randomId = null,
		array|string|null          $peerIds = null,
		string|null                $domain = null,
		int|string|null            $chatId = null,
		float|null                 $lat = null,
		float|null                 $long = null,
		array|string|null          $attachment = null,
		int|null                   $replyTo = null,
		array|string|null          $forwardMessages = null,
		array|string|null          $forward = null,
		int|string|null            $stickerId = null,
		int|string|null            $groupId = null,
		Keyboard|array|string|null $keyboard = null,
		array|string|null          $template = null,
		array|string|null          $payload = null,
		array|string|null          $contentSource = null,
		bool|null                  $dontParseLinks = null,
		bool|null                  $disableMentions = null,
		string|null                $intent = null,
		int|string|null            $subscribeId = null,
		array|string|null          $userIds = null,
	): int|array
	{
		$params = [
			"peer_id" => $peerId,
			"message" => $text,
			"user_id" => $userId,
			"random_id" => $randomId,
			"peer_ids" => $peerIds,
			"domain" => $domain,
			"chat_id" => $chatId,
			"lat" => $lat,
			"long" => $long,
			"attachment" => $attachment,
			"reply_to" => $replyTo,
			"forward_messages" => $forwardMessages,
			"forward" => $forward,
			"sticker_id" => $stickerId,
			"group_id" => $groupId ?? $this->getGroupId(),
			"keyboard" => $keyboard,
			"template" => $template,
			"payload" => $payload,
			"content_source" => $contentSource,
			"dont_parse_links" => $dontParseLinks,
			"disable_mentions" => $disableMentions,
			"intent" => $intent,
			"subscribe_id" => $subscribeId,
			"user_ids" => $userIds,
		];

		return $this->messageService->send($params);
	}

	/**
	 * Отправляет событие с действием, которое произойдет при нажатии на callback-кнопку.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $eventId Случайная строка, которая возвращается в событии message_event . Обязательный
	 * параметр
	 * @param int|string $userId Идентификатор пользователя. Обязательный параметр
	 * @param int|string $peerId Идентификатор диалога со стороны сообщества. Обязательный параметр
	 * @param array|string|null $eventData Объект действия, которое должно произойти после нажатия на кнопку.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.sendMessageEventAnswer
	 */
	public function sendMessageEventAnswer(
		string            $eventId,
		int|string        $userId,
		int|string        $peerId,
		array|string|null $eventData = null,
	): bool
	{
		$params = [
			"event_id" => $eventId,
			"user_id" => $userId,
			"peer_id" => $peerId,
			"event_data" => $eventData,
		];

		$response = $this->sendRequest("messages.sendMessageEventAnswer", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Устанавливаем реакцию на сообщение.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string $cmid Идентификатор сообщения в диалоге, conversation_message_id. Не является глобальным
	 * message_id.
	 * @param int|string $reactionId Идентификатор реакции VK.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.sendReaction
	 */
	public function sendMessageReaction(
		int|string $peerId,
		int|string $cmid,
		int|string $reactionId,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"cmid" => $cmid,
			"reaction_id" => $reactionId,
		];

		$response = $this->sendRequest("messages.sendReaction", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Изменяем статус набора текста в диалоге.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $userId Идентификатор пользователя.
	 * @param string|null $type Тип объекта или действия согласно описанию метода VK.
	 * @param int|string|null $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.setActivity
	 */
	public function setActivity(
		int|string|null $userId = null,
		string|null     $type = null,
		int|string|null $peerId = null,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"user_id" => $userId,
			"type" => $type,
			"peer_id" => $peerId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.setActivity", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Сохраняем фотографию беседы после загрузки на сервер.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $file Служебное значение file из ответа сервера загрузки файлов.
	 * @return ChatPhoto Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.setChatPhoto
	 */
	public function setChatPhoto(
		string $file,
	): ChatPhoto
	{
		$params = [
			"file" => $file,
		];

		$response = $this->sendRequest("messages.setChatPhoto", $params);
		return ResponseHydrator::model($response, ChatPhoto::class);
	}

	/**
	 * Открепляем сообщение в беседе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $peerId Идентификатор диалога с пользователем, сообществом или беседой.
	 * @param int|string|null $groupId Идентификатор сообщества; null использует сообщество сервера. Если не
	 * указан, используется сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/messages.unpin
	 */
	public function unpinMessage(
		int|string      $peerId,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"peer_id" => $peerId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("messages.unpin", $params);
		return ResponseHydrator::boolean($response);
	}

}
