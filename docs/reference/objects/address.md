# Адрес

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/address)

Объект, описывающий адрес в сообществе. Доступен с версии 5.85.

## <a id="id"></a>`id`

`integer` Идентификатор адреса.

## <a id="city_id"></a>`city_id`

`integer` Идентификатор города.

## <a id="title"></a>`title`

`string` Заголовок адреса.

## <a id="address"></a>`address`

`string` Строка адреса.

## <a id="additional_address"></a>`additional_address`

`string` Описание адреса.

## <a id="latitude"></a>`latitude`

`number` Географическая широта отметки, заданная в градусах (от -90 до 90).

## <a id="longitude"></a>`longitude`

`number` Географическая долгота отметки, заданная в градусах (от -180 до 180).

## <a id="distance"></a>`distance`

`integer` Расстояние до цели в метрах.

## <a id="phone"></a>`phone`

`string` Номер телефона.

## <a id="time_offset"></a>`time_offset`

`integer` Смещение времени в минутах относительно UTC.

## <a id="metro_station_id"></a>`metro_station_id`

`integer` Идентификатор станции метрополитена.

## <a id="work_info_status"></a>`work_info_status`

`string` Тип расписания. Возможные значения:

- `no_information` — нет информации о расписании;
- `temporarily_closed` — временно закрыто;
- `always_opened` — открыто круглосуточно;
- `forever_closed` — закрыто навсегда;
- `timetable` — открыто в указанные часы работы. Для этого типа расписания необходимо передать параметр `timetable`.

## <a id="timetable"></a>`timetable`

`object` Для типа расписания `timetable` можно передать расписание в формате JSON. Время передается в минутах от 0 часов. Ключ по дню означает, что день рабочий. `open_time`, `close_time` — начало и конец рабочего дня. `break_open_time`, `break_close_time` - время перерыва.
