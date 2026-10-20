# groups.getLongPollServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getLongPollServer)

Возвращает данные для подключения к [Bots Longpoll API](../api/bots-long-poll/getting-started.md).

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

> **Обратите внимание.** При получении [ключа доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) в параметре `scope` укажите право доступа `manage`. Ключи доступа сообщества, не включающие этот `scope`, использовать для вызова метода не получится.

## <a id="Результат"></a>Результат

Возвращает объект, который содержит следующие поля:

- `key` (`string`) — ключ;
- `server` (`string`) — URL сервера;
- `ts` (`string`) — timestamp.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

v

5.199 (текущая)

{}
