# groups.editAddress

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.editAddress)

Метод редактирует адрес в сообществе. Чтобы получить список адресов, вызовите метод [`groups.getAddresses`](https://dev.vk.ru/ru/method/groups.getAddresses).

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

**Обязательный параметр.** Идентификатор сообщества, в которое добавляется адрес.

Обязательный параметр

### address\_id

positive

**Обязательный параметр.** Идентификатор адреса.

Обязательный параметр

### title

string

**Необязательный параметр.** Заголовок адреса.

Макс. длина = 255

### address

string

**Необязательный параметр.** Адрес.

Пример:

 `Город Санкт-Петербург, Невский проспект, дом 28.`

Макс. длина = 255

### additional\_address

string

**Необязательный параметр.** Дополнительное описание адреса.

Пример:

 `Второй этаж, налево.`

Макс. длина = 400

### country\_id

positive

**Необязательный параметр.** Идентификатор страны. Чтобы получить идентификатор, вызовите метод [`database.getCountries`](https://dev.vk.ru/ru/method/database.getCountries).

### city\_id

positive

**Необязательный параметр.** Идентификатор города. Чтобы получить идентификатор, вызовите метод [`database.getCities`](https://dev.vk.ru/ru/method/database.getCities).

### metro\_id

positive

**Необязательный параметр.** Идентификатор станции метро. Чтобы получить идентификатор, вызовите метод [`database.getMetroStations`](https://dev.vk.ru/ru/method/database.getMetroStations).

### latitude

string

**Необязательный параметр.** Географическая широта отметки в градусах. Диапазон значений: от `-90` до `90`.

### longitude

string

**Необязательный параметр.** Географическая долгота отметки в градусах. Диапазон значений: от `-180` до `180`.

### phone

string

**Необязательный параметр.** Номер телефона, привязанный к адресу.

### work\_info\_status

string

**Необязательный параметр.** Тип расписания. Возможные значения:

- `no_information` — нет информации о расписании.
- `temporarily_closed` — временно закрыто.
- `always_opened` — открыто круглосуточно.
- `forever_closed` — закрыто навсегда.
- `timetable` — открыто в указанные часы работы. Для этого типа расписания необходимо передать параметр `timetable`.

### timetable

text

**Необязательный параметр.** Расписание в формате JSON. Время передается в минутах от 0 часов. Возможные значения:

- `mon` — понедельник.
- `tue` — вторник.
- `wed` — среда.
- `thu` — четверг.
- `fri` — пятница.
- `sat` — суббота.
- `sun` — воскресенье.

Пометки времени:

- `open_time` — начало рабочего дня.
- `close_time` — конец рабочего дня.
- `break_open_time` — начало перерыва.
- `break_close_time` — конец перерыва.

Пример значения параметра:

```json
{
  "mon": {
    "open_time": 1080,
    "close_time": 1380
  },
  "tue": {
    "open_time": 1080,
    "close_time": 1380
  },
  "wed": {
    "open_time": 1080,
    "close_time": 1320
  },
  "thu": {
    "open_time": 1080,
    "close_time": 1320
  },
  "fri": {
    "open_time": 1080,
    "close_time": 1320
  },
  "sat": {
    "open_time": 1080,
    "close_time": 1320,
    "break_open_time": 1200,
    "break_close_time": 1230
  }
}
```

### is\_main\_address

checkbox

Информация о том, является ли адрес основным. Возможные значения:

- `1` — адрес является основным.
- `0` — адрес не является основным.

**Примечание.** Информация об основном адресе сразу показывается в сообществе. Чтобы получить информацию об остальных адресах, нужно перейти к списку адресов.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `id` | `integer` | Идентификатор адреса. |
| `title` | `string` | Заголовок адреса. |
| `address` | `string` | Адрес. |
| `additional_address` | `string` | Дополнительное описание адреса. |
| `country_id` | `integer` | Идентификатор страны. |
| `city_id` | `integer` | Идентификатор города. |
| `metro_station_id` | `integer` | Идентификатор станции метро. |
| `latitude` | `integer` | Географическая широта отметки в градусах. |
| `longitude` | `integer` | Географическая долгота отметки в градусах. |
| `work_info_status` | `integer` | Тип расписания. Возможные значения: • `no_information` — нет информации о расписании. • `temporarily_closed` — временно закрыто. • `always_opened` — открыто круглосуточно. • `forever_closed` — закрыто навсегда. • `timetable` — открыто в указанные часы работы. |
| `time_offset` | `integer` | Смещение времени в минутах относительно времени по UTC+0. |

Пример ответа:

```json
{
  "response": {
    "id": 56704,
    "title": "Точка встречи parkrun",
    "address": "Сосновский лесопарк",
    "additional_address": "Парковая дорожка между футбольным полем и спортивной площадкой",
    "country_id": 1,
    "city_id": 2,
    "metro_station_id": 189,
    "latitude": 60.017941,
    "longitude": 30.365817,
    "work_info_status": "no_information",
    "time_offset": 180
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

104

Not found

260

Access to the groups list is denied due to the user's privacy settings

706

Too many addresses in club

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

address\_id \*

title

address

additional\_address

country\_id

city\_id

metro\_id

latitude

longitude

phone

work\_info\_status

timetable

is\_main\_address

bool0

v

5.199 (текущая)

{}
