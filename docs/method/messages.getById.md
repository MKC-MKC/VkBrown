# messages.getById

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/messages.getById)

Возвращает сообщения по их идентификаторам.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): messages)

## <a id="Параметры"></a>Параметры

### message\_ids

string

Идентификаторы сообщений. Максимум 100 идентификаторов.

### preview\_length

positive

Количество символов, по которому нужно обрезать сообщение. Укажите `0`, если вы не хотите обрезать сообщение (по умолчанию сообщения не обрезаются).

### extended

checkbox

`1` — возвращать дополнительные поля.

### fields

string

Список дополнительных полей для [пользователей](../reference/objects/user.md) и [сообществ](../reference/objects/group.md).

### group\_id

integer

Идентификатор сообщества (для сообщений сообщества с ключом доступа пользователя).

### cmids

integer

Массив идентификаторов сообщений из беседы.

### peer\_id

integer

Идентификатор получателя сообщения:

- Для пользователя — `ИДЕНТИФИКАТОР_ПОЛЬЗОВАТЕЛЯ`.
- Для групповой беседы — `2000000000 + ИДЕНТИФИКАТОР_БЕСЕДЫ`.
- Для сообщества — `-ИДЕНТИФИКАТОР_СООБЩЕСТВА`.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает объект, содержащий число результатов в поле `count` и массив объектов, описывающих [сообщения](../reference/objects/message.md), в поле `items`.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.111](https://dev.vk.ru/ru/reference/version/5.111)

- В объекте сообщения появилось поле [`template`](../api/bots/development/messages.md).

[5.4](https://dev.vk.ru/ru/reference/version/5.4)

- В объекте [описывающем пользователя](../reference/objects/user.md), поля `photo` и `photo_medium_rec` переименованы в `photo_50` и `photo_100`.
- Во вложении `wall` в сообщениях поля `from` и `copy_owner` возвращают объект [пользователя](../reference/objects/user.md) или [сообщества](../reference/objects/group.md), вместо массива.
