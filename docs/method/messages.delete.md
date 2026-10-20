# messages.delete

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/messages.delete)

Удаляет сообщение.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): messages)

## <a id="Параметры"></a>Параметры

### message\_ids

integer

Список идентификаторов сообщений, разделённых через запятую.

### spam

checkbox

Пометить сообщения как спам (доступен только с ключом доступа пользователя).

### reason

integer

Идентификатор причины блокировки

### group\_id

integer

Идентификатор сообщества (для сообщений сообщества с ключом доступа пользователя).

### delete\_for\_all

checkbox

`1` — если сообщение нужно удалить для получателей.

### peer\_id

integer

Идентификатор беседы, из которого необходимо удалить сообщения по `cmids`.

Для пользователя:

- `id` пользователя.

Для групповой беседы:

- `2000000000` + `id` беседы.

Для сообщества:

- `-id` сообщества.

### cmids

integer

Массив идентификаторов сообщений из беседы.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1` для каждого удалённого сообщения.

## <a id="Коды ошибок"></a>Коды ошибок

924

Can't delete this message for everybody

927

Chat does not exist

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)
