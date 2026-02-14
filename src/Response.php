<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

readonly class Response
{

	private function __construct(
		private int|null   $groupId,
		private int|null   $count,
		private string     $type,
		private string     $eventId,
		private string     $version,
		private array      $object,
		private array|null $items,
		private array      $raw,
	)
	{
	}

	public static function fromResponse(array $response): self
	{
		return new self(
			groupId: (int)($response["group_id"] ?? -1),
			count: (int)($response["count"] ?? -1),
			type: (string)($response["type"] ?? ""),
			eventId: (string)($response["event_id"] ?? ""),
			version: (string)($response["v"] ?? ""),
			object: is_array($response["object"] ?? null) ? $response["object"] : [],
			items: is_array($response["items"] ?? null) ? $response["items"] : null,
			raw: $response,
		);
	}

	public function getGroupId(): int|null
	{
		return $this->groupId;
	}

	public function getCount(): int|null
	{
		return $this->count;
	}

	public function getEventId(): string
	{
		return $this->eventId;
	}

	public function getApiVersion(): string
	{
		return $this->version;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getObject(): array
	{
		return $this->object;
	}

	public function getItems(): array|null
	{
		return $this->items;
	}

	public function getRaw(): array
	{
		return $this->raw;
	}

}
