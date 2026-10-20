<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\Traits\PayloadActionTrait;
use Haikiri\VkBrown\ResponseWrapper;

readonly class MessageEvent extends ResponseWrapper
{

	use PayloadActionTrait;

	/**
	 * Идентификатор события; для message_event используется при ответе на нажатие кнопки.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля event_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getEventId(): string
	{
		return $this->required("event_id", "string");
	}

	/**
	 * Идентификатор пользователя.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля user_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getUserId(): int
	{
		return $this->required("user_id", "integer");
	}

	/**
	 * Идентификатор назначения: пользователя, сообщества или беседы.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля peer_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getPeerId(): int
	{
		return $this->required("peer_id", "integer");
	}

	/**
	 * Уникальный автоматически увеличивающийся номер сообщения в этом диалоге.
	 *
	 * Поле обязательно для этого результата.
	 * @return int Значение поля conversation_message_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getConversationMessageId(): int
	{
		return $this->required("conversation_message_id", "integer");
	}

	/**
	 * Дополнительная информация, указанная в клавише. VK описывает тип как any; исходное значение
	 * сохраняется.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return mixed Значение поля payload.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema#message_event
	 */
	public function getPayload(): mixed
	{
		return $this->getData("payload");
	}

}
