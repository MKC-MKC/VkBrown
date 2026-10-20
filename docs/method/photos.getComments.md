# photos.getComments

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getComments)

Возвращает список комментариев к фотографии.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### owner\_id

string

Идентификатор пользователя или сообщества, которому принадлежит фотография.

> Обратите внимание, идентификатор сообщества в параметре `owner_id` необходимо указывать со знаком `«-»` — например, `owner_id`=`-1` соответствует идентификатору сообщества [ВКонтакте API](https://vk.ru/away.php?to=https%3A%2F%2Fvk.com%2Fapiclub) (club1).

### photo\_id

integer

Идентификатор фотографии.

Обязательный параметр

### need\_likes

checkbox

`1` — будет возвращено дополнительное поле `likes`. По умолчанию: `0`.

### start\_comment\_id

positive

Идентификатор комментария, начиная с которого нужно вернуть список (подробности см. ниже).

### offset

integer

Смещение, необходимое для выборки определенного подмножества комментариев. По умолчанию: `0`.

### count

positive

Количество комментариев, которое необходимо получить.

### skip\_before\_id

positive

Идентификатор последнего полученного комментания, при подгрузке более новых комментариев. (этот и более старые комментарии получены не будут)

### skip\_after\_id

positive

Идентификатор последнего полученного комментания, при подгрузке более старых комментариев. (этот и более новые комментарии получены не будут)

### sort

string

Порядок сортировки комментариев. Возможные значения:

- `asc` — от старых к новым;
- `desc` — от новых к старым.

### access\_key

string

Ключ доступа к фотографии.

### extended

checkbox

`1` — в ответе будут возвращены дополнительные поля `profiles` и `groups`, содержащие информацию о пользователях и сообществах. По умолчанию: `0`.

### fields

string

Список дополнительных полей профилей, которые необходимо вернуть. См. [подробное описание](../reference/objects/user.md). Доступные значения:

- `about`,
- `activities`,
- `bdate`,
- `blacklisted`,
- `blacklisted_by_me`,
- `books`,
- `can_post`,
- `can_see_all_posts`,
- `can_see_audio`,
- `can_send_friend_request`,
- `can_write_private_message`,
- `career`,
- `city`,
- `common_count`,
- `connections`,
- `contacts`,
- `country`,
- `crop_photo`,
- `domain`,
- `education`,
- `exports`,
- `followers_count`,
- `friend_status`,
- `games`,
- `has_mobile`,
- `has_photo`,
- `home_town`,
- `interests`,
- `is_favorite`,
- `is_friend`,
- `is_hidden_from_feed`,
- `last_seen`,
- `lists`,
- `maiden_name`,
- `military`,
- `movies`,
- `music`,
- `nickname`,
- `occupation`,
- `online`,
- `personal`,
- `photo_100`,
- `photo_200`,
- `photo_200_orig`,
- `photo_400_orig`,
- `photo_50`,
- `photo_id`,
- `photo_max`,
- `photo_max_orig`,
- `quotes`,
- `relation`,
- `relatives`,
- `schools`,
- `screen_name`,
- `sex`,
- `site`,
- `status`,
- `timezone`,
- `tv`,
- `universities`,
- `verified`,
- `wall_comments`.

Если был передан параметр `start_comment_id`, будет найдена позиция комментария в списке (или ближайший к нему более ранний). Начиная с этой позиции будет возвращено `count` комментариев. Смещение `offset` в этом случае будет отсчитываться от этой позиции (оно может быть отрицательным).

## <a id="Результат"></a>Результат

После успешного выполнения возвращает объект, содержащий число результатов в поле `count` и массив объектов [комментариев](../reference/objects/comment.md) в поле `items`.

Если был задан параметр `extended`=`1`, возвращает число результатов в поле `count`, отдельно массив объектов [комментариев](../reference/objects/comment.md) в поле `items`, [пользователей](../reference/objects/user.md) в поле `profiles` и [сообществ](../reference/objects/group.md) в поле `groups`.

Если был задан параметр `need_like`=`1`, у объектов комментариев возвращается дополнительное поле `likes`:

- `count` — число пользователей, которым понравился комментарий;
- `user_likes` — наличие отметки `«Мне нравится»` от текущего пользователя (`1` — есть, `0` — нет)(`1` — есть, `0` — нет)\`;
- `can_like` — информация о том, может ли текущий пользователь поставить отметку «Мне нравится» (`1` — может, `0` — не может).

Если был передан параметр `start_comment_id`, будет также возвращено поле `real_offset` – итоговое смещение данного подмножества комментариев (оно может быть отрицательным, если был указан отрицательный `offset`).

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

owner\_id

photo\_id \*

need\_likes

bool0

start\_comment\_idРазрешён с версии 5.33

offset

count

skip\_before\_idЗапрещён с версии 5.33

skip\_after\_idЗапрещён с версии 5.33

sort

access\_key

extended

bool0

fields

v

5.199 (текущая)

{}

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.95](https://dev.vk.ru/ru/reference/version/5.95)

- В методах [`wall.getComments`](https://dev.vk.ru/ru/method/wall.getComments), [`market.getComments`](https://dev.vk.ru/ru/method/market.getComments), [`video.getComments`](https://dev.vk.ru/ru/method/video.getComments), [`board.getComments`](https://dev.vk.ru/ru/method/board.getComments) граффити вынесен в отдельный тип `attach`.
- Методы [`market.add`](https://dev.vk.ru/ru/method/market.add), [`market.edit`](https://dev.vk.ru/ru/method/market.edit) принимают параметр `url`. Объект `market` теперь может возвращать `url` и `button_title`.

[5.58](https://dev.vk.ru/ru/reference/version/5.58)

- В возвращаемых объектах, описывающих [сообщества](../reference/objects/group.md), появилось новое поле `is_messages_blocked`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события: `message_allow` и `message_deny`. Метод [`groups.setCallbackSettings`](groups.setCallbackSettings.md) принимает два новых параметра, а метод [`groups.getCallbackSettings`](groups.getCallbackSettings.md) возвращает два новых поля, соответственно.

[5.54](https://dev.vk.ru/ru/reference/version/5.54)

Если в параметрах вызова метода не была указана дата окончания, возвращаемые объекты, которые описывают [сообщество](../reference/objects/group.md), теперь не содержат поле `finish_data`. Ранее это поле присутствовало в ответе и содержало по умолчанию, равное `start_date` + 2 часа.

[5.53](https://dev.vk.ru/ru/reference/version/5.53)

В объектах, [описывающих сообщества](../reference/objects/group.md), следующие поля возвращаются только запросами с передачей `access_token`:

- `can_message`
- `ban_info`
- `can_post`
- `can_upload_doc`
- `can_upload_video`
- `can_see_all_posts`
- `can_create_topic`
- `is_favorite`
- `is_hidden_from_feed`

[5.33](https://dev.vk.ru/ru/reference/version/5.33)

В методы, возвращающие комментарии, добавлен параметр `start_comment_id`, который указывает начальный комментарий для возврата.

[4.95](https://dev.vk.ru/ru/reference/version/4.95)

- Изменён объект, [описывающий комментарии](../reference/objects/comment.md).
- Все методы возвращают информацию о комментариях в единообразной форме.
