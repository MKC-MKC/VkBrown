# messages.edit

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/messages.edit)

Редактирует сообщение.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): messages)

## <a id="Параметры"></a>Параметры

### peer\_id

integer

Идентификатор назначения.

Для пользователя:

- `id` пользователя.

Для групповой беседы:

- `2000000000` + `id` беседы.

Для сообщества:

- `-id` сообщества.

Обязательный параметр

### message

string

Текст сообщения. Обязательный параметр, если не задан параметр `attachment`.

Макс. длина = 4096

### lat

string

Географическая широта (от -90 до 90).

### long

string

Географическая долгота (от -180 до 180).

### attachment

string

Медиавложения к личному сообщению, перечисленные через запятую. Каждое прикрепление представлено в формате:

 `<type><owner_id>_<media_id>`

`<type>` — тип медиавложения:

- `photo` — фотография;
- `video` — видеозапись;
- `audio` — аудиозапись;
- `doc` — документ;
- `wall` — запись на стене;
- `market` — товар.

`<owner_id>` — идентификатор владельца медиавложения (обратите внимание, если объект находится в сообществе, этот параметр должен быть отрицательным). `<media_id>` — идентификатор медиавложения.

Например:

 `photo100172_166443618`

Параметр является обязательным, если не задан параметр `message`.

В случае, если прикрепляется объект, принадлежащий другому пользователю следует добавлять к вложению его [access\_key](../reference/objects.md) в формате `<type><owner_id>_<media_id>_<access_key>`, Например:

 `video85635407_165186811_69dff3de4372ae9b6e`

### keep\_forward\_messages

checkbox

`1`, чтобы сохранить прикреплённые пересланные сообщения.

### keep\_snippets

checkbox

`1`, чтобы сохранить прикреплённые внешние ссылки (сниппеты).

### group\_id

integer

Идентификатор сообщества (для сообщений сообщества с ключом доступа пользователя).

### dont\_parse\_links

checkbox

`1` — не создавать сниппет ссылки из сообщения.

### disable\_mentions

checkbox

`1` — отключить уведомление об упоминании в сообщении.

### message\_id

positive

Идентификатор сообщения.

### cmid

positive

conversation\_message\_id сообщения.

### template

text

Объект, описывающий [шаблоны сообщений](../api/bots/development/messages.md).

### keyboard

text

Объект, описывающий [клавиатуру бота](../api/bots/development/keyboard.md).

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

901

Can't send messages for users without permission

909

Can't edit this message, because it's too old

910

Can't sent this message, because it's too big

911

Keyboard format is invalid

912

This is a chat bot feature, change this status in settings

914

Message is too long

917

You don't have access to this chat

920

Can't edit this kind of message

940

Too many posts in messages

946

Chat not supported

949

Can't edit pinned message yet

1021

Can't send messages for users without conversation

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)
