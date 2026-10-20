# users.get

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/users.get)

Метод позволяет получить информацию о пользователях.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F)

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

• [сервисный ключ доступа](../api/access-token/getting-started.md#%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%BD%D1%8B%D0%B9%20%D0%BA%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0)

## <a id="Параметры"></a>Параметры

### user\_ids

string

Перечисленные через запятую идентификаторы пользователей или их короткие имена (`screen_name`). По умолчанию — идентификатор текущего пользователя.

### fields

string

Список дополнительных полей профилей, которые необходимо вернуть. См. [подробное описание](../reference/objects/user.md).

Доступные значения:

- `activities`,
- `about`,
- `blacklisted`,
- `blacklisted_by_me`,
- `books`,
- `bdate`,
- `can_be_invited_group`,
- `can_post`,
- `can_see_all_posts`,
- `can_see_audio`,
- `can_send_friend_request`,
- `can_write_private_message`,
- `career`,
- `common_count`,
- `connections`,
- `contacts`,
- `city`,
- `crop_photo`,
- `domain`,
- `education`,
- `exports`,
- `followers_count`,
- `friend_status`,
- `has_photo`,
- `has_mobile`,
- `home_town`,
- `photo_100`,
- `photo_200`,
- `photo_200_orig`,
- `photo_400_orig`,
- `photo_50`,
- `sex`,
- `site`,
- `schools`,
- `screen_name`,
- `status`,
- `verified`,
- `games`,
- `interests`,
- `is_favorite`,
- `is_friend`,
- `is_hidden_from_feed`,
- `last_seen`,
- `maiden_name`,
- `military`,
- `movies`,
- `music`,
- `nickname`,
- `occupation`,
- `online`,
- `personal`,
- `photo_id`,
- `photo_max`,
- `photo_max_orig`,
- `quotes`,
- `relation`,
- `relatives`,
- `timezone`,
- `tv`,
- `universities`,
- `is_verified`.

### name\_case

string

Падеж для склонения имени и фамилии пользователя. Возможные значения:

- именительный – `nom`,
- родительный – `gen`,
- дательный – `dat`,
- винительный – `acc`,
- творительный – `ins`,
- предложный – `abl`.

По умолчанию `nom`.

### from\_group\_id

integer

Параметр устарел и больше не используется.

Поля `counters`, `military` будут возвращены только в случае, если передан ровно один `user_id`.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает массив объектов [пользователей](../reference/objects/user.md).

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

user\_ids

fields

name\_case

from\_group\_id

v

5.199 (текущая)

{}
