# messages.allowMessagesFromGroup

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/messages.allowMessagesFromGroup)

Позволяет разрешить отправку сообщений от сообщества текущему пользователю.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

### key

string

Произвольная строка. Этот параметр можно использовать для идентификации пользователя. Его значение будет возвращено в событии `message_allow` [Callback API](../api/callback/getting-started.md).

Макс. длина = 256

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

943

Cannot use this intent

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

key

v

5.199 (текущая)

{}
