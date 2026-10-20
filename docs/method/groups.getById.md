# groups.getById

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getById)

Возвращает информацию о заданном сообществе или о нескольких сообществах.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F)

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

• [сервисный ключ доступа](../api/access-token/getting-started.md#%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%BD%D1%8B%D0%B9%20%D0%BA%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_ids

string

Идентификаторы или короткие имена сообществ. Максимальное число идентификаторов — 500.

### group\_id

string

Идентификатор или короткое имя сообщества.

### fields

string

Список дополнительных полей, которые необходимо вернуть. Например:

- `activity`;
- `ban_info`;
- `can_post`;
- `can_see_all_posts`;
- `city`;
- `contacts`;
- `counters`;
- `country`;
- `cover`;
- `description`;
- `finish_date`;
- `fixed_post`;
- `links`;
- `market`;
- `members_count`;
- `place`;
- `site`;
- `start_date`;
- `status`;
- `verified`;
- `wiki_page`.

Полный список полей доступен [на этой странице](../reference/objects/group.md).

> Обратите внимание, для получения некоторых полей требуется право доступа `groups`. Подробнее смотрите [описание полей объекта `group`](../reference/objects/group.md).

## <a id="Результат"></a>Результат

После успешного выполнения возвращает массив [объектов](../reference/objects/group.md), описывающих сообщества.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_ids

group\_id

fields

v

5.199 (текущая)

{}

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.139](https://dev.vk.ru/ru/reference/version/5.139)

- В методе `groups.getById` изменён формат ответа. В `response` возвращаются:



  - Поле `groups` с информацией о необходимых сообществах.
  - Поле `profiles` c описанием пользователей, отметивших сообщество отметкой «Нравится».



  Также в объект группы добавлено поле `like`.
- Полностью поменялся формат метода `market.getCategories`. В `response` возвращается вложенное дерево категорий (вложенность бесконечная). Поля `offset` и `count` стали deprecated — дерево возвращается полностью.
- В методе `market.getById` изменился формат поля `category`: у поля был обязательное поле `section`, сейчас — поле parent (необязательное), указывающее на родителя. В `parent` может быть ещё `parent`, который указывает на его родителя. Вложенность бесконечная. Если родителя нет, то поле `parent` не возвращается.

[5.58](https://dev.vk.ru/ru/reference/version/5.58)

- В возвращаемых объектах, описывающих [сообщества](../reference/objects/group.md), появилось новое поле `is_messages_blocked`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события: `message_allow` и `message_deny`. Метод [`groups.setCallbackSettings`](groups.setCallbackSettings.md) принимает два новых параметра, а метод [`groups.getCallbackSettings`](groups.getCallbackSettings.md) возвращает два новых поля, соответственно.

[5.54](https://dev.vk.ru/ru/reference/version/5.54)

Если в параметрах вызова метода не была указана дата окончания, возвращаемые объекты, которые описывают [сообщество](../reference/objects/group.md), теперь не содержат поле `finish_data`. Ранее это поле присутствовало в ответе и содержало по умолчанию, равное `start_date` + 2 часа.

[5.19](https://dev.vk.ru/ru/reference/version/5.19)

- В объекте, описывающем [сообщество](../reference/objects/group.md), изменился тип полей `start_date` и `finish_date` со строкового на числовой.
- Методы, работающие с новостями, при установленном фильтре `friend` возвращают поле `user_id` вместо `uid`.
- В методе `fave.getLinks` изображения возвращаются в полях `photo_50` и `photo_100` вместо `image_src` и `image_middle`.
