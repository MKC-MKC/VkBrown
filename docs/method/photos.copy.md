# photos.copy

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.copy)

Позволяет скопировать фотографию в альбом "Сохраненные фотографии"

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user), и ключ доступа пользователя, полученный в [VK Mini Apps](https://dev.vk.ru/ru/mini-apps/getting-started) через событие [VKWebAppGetAuthToken](https://dev.vk.ru/ru/bridge/VKWebAppGetAuthToken) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### owner\_id

integer

Идентификатор владельца фотографии.

Обязательный параметр

### photo\_id

positive

Индентификатор фотографии.

Обязательный параметр

### access\_key

string

[Специальный код доступа](../reference/objects.md) для приватных фотографий.

## <a id="Результат"></a>Результат

Возвращает идентификатор созданной фотографии.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

owner\_id \*

photo\_id \*

access\_key

v

5.199 (текущая)

{}
