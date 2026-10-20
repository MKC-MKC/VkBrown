<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Objects;

use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\ResponseWrapper;

readonly class Address extends ResponseWrapper
{

	/**
	 * Идентификатор объекта VK.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getId(): int|null
	{
		return $this->read("id", "integer");
	}

	/**
	 * Идентификатор города.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля city_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getCityId(): int|null
	{
		return $this->read("city_id", "integer");
	}

	/**
	 * Название объекта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля title.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getTitle(): string|null
	{
		return $this->read("title", "string");
	}

	/**
	 * Адрес сообщества.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля address.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getAddress(): string|null
	{
		return $this->read("address", "string");
	}

	/**
	 * Дополнительное описание адреса, например номер офиса.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля additional_address.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getAdditionalAddress(): string|null
	{
		return $this->read("additional_address", "string");
	}

	/**
	 * Географическая широта.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|float|null Значение поля latitude.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getLatitude(): int|float|null
	{
		return $this->read("latitude", "number");
	}

	/**
	 * Географическая долгота.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|float|null Значение поля longitude.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getLongitude(): int|float|null
	{
		return $this->read("longitude", "number");
	}

	/**
	 * Расстояние до адреса в метрах, если переданы координаты.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля distance.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getDistance(): int|null
	{
		return $this->read("distance", "integer");
	}

	/**
	 * Контактный телефон адреса.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля phone.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getPhone(): string|null
	{
		return $this->read("phone", "string");
	}

	/**
	 * Смещение часового пояса адреса относительно UTC.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля time_offset.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getTimeOffset(): int|null
	{
		return $this->read("time_offset", "integer");
	}

	/**
	 * Идентификатор станции метро.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return int|null Значение поля metro_station_id.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getMetroStationId(): int|null
	{
		return $this->read("metro_station_id", "integer");
	}

	/**
	 * Режим работы адреса.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return string|null Значение поля work_info_status.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getWorkInfoStatus(): string|null
	{
		return $this->read("work_info_status", "string");
	}

	/**
	 * Расписание работы адреса по дням недели.
	 *
	 * Поле может отсутствовать: состав данных зависит от метода, параметров fields и прав доступа.
	 * @return array|null Значение поля timetable.
	 * @throws VkResponseException Поле имеет неверный тип.
	 * @see https://dev.vk.ru/ru/reference/objects/address
	 */
	public function getTimetable(): array|null
	{
		return $this->read("timetable", "array");
	}

}
