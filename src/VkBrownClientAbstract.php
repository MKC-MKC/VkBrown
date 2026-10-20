<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use Haikiri\VkBrown\Objects\Update;
use LogicException;

abstract class VkBrownClientAbstract
{
	/**
	 * Записываем полный входящий конверт или уже созданное обновление Long Poll.
	 *
	 * Поля type, group_id, event_id и v передаются вместе с object.
	 * @param array<string, mixed>|Update $update Полное событие VK, включая confirmation.
	 * @return static Клиент с установленным обновлением.
	 * @see https://dev.vk.ru/ru/api/community-events/json-schema
	 */
	abstract public function setUpdate(array|Update $update): static;

	/**
	 * Получаем текущее обновление с типизированными объектами события.
	 *
	 * Перед чтением необходимо вызвать setUpdate; отсутствующие данные не превращаются в пустое сообщение.
	 * @return Update Текущее событие сообщества.
	 * @throws LogicException Обновление ещё не установлено.
	 */
	abstract public function getUpdate(): Update;
}
