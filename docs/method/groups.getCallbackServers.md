# groups.getCallbackServers

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getCallbackServers)

Получает информацию о серверах для [Callback API](../api/callback/getting-started.md) в сообществе.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

### server\_ids

integer

Идентификаторы серверов, данные о которых нужно получить. По умолчанию возвращаются все серверы.

## <a id="Результат"></a>Результат

Возвращает число серверов в поле `count` (`integer`) и массив объектов `items` с данными о серверах. Каждый объект массива `items` содержит поля:

- `id` (`integer`) — идентификатор сервера;
- `title` (`string`) — название сервера;
- `creator_id` (`integer`) — идентификатор пользователя, который добавил сервер (может содержать `0`);
- `url` (`string`) — URL сервера;
- `secret_key` (`string`) — секретный ключ;
- `status` (`string`) — статус сервера. Возможные значения:

  - `unconfigured` — адрес не задан;
  - `failed` — подтвердить адрес не удалось;
  - `wait` — адрес ожидает подтверждения;
  - `ok` — сервер подключен.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

server\_ids

v

5.199 (текущая)

{}
