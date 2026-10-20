# groups.addCallbackServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.addCallbackServer)

Добавляет сервер для [Callback API](../api/callback/getting-started.md) в сообщество.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

### url

string

URL сервера.

Обязательный параметр

### title

string

Название сервера.

Обязательный параметр Макс. длина = 14

### secret\_key

string

Секретный ключ.

Макс. длина = 50

## <a id="Результат"></a>Результат

После успешного выполнения возвращает идентификатор добавленного сервера в поле `server_id` (`integer`).

## <a id="Коды ошибок"></a>Коды ошибок

2000

Servers number limit is reached

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

url \*

title \*

secret\_key

v

5.199 (текущая)

{}
