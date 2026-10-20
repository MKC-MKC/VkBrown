# photos.deleteAlbum

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.deleteAlbum)

Удаляет указанный альбом для фотографий у текущего пользователя

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### album\_id

positive

Идентификатор альбома.

Обязательный параметр

### group\_id

positive

Идентификатор сообщества, в котором размещен альбом.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

114

Invalid album id

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Связанные методы"></a>Связанные методы

[photos.createAlbum](photos.createAlbum.md)

Создает пустой альбом для фотографий.

[photos.editAlbum](photos.editAlbum.md)

Редактирует данные альбома для фотографий.

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

album\_id \*

group\_id

v

5.199 (текущая)

{}
