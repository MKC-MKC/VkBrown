# messages.getConversations

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/messages.getConversations)

Возвращает список бесед пользователя.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): messages)

## <a id="Параметры"></a>Параметры

### offset

positive

Смещение, необходимое для выборки определенного подмножества бесед.

### count

positive

Количество бесед, которое необходимо получить (но не более 200).

### filter

string

Типы бесед, которые нужно вернуть, перечисленные через запятую. Может принимать следующие значения:

- `all` — все беседы;
- `important` — беседы, отмеченные важными (доступно только в сообщениях сообществ);
- `unanswered` — беседы, отмеченные непрочтенными (доступно только в сообщениях сообществ);
- `unread` — беседы, в которых есть непрочтенные сообщения.
- `archive` — беседы, находящиеся в архиве.

По умолчанию будут возвращены все беседы.

### extended

checkbox

Если указать в качестве этого параметра 1, то будет возвращена информация о пользователях и сообществах.

### start\_message\_id

positive

Идентификатор сообщения, начиная с которого нужно вернуть историю переписки.

### fields

string

Список дополнительных полей для [пользователей](../reference/objects/user.md) и [сообществ](../reference/objects/group.md).

### group\_id

integer

Идентификатор сообщества (доступно с токеном сообщества).

## <a id="Результат"></a>Результат

Возвращает объект, который содержит следующие поля:

`count` `integer` Число результатов.

`items` `array` Беседы. Массив объектов, каждый из которых содержит поля:

- `conversation` (`object`) — объект [беседы](../reference/objects/conversation.md).
- `last_message` (`object`) — объект, описывающий [последнее сообщение в беседе](../reference/objects/message.md).

`unread_count` `integer` Число непрочитанных бесед.

`profiles` `array` Массив объектов [пользователей](../reference/objects/user.md).

`groups` `array` Массив объектов [сообществ](../reference/objects/group.md).

## <a id="Коды ошибок"></a>Коды ошибок

917

You don't have access to this chat

927

Chat does not exist

936

Contact not found

974

Folder not found

995

Messenger degradation

1017

Chat was deleted

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

offset

count

filter

extended

bool0

start\_message\_id

fields

group\_id

v

5.199 (текущая)

{}
