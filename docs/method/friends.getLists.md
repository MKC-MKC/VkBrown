# friends.getLists

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/friends.getLists)

Возвращает список меток друзей пользователя.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): friends — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### user\_id

positive

Идентификатор пользователя.

### return\_system

checkbox

Возвращать ли системный список публичных меток друзей пользователя.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает список объектов, каждый из которых содержит следующие поля:

- `name` — название списка друзей;
- `id` — идентификатор списка друзей.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

user\_id

return\_system

bool0

v

5.199 (текущая)

{}

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.9](https://dev.vk.ru/ru/reference/version/5.9)

- В методе `newsfeed.getComments` поле `cid` было переименовано в `id`.
- Метод `notifications.get` возвращает объект `video` в новом формате.
- Метод `friends.getLists` возвращает список в виде объекта с полем `count`, а поле `list_id` в ответе заменено на `id`.
- Метод `board.getTopics` возвращает информацию об опросах в новом формате.
- В объектах, которые описывают альбомы и которые возвращаются методами `audio.getAlbums` и `video.getAlbums`, поле `album_id` было заменено на `id`.
- Методы `audio.getRecommendations`, `friends.getSuggestions`, `groups.getMembers` возвращают данные в форме списка.
- В объектах заметок, которые возвращает метод `places.getCheckins`, поле `user_id` было заменено на `uid`.
