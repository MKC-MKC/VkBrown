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
			groupId: self::readNullableInt($response, "group_id"),
			count: self::readNullableInt($response, "count"),
			type: self::readString($response, "type"),
			eventId: self::readString($response, "event_id"),
			version: self::readString($response, "v"),
			object: self::readArray($response, "object"),
			items: self::readNullableArray($response, "items"),
			raw: $response,
		);
	}

	protected static function readString(array $response, string $key): string
	{
		$value = $response[$key] ?? null;
		if ($value === null) return "";

		return is_scalar($value) ? (string)$value : "";
	}

	protected static function readNullableInt(array $response, string $key): int|null
	{
		$value = $response[$key] ?? null;
		if ($value === null) return null;

		if (is_int($value)) return $value;
		if (is_string($value) && $value !== "" && preg_match('/^-?\d+$/', $value) === 1) return (int)$value;

		return null;
	}

	protected static function readArray(array $response, string $key, array $default = []): array
	{
		$value = $response[$key] ?? null;
		if ($value === null) return $default;

		return is_array($value) ? $value : $default;
	}

	protected static function readNullableArray(array $response, string $key): array|null
	{
		$value = $response[$key] ?? null;
		if ($value === null) return null;

		return is_array($value) ? $value : null;
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
