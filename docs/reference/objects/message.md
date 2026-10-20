# Личное сообщение

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/message)

## <a id="Для версии API с 5.80."></a>Для версии API с 5.80.

Объект, описывающий личное сообщение, содержит следующие поля:

### <a id="id "></a>`id`

`integer` Идентификатор сообщения.

### <a id="date "></a>`date`

`integer` Время отправки в Unixtime.

### <a id="peer_id"></a>`peer_id`

`integer` Идентификатор назначения.

### <a id="from_id "></a>`from_id`

`integer` Идентификатор отправителя.

### <a id="message"></a>`message`

`string` Текст сообщения.

### <a id="format_data"></a>`format_data`

`object` Информация о форматировании текста сообщения. Объект, который содержит поля:

- `version` (`string`) – версия форматирования.
- `items` (`array`) — массив объектов с параметрами форматирования:

  - `offset` (`integer`) — позиция символа, начиная с которого применяется указанный тип форматирования.
  - `length` (`integer`) — количество символов, на которые распространяется указанный тип форматирования.
  - `type` (`string`) – тип форматирования, примененный к диапазону символов. Возможные значения:

    - `bold` — полужирный.
    - `italic` – курсив.
    - `url` — ссылка.
    - `underline` — подчеркнутый.
  - `url` (`string`) — адрес ссылки, если в `type` указан тип `url`.

> За единицу диапазона принимается символ в кодировке UTF-16. Обратите внимание: некоторые объекты, например эмодзи, могут занимать несколько символов в UTF-16.

### <a id="random_id "></a>`random_id`

`integer` Идентификатор, используемый при отправке сообщения. Возвращается только для исходящих сообщений.

### <a id="ref "></a>`ref`

`string` Произвольный параметр для работы с [источниками переходов](../../api/community-messages/getting-started.md).

### <a id="ref_source "></a>`ref_source`

`string` Произвольный параметр для работы с [источниками переходов](../../api/community-messages/getting-started.md).

### <a id="attachments "></a>`attachments`

`array` Медиавложения сообщения (фотографии, ссылки и т.п.). Описание массива `attachments` находится [на отдельной странице](attachments-message.md).

### <a id="important "></a>`important`

`boolean` `true`, если сообщение помечено как важное.

### <a id="geo "></a>`geo`

