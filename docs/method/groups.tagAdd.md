# groups.tagAdd

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.tagAdd)

Позволяет добавить новый тег в сообщество.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

### tag\_name

string

Имя тега.

Обязательный параметр Макс. длина = 20

### tag\_color

string

Цвет тега. Разрешается использовать следующие цвета: `4bb34b`, `5c9ce6`, `e64646`, `792ec0`, `63b9ba`, `ffa000`, `ffc107`, `76787a`, `9e8d6b`, `45678f`, `539b9c`, `454647`, `7a6c4f`, `6bc76b`, `5181b8`, `ff5c5c`, `a162de`, `7ececf`, `aaaeb3`, `bbaa84`.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

tag\_name \*

tag\_color

v

5.199 (текущая)

{}
