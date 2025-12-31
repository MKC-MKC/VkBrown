<?php

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\ResponseWrapper;

readonly class MessageTypingState extends ResponseWrapper
{

	public function getToId(): ?int
	{
		return $this->getData("to_id");
	}

	public function getFromId(): ?int
	{
		return $this->getData("from_id");
	}

	public function getState(): ?string
	{
		return $this->getData("state");
	}

}
