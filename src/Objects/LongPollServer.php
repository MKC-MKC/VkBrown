<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class LongPollServer extends ResponseWrapper
{

	/**
	 * Секретный ключ сессии Long Poll.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля key.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollServer
	 */
	public function getKey(): string
	{
		return $this->required("key", "string");
	}

	/**
	 * Адрес сервера Long Poll.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля server.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollServer
	 */
	public function getServer(): string
	{
		return $this->required("server", "string");
	}

	/**
	 * Номер последнего события; используется в следующем запросе.
	 *
	 * Поле обязательно для этого результата.
	 * @return string Значение поля ts.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollServer
	 */
	public function getTs(): string
	{
		return $this->required("ts", "string");
	}

}
