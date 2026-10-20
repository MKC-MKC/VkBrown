<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Enums\UpdateEnum;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Update extends ResponseWrapper
{
	/**
	 * Получаем тип события сообщества для выбора обработчика.
	 *
	 * Тип одинаков для Callback API и Bots Long Poll, например MESSAGE_NEW или MESSAGE_EVENT.
	 * @return UpdateEnum Тип события в исходном поле type.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function getType(): UpdateEnum
	{
		return UpdateEnum::from($this->required("type", "string"));
	}

	/**
	 * Получаем идентификатор сообщества, в котором произошло событие.
	 *
	 * Поле присутствует также в запросе confirmation и используется для проверки адресата Callback.
	 * @return int Идентификатор сообщества без минуса.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function getGroupId(): int
	{
		return $this->required("group_id", "integer");
	}

	/**
	 * Получаем идентификатор доставки события из внешнего конверта.
	 *
	 * Повторно доставленное событие имеет тот же event_id. Это не event_id кнопки внутри object.
	 * @return string|null Идентификатор события; в confirmation может отсутствовать.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function getEventId(): ?string
	{
		return $this->read("event_id", "string");
	}

	/**
	 * Получаем версию API, для которой VK сформировал объект события.
	 *
	 * Версия проверяется при гидрации обновления; для confirmation поле может отсутствовать.
	 * @return string|null Значение v, например 5.199.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function getApiVersion(): ?string
	{
		return $this->read("v", "string");
	}

	/**
	 * Получаем секретную строку Callback API из входящего конверта.
	 *
	 * Строка проверяется Callback-сервисом. Bots Long Poll не использует этот механизм проверки.
	 * @return string|null Значение secret, если оно передано VK.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function getSecret(): ?string
	{
		return $this->read("secret", "string");
	}

	/**
	 * Получаем исходный объект, инициировавший событие, без удаления дополнительных полей.
	 *
	 * Структура зависит от type. Для обработки сообщения и нажатия кнопки используйте соответствующие геттеры.
	 * @return array<string, mixed> Поле object; у confirmation объект отсутствует.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function getObject(): array
	{
		return $this->read("object", "array") ?? [];
	}

	/**
	 * Получаем новое входящее сообщение из события message_new.
	 *
	 * Объект события 5.199 содержит message и client_info. Возвращаем message даже при id = 0.
	 * @return Message|null Сообщение либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_new
	 */
	public function getMessage(): ?Message
	{
		return $this->getType() === UpdateEnum::MESSAGE_NEW ? $this->object("object.message", Message::class) : null;
	}

	/**
	 * Получаем исходящее сообщение из события message_reply.
	 *
	 * В этом событии сообщение расположено непосредственно в object, без обёртки message.
	 * @return Message|null Сообщение либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_reply
	 */
	public function getMessageReply(): ?Message
	{
		return $this->getType() === UpdateEnum::MESSAGE_REPLY ? $this->object("object", Message::class) : null;
	}

	/**
	 * Получаем отредактированное сообщение из события message_edit.
	 *
	 * Используем conversation_message_id для операций с сообщениями сообщества в конкретном диалоге.
	 * @return Message|null Обновлённое сообщение либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_edit
	 */
	public function getEditedMessage(): ?Message
	{
		return $this->getType() === UpdateEnum::MESSAGE_EDIT ? $this->object("object", Message::class) : null;
	}

	/**
	 * Получаем сообщение текущего события без ручного переключения между тремя типами событий сообщений.
	 *
	 * Выбор определяется только type. Наличие id и его ненулевое значение не используются для определения типа.
	 * @return Message|null Входящее, исходящее или отредактированное сообщение.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	public function getActualMessage(): ?Message
	{
		return match ($this->getType()) {
			UpdateEnum::MESSAGE_NEW => $this->getMessage(),
			UpdateEnum::MESSAGE_REPLY => $this->getMessageReply(),
			UpdateEnum::MESSAGE_EDIT => $this->getEditedMessage(),
			default => null,
		};
	}

	/**
	 * Получаем сведения о возможностях клиента пользователя из события message_new.
	 *
	 * Поля keyboard, inline_keyboard, carousel и button_actions показывают доступные пользователю функции.
	 * @return ClientInfo|null Информация о клиенте либо null, если VK её не передал.
	 * @see https://dev.vk.ru/ru/api/bots/getting-started
	 */
	public function getClientInfo(): ?ClientInfo
	{
		return $this->getType() === UpdateEnum::MESSAGE_NEW ? $this->object("object.client_info", ClientInfo::class) : null;
	}

	/**
	 * Получаем данные нажатия callback-кнопки без отправки пользователем текстового сообщения.
	 *
	 * Вложенный event_id используется в messages.sendMessageEventAnswer и отличается от ID доставки обновления.
	 * @return MessageEvent|null Объект message_event либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getMessageEvent(): ?MessageEvent
	{
		return $this->getType() === UpdateEnum::MESSAGE_EVENT ? $this->object("object", MessageEvent::class) : null;
	}

	/**
	 * Получаем уведомление о наборе текста пользователем.
	 *
	 * Событие содержит from_id, to_id и state; оно не является объектом личного сообщения.
	 * @return MessageTypingState|null Состояние набора либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_typing_state
	 */
	public function getMessageTypingState(): ?MessageTypingState
	{
		return $this->getType() === UpdateEnum::MESSAGE_TYPING_STATE ? $this->object("object", MessageTypingState::class) : null;
	}

	/**
	 * Получаем новую запись на стене сообщества или репост.
	 *
	 * Для wall_post_new и wall_repost объект имеет структуру записи на стене VK.
	 * @return WallPost|null Запись либо null для другого типа события.
	 * @see https://dev.vk.ru/ru/reference/objects/post
	 */
	public function getWallPost(): ?WallPost
	{
		return in_array($this->getType(), [UpdateEnum::WALL_POST_NEW, UpdateEnum::WALL_REPOST], true)
			? $this->object("object", WallPost::class) : null;
	}

	/**
	 * Получаем новый, отредактированный или восстановленный комментарий на стене.
	 *
	 * Уведомление об удалении содержит другой набор полей и читается через getObject().
	 * @return WallComment|null Комментарий для wall_reply_new, wall_reply_edit или wall_reply_restore.
	 * @see https://dev.vk.ru/ru/reference/objects/comment
	 */
	public function getWallComment(): ?WallComment
	{
		return in_array($this->getType(), [UpdateEnum::WALL_REPLY_NEW, UpdateEnum::WALL_REPLY_EDIT, UpdateEnum::WALL_REPLY_RESTORE], true)
			? $this->object("object", WallComment::class) : null;
	}
}
