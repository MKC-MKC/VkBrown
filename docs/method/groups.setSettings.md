# groups.setSettings

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.setSettings)

Устанавливает настройки сообщества

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

integer

Идентификатор сообщества.

Обязательный параметр

### messages

checkbox

Сообщения сообщества. Возможные значения:

- `0` — выключены;
- `1` — включены.

### bots\_capabilities

checkbox

Возможности ботов (использование клавиатуры, добавление в беседу). Возможные значения:

- `0` — выключены;
- `1` — включены.

### bots\_start\_button

checkbox

Кнопка «Начать» в диалоге с сообществом. Работает, в случае если `bots_capabilities`=`1`. Если эта настройка включена, то при заходе в беседу с Вашим сообществом в первый раз пользователь увидит кнопку с командой «Начать», которая отправляет команду `start`. [Payload](../api/bots/development/keyboard.md) этого сообщения будет выглядеть так:

 `{"command":"start"}`

Возможные значения:

- `0` — выключена;
- `1` — включена.

### bots\_add\_to\_chat

checkbox

Добавление бота в беседы. Работает, в случае если `bots_capabilities`=`1`. Возможные значения:

- `0` — запрещено;
- `1` — разрешено.

### docs

positive

## <a id="Результат"></a>Результат

В случае успеха возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

messages

bool0

bots\_capabilities

bool0

bots\_start\_button

bool0

bots\_add\_to\_chat

bool0

docs

v

5.199 (текущая)

{}
