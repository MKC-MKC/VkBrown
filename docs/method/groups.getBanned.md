# groups.getBanned

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getBanned)

Возвращает список забаненных пользователей и сообществ в сообществе.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

### offset

positive

Смещение, необходимое для выборки определенного подмножества черного списка.

### count

positive

Количество пользователей, которое необходимо вернуть.

### fields

string

Список дополнительных полей [профилей](../reference/objects/user.md) и [сообществ](../reference/objects/group.md), которые необходимо вернуть.

### owner\_id

integer

Идентификатор пользователя или сообщества из чёрного списка, информацию о котором нужно получить.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает общее число результатов в поле `count` (`integer`) и информацию о пользователях и сообществах из чёрного списка в поле `items` (`array`). Каждый объект в массиве `items` содержит поля:

- `type` (`string`) — тип. Возможные значения:

  - `group` — сообщество;
  - `profile` — пользователь.
- `group` (`object`) — информация о сообществе (для `type` = `group`). Объект [сообщества](../reference/objects/group.md).
- `profile` (`object`) — информация о пользователе (для `type` = `profile`). Объект [пользователя](../reference/objects/user.md).
- `ban_info` (`object`) — информация о блокировке в сообществе. Объект, который содержит поля:

Объект `ban_info` — информация о внесении в черный список сообщества.

`admin_id` `integer` Идентификатор администратора, который добавил пользователя или сообщество в черный список.

`date` `integer` Дата добавления в черный список в формате `unixtime`.

`reason` `integer` Причина добавления в черный список. Возможные значения:

- `0` — другое (по умолчанию);
- `1` — спам;
- `2` — оскорбление участников;
- `3` — нецензурные выражения;
- `4` — сообщения не по теме.

`comment` `string` Текст комментария.

`end_date` `integer` Дата окончания блокировки (`0` — блокировка вечная).

## <a id="Коды ошибок"></a>Коды ошибок

104

Not found

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Связанные методы"></a>Связанные методы

[groups.banUser](https://dev.vk.ru/ru/method/groups.banUser)[groups.unbanUser](https://dev.vk.ru/ru/method/groups.unbanUser)

Убирает пользователя из черного списка сообщества.

[groups.ban](https://dev.vk.ru/ru/method/groups.ban)

Добавляет пользователя или группу в черный список сообщества.

[groups.unban](https://dev.vk.ru/ru/method/groups.unban)

Убирает пользователя или группу из черного списка сообщества.

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

offset

count

fields

owner\_id

v

5.199 (текущая)

{}

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.71](https://dev.vk.ru/ru/reference/version/5.71)

- Метод [`groups.getBanned`](https://dev.vk.ru/ru/groups.getBanned) возвращает информацию о сообществах из чёрного списка.
