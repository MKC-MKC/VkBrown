<?php

namespace Haikiri\VkBrown\Objects;

use Generator;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Update extends ResponseWrapper
{

	public function getMessage(): object
	{
		$data = (array)$this->getData("message", []);
		return new Message($data);
	}

	public function getMessageReply(): object
	{
		$data = (array)$this->getData(default: []);
		return new Message($data);
	}

	/**
	 * Метод возвращает актуальный объект сообщения.
	 *
	 * @return User|null
	 */
	public function getActualMessage(): Message|null
	{
		foreach (
			(function (): Generator {
				yield $this->getMessage();
				yield $this->getMessageReply();
			})
			() as $message) {
			if ($message !== null && method_exists($message, "getId") && !empty($message->getId())) return $message;
		}

		return null;
	}

	public function getMessageEvent(): object
	{
		$data = (array)$this->getData("object", []);
		return new MessageEvent($data);
	}

}