`object` Информация о [местоположении](https://dev.vk.ru/ru/reference/objects/geo).

### <a id="payload"></a>`payload`

`string` Сервисное поле для сообщений ботам (полезная нагрузка).

### <a id="keyboard"></a>`keyboard`

`object` [Объект клавиатуры](../../api/bots/development/keyboard.md#%D0%9E%D0%B1%D1%8A%D0%B5%D0%BA%D1%82%20%D0%BA%D0%BB%D0%B0%D0%B2%D0%B8%D0%B0%D1%82%D1%83%D1%80%D1%8B) для ботов.

### <a id="fwd_messages "></a>`fwd_messages`

`array` Массив пересланных сообщений (если есть). Максимальное количество элементов — `100`. Максимальная глубина вложенности для пересланных сообщений — `45`, общее максимальное количество в цепочке с учетом вложенности — `500`.

### <a id="reply_message"></a>`reply_message`

`object` Сообщение, в ответ на которое отправлено текущее.

### <a id="action "></a>`action`

`object` Информация о сервисном действии с чатом. Объект, который содержит поля:

- `type` (`string`) — тип действия. Возможные значения:

  - `chat_photo_update` — обновлена фотография беседы;
  - `chat_photo_remove` — удалена фотография беседы;
  - `chat_create` — создана беседа;
  - `chat_title_update` — обновлено название беседы;
  - `chat_invite_user` — приглашен пользователь;
  - `chat_kick_user` — исключен пользователь;
  - `chat_pin_message` — закреплено сообщение;
  - `chat_unpin_message` — откреплено сообщение;
  - `chat_invite_user_by_link` — пользователь присоединился к беседе по ссылке.
- `member_id` (`integer`) — идентификатор пользователя (если \> 0) или email (если \< 0), которого пригласили или исключили (для служебных сообщений с `type` = `chat_invite_user` или `chat_kick_user`). Идентификатор пользователя, который закрепил/открепил сообщение для `action` = `chat_pin_message` или `chat_unpin_message`.
- `text` (`string`) — название беседы (для служебных сообщений с `type` = `chat_create` или `chat_title_update`).
- `email` (`string`) — email, который пригласили или исключили (для служебных сообщений с `type` = `chat_invite_user` или `chat_kick_user` и отрицательным `member_id`).
- `photo` (`object`) — изображение-обложка чата. Объект, который содержит поля:

  - `photo_50` (`string`) — URL изображения 50x50px;
  - `photo_100` (`string`) — URL изображения 100x100px;
  - `photo_200` (`string`) — URL изображения 200x200px;

### <a id="admin_author_id"></a>`admin_author_id`

`integer` Только для сообщений сообщества. Содержит идентификатор пользователя (администратора сообщества), отправившего это сообщение.

### <a id="conversation_message_id"></a>`conversation_message_id`

`integer` Уникальный автоматически увеличивающийся номер для всех сообщений с этим peer.

### <a id="is_cropped"></a>`is_cropped`

`boolean` Это сообщение обрезано для бота.

### <a id="members_count"></a>`members_count`

`integer` Количество участников.

### <a id="update_time"></a>`update_time`

`integer` Дата, когда сообщение было обновлено в Unixtime.

### <a id="was_listened"></a>`was_listened`

`boolean` Было ли вложенное аудиосообщение уже прослушано вами.

### <a id="pinned_at"></a>`pinned_at`

`integer` Дата, когда сообщение было закреплено в Unixtime.

### <a id="message_tag"></a>`message_tag`

`string` Строка для сопоставления пользователя Notify и ВКонтакте. Данные копирует в момент ответа пользователем на сообщение из Notify, отправленное с параметром `session_id`. Подробнее про Notify: [https://notify.mail.ru/](https://vk.ru/away.php?to=https%3A%2F%2Fnotify.mail.ru%2F)

## <a id="Для версий API ниже 5.80"></a>Для версий API ниже 5.80

### <a id="id"></a>`id`

`integer` Идентификатор сообщения (не возвращается для пересланных сообщений).

### <a id="user_id"></a>`user_id`

`integer` Идентификатор пользователя, в диалоге с которым находится сообщение.

### <a id="from_id"></a>`from_id`

`integer` Идентификатор автора сообщения. Положительное число.

### <a id="date"></a>`date`

`integer` Дата отправки сообщения в формате Unixtime.

### <a id="read_state"></a>`read_state`

`integer` Статус сообщения (`0` — не прочитано, `1` — прочитано, не возвращается для пересланных сообщений).

### <a id="ref"></a>`ref`

`string` Произвольный параметр для работы с [источниками переходов](../../api/community-messages/getting-started.md).

### <a id="ref_source"></a>`ref_source`

`string` Произвольный параметр для работы с [источниками переходов](../../api/community-messages/getting-started.md).

### <a id="out"></a>`out`

`integer` Тип сообщения (`0` — полученное, `1` — отправленное, не возвращается для пересланных сообщений).

### <a id="title"></a>`title`

`string` Заголовок сообщения или беседы.

### <a id="body"></a>`body`

`string` Текст сообщения.

### <a id="geo"></a>`geo`

`object` Информация о [местоположении](https://dev.vk.ru/ru/reference/objects/geo).

### <a id="attachments"></a>`attachments`

`array` Медиавложения сообщения (фотографии, ссылки и т.п.). Описание массива `attachments` находится [на отдельной странице](attachments-message.md).

### <a id="fwd_messages"></a>`fwd_messages`

`array` Массив пересланных сообщений (если есть). Максимальное количество элементов — `100`. Максимальная глубина вложенности для пересланных сообщений — `45`, общее максимальное количество в цепочке с учетом вложенности — `500`.

### <a id="emoji"></a>`emoji`

`integer` Содержатся ли в сообщении [emoji](../emoji.md)-смайлы.

### <a id="important"></a>`important`

`integer` Является ли сообщение важным.

### <a id="deleted"></a>`deleted`

`integer` Удалено ли сообщение.

### <a id="random_id"></a>`random_id`

`integer` Идентификатор, используемый при отправке сообщения. Возвращается только для исходящих сообщений.

## <a id="Дополнительные поля в сообщениях из мультидиалогов"></a>Дополнительные поля в сообщениях из мультидиалогов

### <a id="chat_id"></a>`chat_id`

`integer` Идентификатор беседы.

### <a id="chat_active"></a>`chat_active`

`array` Идентификаторы авторов последних сообщений беседы (`integer`).

### <a id="push_settings"></a>`push_settings`

Настройки уведомлений для беседы, если они есть.

### <a id="users_count"></a>`users_count`

`integer` Количество участников беседы.

### <a id="admin_id"></a>`admin_id`

`integer` Идентификатор создателя беседы.

### <a id="action"></a>`action`

`string` Тип действия (если это служебное сообщение). Возможные значения:

- `chat_photo_update` — обновлена фотография беседы;
- `chat_photo_remove` — удалена фотография беседы;
- `chat_create` — создана беседа;
- `chat_title_update` — обновлено название беседы;
- `chat_invite_user` — приглашен пользователь;
- `chat_kick_user` — исключен пользователь.
- `chat_pin_message` — закреплено сообщение;
- `chat_unpin_message` — откреплено сообщение;
- `chat_invite_user_by_link` — пользователь присоединился к беседе по ссылке.

### <a id="action_mid"></a>`action_mid`

`integer` Идентификатор пользователя (если \> 0) или email (если \< 0), которого пригласили или исключили (для служебных сообщений с `action` = `chat_invite_user`, `chat_invite_user_by_link` или `chat_kick_user`). Идентификатор пользователя, который закрепил/открепил сообщение для `action` = `chat_pin_message` или `chat_unpin_message`.

### <a id="action_email"></a>`action_email`

`string` Email, который пригласили или исключили (для служебных сообщений с `action` = `chat_invite_user` или `chat_kick_user` и отрицательным `action_mid`).

### <a id="action_text"></a>`action_text`

`string` Название беседы (для служебных сообщений с `action` = `chat_create` или `chat_title_update`). Текст закрепленного сообщения для `action` = `chat_pin_message`.

### <a id="photo_50"></a>`photo_50`

`string` URL копии фотографии беседы шириной 50 px.

### <a id="photo_100"></a>`photo_100`

`string` URL копии фотографии беседы шириной 100 px.

### <a id="photo_200"></a>`photo_200`

`string` URL копии фотографии беседы шириной 200 px.
