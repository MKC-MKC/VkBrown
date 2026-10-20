# photos.delete

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.delete)

Удаление фотографии на сайте.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### owner\_id

integer

Идентификатор пользователя или сообщества, которому принадлежит фотография.

> Обратите внимание, идентификатор сообщества в параметре `owner_id` необходимо указывать со знаком `«-»` — например, `owner_id`=`-1` соответствует идентификатору сообщества [ВКонтакте API](https://vk.ru/away.php?to=https%3A%2F%2Fvk.com%2Fapiclub) (club1).

### photo\_id

positive

Идентификатор фотографии.

### photos

string

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

owner\_id

photo\_id

photos

v

5.199 (текущая)

{}
