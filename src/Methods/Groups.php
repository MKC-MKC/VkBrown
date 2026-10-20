<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\Address;
use Haikiri\VkBrown\Objects\CallbackServers;
use Haikiri\VkBrown\Objects\CallbackSettings;
use Haikiri\VkBrown\Objects\GroupBans;
use Haikiri\VkBrown\Objects\GroupList;
use Haikiri\VkBrown\Objects\GroupMembers;
use Haikiri\VkBrown\Objects\GroupMembership;
use Haikiri\VkBrown\Objects\GroupOnlineStatus;
use Haikiri\VkBrown\Objects\GroupTag;
use Haikiri\VkBrown\Objects\GroupTokenPermissions;
use Haikiri\VkBrown\Objects\LongPollServer;
use Haikiri\VkBrown\Objects\LongPollSettings;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Groups
{

	/**
	 * Позволяет добавить адрес в сообщество. Список адресов может быть получен методом groups.getAddresses . Для
	 * того, чтобы воспользоваться этим методом, вы должны быть администратором сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $title Заголовок адреса. Обязательный параметр Макс. длина = 255
	 * @param string $address Строка адреса. Невский проспект, дом 28. Обязательный параметр Макс. длина = 255
	 * @param int|string $cityId Идентификатор города. Для получения можно использовать database.getCities .
	 * Обязательный параметр
	 * @param float $latitude Географическая широта отметки, заданная в градусах (от -90 до 90). Обязательный
	 * параметр
	 * @param float $longitude Географическая долгота отметки, заданная в градусах (от -180 до 180). Обязательный
	 * параметр
	 * @param int|string|null $groupId Идентификатор сообщества, в которое добавляется адрес. Обязательный параметр
	 * Если не указан, используется сообщество сервера.
	 * @param string|null $additionalAddress Дополнительное описание адреса. Второй этаж, налево. Макс. длина = 400
	 * @param int|string|null $metroId Идентификатор станции метро. Для получения можно использовать
	 * database.getMetroStations .
	 * @param string|null $phone Номер телефона.
	 * @param string|null $workInfoStatus Тип расписания. Возможные значения: • no_information - нет информации о
	 * расписании; • temporarily_closed - временно закрыто; • always_opened - открыто круглосуточно; •
	 * forever_closed - закрыто навсегда; • timetable - открыто в указанные часы работы. Для этого типа расписания
	 * необходимо передать параметр timetable .
	 * @param array|string|null $timetable Для типа timetable можно передать расписание в формате JSON. Время
	 * передается в минутах от 0 часов. Ключ по дню означает, что день рабочий. open_time , close_time - начало и
	 * конец рабочего дня. break_open_time , break_close_time - время перерыва. JSON { "mon" : { "open_time" : 1080
	 * , "close_time" : 1380 }, "tue" : { "open_time" : 1080 , "close_time" : 1380 }, "wed" : { "open_time" : 1080
	 * , "close_time" : 1320 }, "thu" : { "open_time" : 1080 , "close_time" : 1320 }, "fri" : { "open_time" : 1080
	 * , "close_time" : 1320 }, "sat" : { "open_time" : 1080 , "close_time" : 1320 , "break_open_time" : 1200 ,
	 * "break_close_time" : 1230 } }
	 * @param bool|null $isMainAddress Установить адрес основным. Информация об основном адресе сразу показывается
	 * в сообществе. Для получения информации об остальных адресах нужно перейти к списку адресов.
	 * @param int|string|null $countryId Идентификатор страны. Для получения можно использовать
	 * database.getCountries . Обязательный параметр
	 * @return Address Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.addAddress
	 */
	public function addGroupAddress(
		string            $title,
		string            $address,
		int|string        $cityId,
		float             $latitude,
		float             $longitude,
		int|string|null   $groupId = null,
		string|null       $additionalAddress = null,
		int|string|null   $metroId = null,
		string|null       $phone = null,
		string|null       $workInfoStatus = null,
		array|string|null $timetable = null,
		bool|null         $isMainAddress = null,
		int|string|null   $countryId = null,
	): Address
	{
		$params = [
			"title" => $title,
			"address" => $address,
			"city_id" => $cityId,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"group_id" => $groupId ?? $this->getGroupId(),
			"additional_address" => $additionalAddress,
			"metro_id" => $metroId,
			"phone" => $phone,
			"work_info_status" => $workInfoStatus,
			"timetable" => $timetable,
			"is_main_address" => $isMainAddress,
			"country_id" => $countryId,
		];

		$response = $this->sendRequest("groups.addAddress", $params);
		return ResponseHydrator::model($response, Address::class);
	}

	/**
	 * Добавляет сервер для Callback API в сообщество.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $url URL сервера. Обязательный параметр
	 * @param string $title Название сервера. Обязательный параметр Макс. длина = 14
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param string|null $secretKey Секретный ключ. Макс. длина = 50
	 * @return int Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.addCallbackServer
	 */
	public function addCallbackServer(
		string          $url,
		string          $title,
		int|string|null $groupId = null,
		string|null     $secretKey = null,
	): int
	{
		$params = [
			"url" => $url,
			"title" => $title,
			"group_id" => $groupId ?? $this->getGroupId(),
			"secret_key" => $secretKey,
		];

		$response = $this->sendRequest("groups.addCallbackServer", $params);
		return ResponseHydrator::integerField($response, "server_id");
	}

	/**
	 * Удаляет адрес сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $addressId ID адреса. Обязательный параметр
	 * @param int|string|null $groupId ID группы. Обязательный параметр Если не указан, используется сообщество
	 * сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.deleteAddress
	 */
	public function deleteGroupAddress(
		int|string      $addressId,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"address_id" => $addressId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.deleteAddress", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Удаляет сервер для Callback API из сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $serverId Идентификатор сервера, который нужно удалить. Обязательный параметр
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.deleteCallbackServer
	 */
	public function deleteCallbackServer(
		int|string      $serverId,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"server_id" => $serverId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.deleteCallbackServer", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Выключает статус «онлайн» в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.disableOnline
	 */
	public function disableGroupOnline(
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.disableOnline", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Метод редактирует адрес в сообществе. Чтобы получить список адресов, вызовите метод groups.getAddresses .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $addressId Обязательный параметр. Идентификатор адреса. Обязательный параметр
	 * @param int|string|null $groupId Обязательный параметр. Идентификатор сообщества, в которое добавляется
	 * адрес. Обязательный параметр Если не указан, используется сообщество сервера.
	 * @param string|null $title Необязательный параметр. Заголовок адреса. Макс. длина = 255
	 * @param string|null $address Необязательный параметр. Адрес. Пример: Город Санкт-Петербург, Невский проспект,
	 * дом 28. Макс. длина = 255
	 * @param string|null $additionalAddress Необязательный параметр. Дополнительное описание адреса. Пример:
	 * Второй этаж, налево. Макс. длина = 400
	 * @param int|string|null $cityId Необязательный параметр. Идентификатор города. Чтобы получить идентификатор,
	 * вызовите метод database.getCities .
	 * @param int|string|null $metroId Необязательный параметр. Идентификатор станции метро. Чтобы получить
	 * идентификатор, вызовите метод database.getMetroStations .
	 * @param float|null $latitude Необязательный параметр. Географическая широта отметки в градусах. Диапазон
	 * значений: от -90 до 90 .
	 * @param float|null $longitude Необязательный параметр. Географическая долгота отметки в градусах. Диапазон
	 * значений: от -180 до 180 .
	 * @param string|null $phone Необязательный параметр. Номер телефона, привязанный к адресу.
	 * @param string|null $workInfoStatus Необязательный параметр. Тип расписания. Возможные значения: •
	 * no_information - нет информации о расписании. • temporarily_closed - временно закрыто. • always_opened -
	 * открыто круглосуточно. • forever_closed - закрыто навсегда. • timetable - открыто в указанные часы работы.
	 * Для этого типа расписания необходимо передать параметр timetable .
	 * @param array|string|null $timetable Необязательный параметр. Расписание в формате JSON. Время передается в
	 * минутах от 0 часов. Возможные значения: • mon - понедельник. • tue - вторник. • wed - среда. • thu -
	 * четверг. • fri - пятница. • sat - суббота. • sun - воскресенье. Пометки времени: • open_time - начало
	 * рабочего дня. • close_time - конец рабочего дня. • break_open_time - начало перерыва. • break_close_time -
	 * конец перерыва. Пример значения параметра: JSON { "mon" : { "open_time" : 1080 , "close_time" : 1380 },
	 * "tue" : { "open_time" : 1080 , "close_time" : 1380 }, "wed" : { "open_time" : 1080 , "close_time" : 1320 },
	 * "thu" : { "open_time" : 1080 , "close_time" : 1320 }, "fri" : { "open_time" : 1080 , "close_time" : 1320 },
	 * "sat" : { "open_time" : 1080 , "close_time" : 1320 , "break_open_time" : 1200 , "break_close_time" : 1230 }
	 * }
	 * @param bool|null $isMainAddress Информация о том, является ли адрес основным. Возможные значения: • 1 -
	 * адрес является основным. • 0 - адрес не является основным. Примечание. Информация об основном адресе сразу
	 * показывается в сообществе. Чтобы получить информацию об остальных адресах, нужно перейти к списку адресов.
	 * @param int|string|null $countryId Необязательный параметр. Идентификатор страны. Чтобы получить
	 * идентификатор, вызовите метод database.getCountries .
	 * @return Address Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.editAddress
	 */
	public function editGroupAddress(
		int|string        $addressId,
		int|string|null   $groupId = null,
		string|null       $title = null,
		string|null       $address = null,
		string|null       $additionalAddress = null,
		int|string|null   $cityId = null,
		int|string|null   $metroId = null,
		float|null        $latitude = null,
		float|null        $longitude = null,
		string|null       $phone = null,
		string|null       $workInfoStatus = null,
		array|string|null $timetable = null,
		bool|null         $isMainAddress = null,
		int|string|null   $countryId = null,
	): Address
	{
		$params = [
			"address_id" => $addressId,
			"group_id" => $groupId ?? $this->getGroupId(),
			"title" => $title,
			"address" => $address,
			"additional_address" => $additionalAddress,
			"city_id" => $cityId,
			"metro_id" => $metroId,
			"latitude" => $latitude,
			"longitude" => $longitude,
			"phone" => $phone,
			"work_info_status" => $workInfoStatus,
			"timetable" => $timetable,
			"is_main_address" => $isMainAddress,
			"country_id" => $countryId,
		];

		$response = $this->sendRequest("groups.editAddress", $params);
		return ResponseHydrator::model($response, Address::class);
	}

	/**
	 * Редактирует данные сервера для Callback API в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $serverId Идентификатор сервера, данные которого нужно отредактировать. Обязательный
	 * параметр
	 * @param string $url Новый URL сервера. Обязательный параметр
	 * @param string $title Новое название сервера. Обязательный параметр Макс. длина = 14
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param string|null $secretKey Новый секретный ключ сервера. Макс. длина = 50
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.editCallbackServer
	 */
	public function editCallbackServer(
		int|string      $serverId,
		string          $url,
		string          $title,
		int|string|null $groupId = null,
		string|null     $secretKey = null,
	): bool
	{
		$params = [
			"server_id" => $serverId,
			"url" => $url,
			"title" => $title,
			"group_id" => $groupId ?? $this->getGroupId(),
			"secret_key" => $secretKey,
		];

		$response = $this->sendRequest("groups.editCallbackServer", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Включает статус «онлайн» в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.enableOnline
	 */
	public function enableGroupOnline(
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.enableOnline", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Возвращает список забаненных пользователей и сообществ в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param int|null $offset Смещение, необходимое для выборки определенного подмножества черного списка.
	 * @param int|null $count Количество пользователей, которое необходимо вернуть.
	 * @param array|string|null $fields Список дополнительных полей профилей и сообществ , которые необходимо
	 * вернуть.
	 * @param int|string|null $ownerId Идентификатор пользователя или сообщества из чёрного списка, информацию о
	 * котором нужно получить.
	 * @return GroupBans Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getBanned
	 */
	public function getGroupBanned(
		int|string|null   $groupId = null,
		int|null          $offset = null,
		int|null          $count = null,
		array|string|null $fields = null,
		int|string|null   $ownerId = null,
	): GroupBans
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"offset" => $offset,
			"count" => $count,
			"fields" => $fields,
			"owner_id" => $ownerId,
		];

		$response = $this->sendRequest("groups.getBanned", $params);
		return ResponseHydrator::model($response, GroupBans::class);
	}

	/**
	 * Возвращает информацию о заданном сообществе или о нескольких сообществах.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * В API 5.199 ответ содержит groups и profiles; объект GroupList сохраняет оба списка.
	 * @param array|string|null $groupIds Идентификаторы или короткие имена сообществ. Максимальное число
	 * идентификаторов - 500.
	 * @param int|string|null $groupId Идентификатор или короткое имя сообщества. Если не указан, используется
	 * сообщество сервера.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть. Например: •
	 * activity ; • ban_info ; • can_post ; • can_see_all_posts ; • city ; • contacts ; • counters ; • country ; •
	 * cover ; • description ; • finish_date ; • fixed_post ; • links ; • market ; • members_count ; • place ; •
	 * site ; • start_date ; • status ; • verified ; • wiki_page . Полный список полей доступен на этой странице .
	 * Обратите внимание, для получения некоторых полей требуется право доступа groups . Подробнее смотрите
	 * описание полей объекта group .
	 * @return GroupList Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getById
	 */
	public function getGroupsById(
		array|string|null $groupIds = null,
		int|string|null   $groupId = null,
		array|string|null $fields = null,
	): GroupList
	{
		$params = [
			"group_ids" => $groupIds,
			"group_id" => $groupId ?? ($groupIds === null ? $this->getGroupId() : null),
			"fields" => $fields,
		];

		$response = $this->sendRequest("groups.getById", $params);
		return ResponseHydrator::model($response, GroupList::class);
	}

	/**
	 * Позволяет получить строку, необходимую для подтверждения адреса сервера в Callback API .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Из ответа VK извлекается строка code. Для HTTP-подтверждения Callback используйте getCallbackResponse().
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return string Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackConfirmationCode
	 */
	public function getCallbackConfirmationCode(
		int|string|null $groupId = null,
	): string
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.getCallbackConfirmationCode", $params);
		return ResponseHydrator::stringField($response, "code");
	}

	/**
	 * Получает информацию о серверах для Callback API в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param array|string|null $serverIds Идентификаторы серверов, данные о которых нужно получить. По умолчанию
	 * возвращаются все серверы.
	 * @return CallbackServers Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackServers
	 */
	public function getCallbackServers(
		int|string|null   $groupId = null,
		array|string|null $serverIds = null,
	): CallbackServers
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"server_ids" => $serverIds,
		];

		$response = $this->sendRequest("groups.getCallbackServers", $params);
		return ResponseHydrator::model($response, CallbackServers::class);
	}

	/**
	 * Позволяет получить настройки уведомлений Callback API для сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param int|string|null $serverId Идентификатор сервера.
	 * @return CallbackSettings Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getCallbackSettings
	 */
	public function getCallbackSettings(
		int|string|null $groupId = null,
		int|string|null $serverId = null,
	): CallbackSettings
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"server_id" => $serverId,
		];

		$response = $this->sendRequest("groups.getCallbackSettings", $params);
		return ResponseHydrator::model($response, CallbackSettings::class);
	}

	/**
	 * Возвращает данные для подключения к Bots Longpoll API .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return LongPollServer Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollServer
	 */
	public function getGroupLongPollServer(
		int|string|null $groupId = null,
	): LongPollServer
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.getLongPollServer", $params);
		return ResponseHydrator::model($response, LongPollServer::class);
	}

	/**
	 * Получает настройки Bots Longpoll API для сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return LongPollSettings Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getLongPollSettings
	 */
	public function getGroupLongPollSettings(
		int|string|null $groupId = null,
	): LongPollSettings
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.getLongPollSettings", $params);
		return ResponseHydrator::model($response, LongPollSettings::class);
	}

	/**
	 * Возвращает список участников сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Без fields возвращаются ID участников; с fields - пользователи. Для filter=managers доступны также роли
	 * руководителей.
	 * @param int|string|null $groupId Идентификатор или короткое имя сообщества. Если не указан, используется
	 * сообщество сервера.
	 * @param string|null $sort Сортировка, с которой необходимо вернуть список участников. Может принимать
	 * значения: • id_asc - в порядке возрастания ID; • id_desc - в порядке убывания ID; • time_asc - в
	 * хронологическом порядке по вступлению в сообщество; • time_desc - в антихронологическом порядке по
	 * вступлению в сообщество. Сортировка по time_asc и time_desc возможна только при вызове от модератора
	 * сообщества.
	 * @param int|null $offset Смещение, необходимое для выборки определённого подмножества участников. По
	 * умолчанию 0 .
	 * @param int|null $count Количество участников сообщества, информацию о которых необходимо получить.
	 * @param array|string|null $fields Список дополнительных полей, которые необходимо вернуть. Доступные
	 * значения: • bdate ; • can_post ; • can_see_all_posts ; • can_see_audio ; • can_write_private_message ; •
	 * city ; • common_count ; • connections ; • contacts ; • country ; • domain ; • education ; • has_mobile ; •
	 * last_seen ; • lists ; • online ; • online_mobile ; • photo_100 ; • photo_200 ; • photo_200_orig ; •
	 * photo_400_orig ; • photo_50 ; • photo_max ; • photo_max_orig ; • relation ; • relatives ; • schools ; • sex
	 * ; • site ; • status ; • universities .
	 * @param string|null $filter • friends - будут возвращены только друзья в этом сообществе. • unsure - будут
	 * возвращены пользователи, которые выбрали «Возможно пойду» (если сообщество относится к мероприятиям). •
	 * managers - будут возвращены только руководители сообщества (доступно при запросе с передачей access_token от
	 * имени администратора сообщества). • donut - будут возвращены только доны (пользователи, у которых есть
	 * платная подписка VK Donut). • unsure_friends - будут возвращены друзья в этом сообществе, которые выбрали
	 * «Возможно пойду» (если сообщество относится к мероприятиям). • invites - будут возвращены пользователи,
	 * приглашенные в мероприятие.
	 * @return GroupMembers Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getMembers
	 */
	public function getGroupMembers(
		int|string|null   $groupId = null,
		string|null       $sort = null,
		int|null          $offset = null,
		int|null          $count = null,
		array|string|null $fields = null,
		string|null       $filter = null,
	): GroupMembers
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"sort" => $sort,
			"offset" => $offset,
			"count" => $count,
			"fields" => $fields,
			"filter" => $filter,
		];

		$response = $this->sendRequest("groups.getMembers", $params);
		$mode = match (true) {
			$filter === "managers" => "roles",
			!empty($fields) => "profiles",
			default => "ids",
		};
		return new GroupMembers(ResponseHydrator::array($response), $mode);
	}

	/**
	 * Получает информацию о статусе «онлайн» в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return GroupOnlineStatus Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getOnlineStatus
	 */
	public function getGroupOnlineStatus(
		int|string|null $groupId = null,
	): GroupOnlineStatus
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.getOnlineStatus", $params);
		return ResponseHydrator::model($response, GroupOnlineStatus::class);
	}

	/**
	 * Возвращает список тегов сообщества
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return list<GroupTag> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getTagList
	 */
	public function getGroupTagList(
		int|string|null $groupId = null,
	): array
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.getTagList", $params);
		return ResponseHydrator::models($response, GroupTag::class);
	}

	/**
	 * Возвращает настройки прав для ключа доступа сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @return GroupTokenPermissions Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.getTokenPermissions
	 */
	public function getGroupTokenPermissions(): GroupTokenPermissions
	{
		$params = [

		];

		$response = $this->sendRequest("groups.getTokenPermissions", $params);
		return ResponseHydrator::model($response, GroupTokenPermissions::class);
	}

	/**
	 * Возвращает информацию о том, является ли пользователь участником сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * Один user_id без extended возвращает bool; с extended - GroupMembership. При user_ids возвращается список
	 * GroupMembership.
	 * @param int|string|null $groupId Идентификатор или короткое имя сообщества. Обязательный параметр Если не
	 * указан, используется сообщество сервера.
	 * @param int|string|null $userId Идентификатор пользователя.
	 * @param array|string|null $userIds Идентификаторы пользователей, не более 500.
	 * @param bool|null $extended 1 - вернуть ответ в расширенной форме. По умолчанию - 0 .
	 * @return bool|GroupMembership|list<GroupMembership> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.isMember
	 */
	public function isGroupMember(
		int|string|null   $groupId = null,
		int|string|null   $userId = null,
		array|string|null $userIds = null,
		bool|null         $extended = null,
	): bool|GroupMembership|array
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"user_id" => $userId,
			"user_ids" => $userIds,
			"extended" => $extended,
		];

		$response = $this->sendRequest("groups.isMember", $params);
		return ResponseHydrator::membership($response, $userIds !== null, $extended === true);
	}

	/**
	 * Позволяет задать настройки уведомлений о событиях в Callback API .
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param int|string|null $serverId Идентификатор сервера.
	 * @param string|null $apiVersion Версия Callback API
	 * @param bool|null $messageNew Уведомления о новых сообщениях ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageReply Уведомления об исходящем сообщении ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageAllow Уведомления о подписке на сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageEdit Уведомления о редактировании сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageDeny Уведомления о запрете на сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageTypingState Уведомления о наборе текста сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageRead Уведомлять о прочтении сообщений: 1 - включить, 0 - выключить.
	 * @param bool|null $photoNew Уведомления о добавлении новой фотографии ( 0 - выключить, 1 - включить).
	 * @param bool|null $audioNew Уведомления о добавлении новой аудиозаписи ( 0 - выключить, 1 - включить).
	 * @param bool|null $videoNew Уведомления о добавлении новой видеозаписи ( 0 - выключить, 1 - включить).
	 * @param bool|null $wallReplyNew Уведомления о добавлении нового комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyEdit Уведомления о редактировании комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyDelete Уведомления об удалении комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyRestore Уведомления о восстановлении комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallPostNew Уведомления о новой записи на стене ( 0 - выключить, 1 - включить).
	 * @param bool|null $wallRepost Уведомления о репосте записи ( 0 - выключить, 1 - включить).
	 * @param bool|null $wallSchedulePostNew Уведомлять о новой отложенной записи: 1 - включить, 0 - выключить.
	 * @param bool|null $wallSchedulePostDelete Уведомлять об удалении отложенной записи: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $boardPostNew Уведомления о создании комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $boardPostEdit Уведомления о редактировании комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $boardPostRestore Уведомление о восстановлении комментария в обсуждении ( 0 - выключить, 1
	 * - включить).
	 * @param bool|null $boardPostDelete Уведомления об удалении комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentNew Уведомления о добавлении нового комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentEdit Уведомления о редактировании комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentDelete Уведомления об удалении комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentRestore Уведомления о восстановлении комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentNew Уведомления о добавлении нового комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentEdit Уведомления о редактировании комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentDelete Уведомления об удалении комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentRestore Уведомления о восстановлении комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentNew Уведомления о добавлении нового комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentEdit Уведомления о редактировании комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentDelete Уведомления об удалении комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentRestore Уведомления о восстановлении комментария к товару ( 0 - выключить, 1
	 * - включить).
	 * @param bool|null $marketOrderNew Уведомлять о новом заказе в магазине сообщества: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $marketOrderEdit Уведомлять об изменении заказа в магазине сообщества: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $pollVoteNew Уведомления о новом голосе в публичных опросах ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupJoin Уведомления о вступлении в сообщество ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupLeave Уведомления о выходе из сообщества ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupChangeSettings Уведомления об изменении настроек ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupChangePhoto Уведомления об изменении главной фотографии ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $groupOfficersEdit Уведомления об изменении руководства ( 0 - выключить, 1 - включить).
	 * @param bool|null $userBlock Уведомления об внесении пользователя в чёрный список ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $userUnblock Уведомления об исключении пользователя из чёрного списка ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $leadFormsNew Уведомления о заполнении формы.
	 * @param bool|null $likeAdd Уведомления о новой отметке «Мне нравится» ( 0 - выключить, 1 - включить).
	 * @param bool|null $likeRemove Уведомления о снятии отметки «Мне нравится» ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageEvent Уведомлять о нажатии callback-кнопок: 1 - включить, 0 - выключить.
	 * @param bool|null $messageReactionEvent Уведомлять об изменении реакции на сообщение: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $donutSubscriptionCreate Уведомление о создании подписки ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutSubscriptionProlonged Уведомление о продлении подписки ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $donutSubscriptionCancelled Уведомление об отмене подписки ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutSubscriptionPriceChanged Уведомление об изменении стоимости подписки ( 0 - выключить,
	 * 1 - включить).
	 * @param bool|null $donutSubscriptionExpired Уведомление о том, что подписка истекла ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $donutMoneyWithdraw Уведомление о выводе денег ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutMoneyWithdrawError Уведомление об ошибке при выводе денег ( 0 - выключить, 1 -
	 * включить).
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.setCallbackSettings
	 */
	public function setCallbackSettings(
		int|string|null $groupId = null,
		int|string|null $serverId = null,
		string|null     $apiVersion = null,
		bool|null       $messageNew = null,
		bool|null       $messageReply = null,
		bool|null       $messageAllow = null,
		bool|null       $messageEdit = null,
		bool|null       $messageDeny = null,
		bool|null       $messageTypingState = null,
		bool|null       $messageRead = null,
		bool|null       $photoNew = null,
		bool|null       $audioNew = null,
		bool|null       $videoNew = null,
		bool|null       $wallReplyNew = null,
		bool|null       $wallReplyEdit = null,
		bool|null       $wallReplyDelete = null,
		bool|null       $wallReplyRestore = null,
		bool|null       $wallPostNew = null,
		bool|null       $wallRepost = null,
		bool|null       $wallSchedulePostNew = null,
		bool|null       $wallSchedulePostDelete = null,
		bool|null       $boardPostNew = null,
		bool|null       $boardPostEdit = null,
		bool|null       $boardPostRestore = null,
		bool|null       $boardPostDelete = null,
		bool|null       $photoCommentNew = null,
		bool|null       $photoCommentEdit = null,
		bool|null       $photoCommentDelete = null,
		bool|null       $photoCommentRestore = null,
		bool|null       $videoCommentNew = null,
		bool|null       $videoCommentEdit = null,
		bool|null       $videoCommentDelete = null,
		bool|null       $videoCommentRestore = null,
		bool|null       $marketCommentNew = null,
		bool|null       $marketCommentEdit = null,
		bool|null       $marketCommentDelete = null,
		bool|null       $marketCommentRestore = null,
		bool|null       $marketOrderNew = null,
		bool|null       $marketOrderEdit = null,
		bool|null       $pollVoteNew = null,
		bool|null       $groupJoin = null,
		bool|null       $groupLeave = null,
		bool|null       $groupChangeSettings = null,
		bool|null       $groupChangePhoto = null,
		bool|null       $groupOfficersEdit = null,
		bool|null       $userBlock = null,
		bool|null       $userUnblock = null,
		bool|null       $leadFormsNew = null,
		bool|null       $likeAdd = null,
		bool|null       $likeRemove = null,
		bool|null       $messageEvent = null,
		bool|null       $messageReactionEvent = null,
		bool|null       $donutSubscriptionCreate = null,
		bool|null       $donutSubscriptionProlonged = null,
		bool|null       $donutSubscriptionCancelled = null,
		bool|null       $donutSubscriptionPriceChanged = null,
		bool|null       $donutSubscriptionExpired = null,
		bool|null       $donutMoneyWithdraw = null,
		bool|null       $donutMoneyWithdrawError = null,
	): bool
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"server_id" => $serverId,
			"api_version" => $apiVersion ?? $this->getVersion(),
			"message_new" => $messageNew,
			"message_reply" => $messageReply,
			"message_allow" => $messageAllow,
			"message_edit" => $messageEdit,
			"message_deny" => $messageDeny,
			"message_typing_state" => $messageTypingState,
			"message_read" => $messageRead,
			"photo_new" => $photoNew,
			"audio_new" => $audioNew,
			"video_new" => $videoNew,
			"wall_reply_new" => $wallReplyNew,
			"wall_reply_edit" => $wallReplyEdit,
			"wall_reply_delete" => $wallReplyDelete,
			"wall_reply_restore" => $wallReplyRestore,
			"wall_post_new" => $wallPostNew,
			"wall_repost" => $wallRepost,
			"wall_schedule_post_new" => $wallSchedulePostNew,
			"wall_schedule_post_delete" => $wallSchedulePostDelete,
			"board_post_new" => $boardPostNew,
			"board_post_edit" => $boardPostEdit,
			"board_post_restore" => $boardPostRestore,
			"board_post_delete" => $boardPostDelete,
			"photo_comment_new" => $photoCommentNew,
			"photo_comment_edit" => $photoCommentEdit,
			"photo_comment_delete" => $photoCommentDelete,
			"photo_comment_restore" => $photoCommentRestore,
			"video_comment_new" => $videoCommentNew,
			"video_comment_edit" => $videoCommentEdit,
			"video_comment_delete" => $videoCommentDelete,
			"video_comment_restore" => $videoCommentRestore,
			"market_comment_new" => $marketCommentNew,
			"market_comment_edit" => $marketCommentEdit,
			"market_comment_delete" => $marketCommentDelete,
			"market_comment_restore" => $marketCommentRestore,
			"market_order_new" => $marketOrderNew,
			"market_order_edit" => $marketOrderEdit,
			"poll_vote_new" => $pollVoteNew,
			"group_join" => $groupJoin,
			"group_leave" => $groupLeave,
			"group_change_settings" => $groupChangeSettings,
			"group_change_photo" => $groupChangePhoto,
			"group_officers_edit" => $groupOfficersEdit,
			"user_block" => $userBlock,
			"user_unblock" => $userUnblock,
			"lead_forms_new" => $leadFormsNew,
			"like_add" => $likeAdd,
			"like_remove" => $likeRemove,
			"message_event" => $messageEvent,
			"message_reaction_event" => $messageReactionEvent,
			"donut_subscription_create" => $donutSubscriptionCreate,
			"donut_subscription_prolonged" => $donutSubscriptionProlonged,
			"donut_subscription_cancelled" => $donutSubscriptionCancelled,
			"donut_subscription_price_changed" => $donutSubscriptionPriceChanged,
			"donut_subscription_expired" => $donutSubscriptionExpired,
			"donut_money_withdraw" => $donutMoneyWithdraw,
			"donut_money_withdraw_error" => $donutMoneyWithdrawError,
		];

		$response = $this->sendRequest("groups.setCallbackSettings", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Задаёт настройки для Bots Long Poll API в сообществе.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param bool|null $enabled 1 - включить Bots Long Poll, 0 - отключить.
	 * @param string|null $apiVersion Версия API.
	 * @param bool|null $messageNew Уведомления о новых сообщениях ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageReply Уведомления об исходящем сообщении ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageAllow Уведомления о подписке на сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageDeny Уведомления о запрете на сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageEdit Уведомления о редактировании сообщения ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageTypingState Уведомлять об изменении состояния набора сообщения: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $messageRead Уведомлять о прочтении сообщений: 1 - включить, 0 - выключить.
	 * @param bool|null $photoNew Уведомления о добавлении новой фотографии ( 0 - выключить, 1 - включить).
	 * @param bool|null $audioNew Уведомления о добавлении новой аудиозаписи ( 0 - выключить, 1 - включить).
	 * @param bool|null $videoNew Уведомления о добавлении новой видеозаписи ( 0 - выключить, 1 - включить).
	 * @param bool|null $wallReplyNew Уведомления о добавлении нового комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyEdit Уведомления о редактировании комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyDelete Уведомления об удалении комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallReplyRestore Уведомления о восстановлении комментария на стене ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $wallPostNew Уведомления о новой записи на стене ( 0 - выключить, 1 - включить).
	 * @param bool|null $wallRepost Уведомления о репосте записи ( 0 - выключить, 1 - включить).
	 * @param bool|null $boardPostNew Уведомления о создании комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $boardPostEdit Уведомления о редактировании комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $boardPostRestore Уведомление о восстановлении комментария в обсуждении ( 0 - выключить, 1
	 * - включить).
	 * @param bool|null $boardPostDelete Уведомления об удалении комментария в обсуждении ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentNew Уведомления о добавлении нового комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentEdit Уведомления о редактировании комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentDelete Уведомления об удалении комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $photoCommentRestore Уведомления о восстановлении комментария к фото ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentNew Уведомления о добавлении нового комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentEdit Уведомления о редактировании комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentDelete Уведомления об удалении комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $videoCommentRestore Уведомления о восстановлении комментария к видео ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentNew Уведомления о добавлении нового комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentEdit Уведомления о редактировании комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentDelete Уведомления об удалении комментария к товару ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $marketCommentRestore Уведомления о восстановлении комментария к товару ( 0 - выключить, 1
	 * - включить).
	 * @param bool|null $pollVoteNew Уведомления о новом голосе в публичных опросах ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupJoin Уведомления о вступлении в сообщество ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupLeave Уведомления о выходе из сообщества ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupChangeSettings Уведомления об изменении настроек ( 0 - выключить, 1 - включить).
	 * @param bool|null $groupChangePhoto Уведомления об изменении главной фотографии ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $groupOfficersEdit Уведомления об изменении руководства ( 0 - выключить, 1 - включить).
	 * @param bool|null $userBlock Уведомления об внесении пользователя в чёрный список ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $userUnblock Уведомления об исключении пользователя из чёрного списка ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $likeAdd Уведомления о новой отметке «Мне нравится» ( 0 - выключить, 1 - включить).
	 * @param bool|null $likeRemove Уведомления о снятии отметки «Мне нравится» ( 0 - выключить, 1 - включить).
	 * @param bool|null $messageEvent Уведомлять о нажатии callback-кнопок: 1 - включить, 0 - выключить.
	 * @param bool|null $messageReactionEvent Уведомлять об изменении реакции на сообщение: 1 - включить, 0 -
	 * выключить.
	 * @param bool|null $donutSubscriptionCreate Уведомление о создании подписки ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutSubscriptionProlonged Уведомление о продлении подписки ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $donutSubscriptionCancelled Уведомление об отмене подписки ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutSubscriptionPriceChanged Уведомление об изменении стоимости подписки ( 0 - выключить,
	 * 1 - включить).
	 * @param bool|null $donutSubscriptionExpired Уведомление о том, что подписка истекла ( 0 - выключить, 1 -
	 * включить).
	 * @param bool|null $donutMoneyWithdraw Уведомление о выводе денег ( 0 - выключить, 1 - включить).
	 * @param bool|null $donutMoneyWithdrawError Уведомление об ошибке при выводе денег ( 0 - выключить, 1 -
	 * включить).
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.setLongPollSettings
	 */
	public function setGroupLongPollSettings(
		int|string|null $groupId = null,
		bool|null       $enabled = null,
		string|null     $apiVersion = null,
		bool|null       $messageNew = null,
		bool|null       $messageReply = null,
		bool|null       $messageAllow = null,
		bool|null       $messageDeny = null,
		bool|null       $messageEdit = null,
		bool|null       $messageTypingState = null,
		bool|null       $messageRead = null,
		bool|null       $photoNew = null,
		bool|null       $audioNew = null,
		bool|null       $videoNew = null,
		bool|null       $wallReplyNew = null,
		bool|null       $wallReplyEdit = null,
		bool|null       $wallReplyDelete = null,
		bool|null       $wallReplyRestore = null,
		bool|null       $wallPostNew = null,
		bool|null       $wallRepost = null,
		bool|null       $boardPostNew = null,
		bool|null       $boardPostEdit = null,
		bool|null       $boardPostRestore = null,
		bool|null       $boardPostDelete = null,
		bool|null       $photoCommentNew = null,
		bool|null       $photoCommentEdit = null,
		bool|null       $photoCommentDelete = null,
		bool|null       $photoCommentRestore = null,
		bool|null       $videoCommentNew = null,
		bool|null       $videoCommentEdit = null,
		bool|null       $videoCommentDelete = null,
		bool|null       $videoCommentRestore = null,
		bool|null       $marketCommentNew = null,
		bool|null       $marketCommentEdit = null,
		bool|null       $marketCommentDelete = null,
		bool|null       $marketCommentRestore = null,
		bool|null       $pollVoteNew = null,
		bool|null       $groupJoin = null,
		bool|null       $groupLeave = null,
		bool|null       $groupChangeSettings = null,
		bool|null       $groupChangePhoto = null,
		bool|null       $groupOfficersEdit = null,
		bool|null       $userBlock = null,
		bool|null       $userUnblock = null,
		bool|null       $likeAdd = null,
		bool|null       $likeRemove = null,
		bool|null       $messageEvent = null,
		bool|null       $messageReactionEvent = null,
		bool|null       $donutSubscriptionCreate = null,
		bool|null       $donutSubscriptionProlonged = null,
		bool|null       $donutSubscriptionCancelled = null,
		bool|null       $donutSubscriptionPriceChanged = null,
		bool|null       $donutSubscriptionExpired = null,
		bool|null       $donutMoneyWithdraw = null,
		bool|null       $donutMoneyWithdrawError = null,
	): bool
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"enabled" => $enabled,
			"api_version" => $apiVersion ?? $this->getVersion(),
			"message_new" => $messageNew,
			"message_reply" => $messageReply,
			"message_allow" => $messageAllow,
			"message_deny" => $messageDeny,
			"message_edit" => $messageEdit,
			"message_typing_state" => $messageTypingState,
			"message_read" => $messageRead,
			"photo_new" => $photoNew,
			"audio_new" => $audioNew,
			"video_new" => $videoNew,
			"wall_reply_new" => $wallReplyNew,
			"wall_reply_edit" => $wallReplyEdit,
			"wall_reply_delete" => $wallReplyDelete,
			"wall_reply_restore" => $wallReplyRestore,
			"wall_post_new" => $wallPostNew,
			"wall_repost" => $wallRepost,
			"board_post_new" => $boardPostNew,
			"board_post_edit" => $boardPostEdit,
			"board_post_restore" => $boardPostRestore,
			"board_post_delete" => $boardPostDelete,
			"photo_comment_new" => $photoCommentNew,
			"photo_comment_edit" => $photoCommentEdit,
			"photo_comment_delete" => $photoCommentDelete,
			"photo_comment_restore" => $photoCommentRestore,
			"video_comment_new" => $videoCommentNew,
			"video_comment_edit" => $videoCommentEdit,
			"video_comment_delete" => $videoCommentDelete,
			"video_comment_restore" => $videoCommentRestore,
			"market_comment_new" => $marketCommentNew,
			"market_comment_edit" => $marketCommentEdit,
			"market_comment_delete" => $marketCommentDelete,
			"market_comment_restore" => $marketCommentRestore,
			"poll_vote_new" => $pollVoteNew,
			"group_join" => $groupJoin,
			"group_leave" => $groupLeave,
			"group_change_settings" => $groupChangeSettings,
			"group_change_photo" => $groupChangePhoto,
			"group_officers_edit" => $groupOfficersEdit,
			"user_block" => $userBlock,
			"user_unblock" => $userUnblock,
			"like_add" => $likeAdd,
			"like_remove" => $likeRemove,
			"message_event" => $messageEvent,
			"message_reaction_event" => $messageReactionEvent,
			"donut_subscription_create" => $donutSubscriptionCreate,
			"donut_subscription_prolonged" => $donutSubscriptionProlonged,
			"donut_subscription_cancelled" => $donutSubscriptionCancelled,
			"donut_subscription_price_changed" => $donutSubscriptionPriceChanged,
			"donut_subscription_expired" => $donutSubscriptionExpired,
			"donut_money_withdraw" => $donutMoneyWithdraw,
			"donut_money_withdraw_error" => $donutMoneyWithdrawError,
		];

		$response = $this->sendRequest("groups.setLongPollSettings", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Устанавливает настройки сообщества
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param bool|null $messages Сообщения сообщества. Возможные значения: • 0 - выключены; • 1 - включены.
	 * @param bool|null $botsCapabilities Возможности ботов (использование клавиатуры, добавление в беседу).
	 * Возможные значения: • 0 - выключены; • 1 - включены.
	 * @param bool|null $botsStartButton Кнопка «Начать» в диалоге с сообществом. Работает, в случае если
	 * bots_capabilities = 1 . Если эта настройка включена, то при заходе в беседу с Вашим сообществом в первый раз
	 * пользователь увидит кнопку с командой «Начать», которая отправляет команду start . Payload этого сообщения
	 * будет выглядеть так: {"command":"start"} Возможные значения: • 0 - выключена; • 1 - включена.
	 * @param bool|null $botsAddToChat Добавление бота в беседы. Работает, в случае если bots_capabilities = 1 .
	 * Возможные значения: • 0 - запрещено; • 1 - разрешено.
	 * @param bool|null $botOnlineBookingEnabled Включить возможность онлайн-записи через бота сообщества.
	 * @param int|null $docs Документы в формате owner_id_doc_id с необязательным access_key, списком или через
	 * запятую.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.setSettings
	 */
	public function setGroupSettings(
		int|string|null $groupId = null,
		bool|null       $messages = null,
		bool|null       $botsCapabilities = null,
		bool|null       $botsStartButton = null,
		bool|null       $botsAddToChat = null,
		bool|null       $botOnlineBookingEnabled = null,
		int|null        $docs = null,
	): bool
	{
		$params = [
			"group_id" => $groupId ?? $this->getGroupId(),
			"messages" => $messages,
			"bots_capabilities" => $botsCapabilities,
			"bots_start_button" => $botsStartButton,
			"bots_add_to_chat" => $botsAddToChat,
			"bot_online_booking_enabled" => $botOnlineBookingEnabled,
			"docs" => $docs,
		];

		$response = $this->sendRequest("groups.setSettings", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Позволяет создать или отредактировать заметку о пользователе в рамках переписки пользователя с сообществом
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $userId Идентификатор пользователя. Обязательный параметр
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param string|null $note Содержимое заметки, максимальная длина - 96 символов. Макс. длина = 96
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.setUserNote
	 */
	public function setGroupUserNote(
		int|string      $userId,
		int|string|null $groupId = null,
		string|null     $note = null,
	): bool
	{
		$params = [
			"user_id" => $userId,
			"group_id" => $groupId ?? $this->getGroupId(),
			"note" => $note,
		];

		$response = $this->sendRequest("groups.setUserNote", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Позволяет добавить новый тег в сообщество.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param string $tagName Имя тега. Обязательный параметр Макс. длина = 20
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @param string|null $tagColor Цвет тега. Разрешается использовать следующие цвета: 4bb34b , 5c9ce6 , e64646 ,
	 * 792ec0 , 63b9ba , ffa000 , ffc107 , 76787a , 9e8d6b , 45678f , 539b9c , 454647 , 7a6c4f , 6bc76b , 5181b8 ,
	 * ff5c5c , a162de , 7ececf , aaaeb3 , bbaa84 .
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.tagAdd
	 */
	public function addGroupTag(
		string          $tagName,
		int|string|null $groupId = null,
		string|null     $tagColor = null,
	): bool
	{
		$params = [
			"tag_name" => $tagName,
			"group_id" => $groupId ?? $this->getGroupId(),
			"tag_color" => $tagColor,
		];

		$response = $this->sendRequest("groups.tagAdd", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Позволяет «привязывать» и «отвязывать» теги сообщества к беседам.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $tagId Идентификатор тега. Обязательный параметр
	 * @param int|string $userId Обязательный параметр
	 * @param string $act Действие с тегом: • "bind" - привязать. • "unbind" - отвязать. Обязательный параметр
	 * @param int|string|null $groupId Идентификатор группы. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.tagBind
	 */
	public function bindGroupTag(
		int|string      $tagId,
		int|string      $userId,
		string          $act,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"tag_id" => $tagId,
			"user_id" => $userId,
			"act" => $act,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.tagBind", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Позволяет удалить тег сообщества.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $tagId Идентификатор удаляемого тега. Обязательный параметр
	 * @param int|string|null $groupId Идентификатор группы. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.tagDelete
	 */
	public function deleteGroupTag(
		int|string      $tagId,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"tag_id" => $tagId,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.tagDelete", $params);
		return ResponseHydrator::boolean($response);
	}

	/**
	 * Позволяет переименовать существующий тег.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * @param int|string $tagId Идентификатор тега. Обязательный параметр
	 * @param string $tagName Имя тега. Обязательный параметр Макс. длина = 20
	 * @param int|string|null $groupId Идентификатор сообщества. Обязательный параметр Если не указан, используется
	 * сообщество сервера.
	 * @return bool Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/groups.tagUpdate
	 */
	public function updateGroupTag(
		int|string      $tagId,
		string          $tagName,
		int|string|null $groupId = null,
	): bool
	{
		$params = [
			"tag_id" => $tagId,
			"tag_name" => $tagName,
			"group_id" => $groupId ?? $this->getGroupId(),
		];

		$response = $this->sendRequest("groups.tagUpdate", $params);
		return ResponseHydrator::boolean($response);
	}

}
