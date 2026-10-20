# groups.addAddress

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.addAddress)

Позволяет добавить адрес в сообщество. Список адресов может быть получен методом [`groups.getAddresses`](https://dev.vk.ru/ru/method/groups.getAddresses).

> Для того, чтобы воспользоваться этим методом, вы должны быть администратором сообщества.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества, в которое добавляется адрес.

Обязательный параметр

### title

string

Заголовок адреса.

Обязательный параметр Макс. длина = 255

### address

string

Строка адреса.

`Невский проспект, дом 28.`

Обязательный параметр Макс. длина = 255

### additional\_address

string

Дополнительное описание адреса.

`Второй этаж, налево.`

Макс. длина = 400

### country\_id

positive

Идентификатор страны. Для получения можно использовать [`database.getCountries`](https://dev.vk.ru/ru/method/database.getCountries).

Обязательный параметр

### city\_id

positive

Идентификатор города. Для получения можно использовать [database.getCities](https://dev.vk.ru/ru/method/database.getCities).

Обязательный параметр

### metro\_id

positive

Идентификатор станции метро. Для получения можно использовать [`database.getMetroStations`](https://dev.vk.ru/ru/method/database.getMetroStations).

### latitude

string

Географическая широта отметки, заданная в градусах (от -90 до 90).

Обязательный параметр

### longitude

string

Географическая долгота отметки, заданная в градусах (от -180 до 180).

Обязательный параметр

### phone

string

Номер телефона.

### work\_info\_status

string

Тип расписания. Возможные значения:

- `no_information` — нет информации о расписании;
- `temporarily_closed` — временно закрыто;
- `always_opened` — открыто круглосуточно;
- `forever_closed` — закрыто навсегда;
- `timetable` — открыто в указанные часы работы. Для этого типа расписания необходимо передать параметр `timetable`.

### timetable

text

Для типа `timetable` можно передать расписание в формате JSON. Время передается в минутах от 0 часов. Ключ по дню означает, что день рабочий. `open_time`, `close_time` — начало и конец рабочего дня. `break_open_time`, `break_close_time` — время перерыва.

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

Установить адрес основным. Информация об основном адресе сразу показывается в сообществе. Для получения информации об остальных адресах нужно перейти к списку адресов.

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

title \*

address \*

additional\_address

country\_id \*

city\_id \*

metro\_id

latitude \*

longitude \*

phone

work\_info\_status

timetable

is\_main\_address

bool0

v

5.199 (текущая)

{}
