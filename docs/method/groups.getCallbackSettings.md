# groups.getCallbackSettings

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getCallbackSettings)

Позволяет получить настройки уведомлений [Callback API](../api/callback/getting-started.md) для сообщества.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

integer

Идентификатор сообщества.

Обязательный параметр

### server\_id

positive

Идентификатор сервера.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает объект, содержащий настройки уведомлений в формате «название события» : «статус» (`0` — уведомления о событии выключены, `1` — уведомления о событии включены). Объект содержит следующие поля:

| Поле | Описание |
| --- | --- |
| `message_new` | Новое сообщение `integer`, \[`0`, `1`\] |
| `message_reply` | Новое исходящее сообщение `integer`, \[`0`, `1`\] |
| `message_edit` | Редактирование сообщения `integer`, \[`0`, `1`\] |
| `message_allow` | Новая подписка на сообщения `integer`, \[`0`, `1`\] |
| `message_deny` | Новый запрет сообщений `integer`, \[`0`, `1`\] |
| `photo_new` | Добавление новой фотографии `integer`, \[`0`, `1`\] |
| `audio_new` | Добавление новой аудиозаписи `integer`, \[`0`, `1`\] |
| `video_new` | Добавление новой видеозаписи `integer`, \[`0`, `1`\] |
| `wall_reply_new` | Добавление нового комментария на стене `integer`, \[`0`, `1`\] |
| `wall_reply_edit` | Редактирование комментария на стене `integer`, \[`0`, `1`\] |
| `wall_reply_delete` | Удаление комментария на стене `integer`, \[`0`, `1`\] |
| `wall_post_new` | Добавление новой записи на стене `integer`, \[`0`, `1`\] |
| `wall_repost` | Новый репост записи на стене `integer`, \[`0`, `1`\] |
| `board_post_new` | Добавление нового комментария в обсуждении `integer`, \[`0`, `1`\] |
| `board_post_edit` | Редактирование комментария в обсуждении `integer`, \[`0`, `1`\] |
| `board_post_delete` | Удаление комментария в обсуждении `integer`, \[`0`, `1`\] |
| `board_post_restore` | Восстановление комментария в обсуждении `integer`, \[`0`, `1`\] |
| `photo_comment_new` | Добавление нового комментария к фото `integer`, \[`0`, `1`\] |
| `photo_comment_edit` | Редактирование комментария к фото `integer`, \[`0`, `1`\] |
| `photo_comment_delete` | Удаление комментария к фото `integer`, \[`0`, `1`\] |
| `photo_comment_restore` | Восстановление комментария к фото `integer`, \[`0`, `1`\] |
| `video_comment_new` | Добавление нового комментария к видео `integer`, \[`0`, `1`\] |
| `video_comment_edit` | Редактирование комментария к видео `integer`, \[`0`, `1`\] |
| `video_comment_delete` | Удаление комментария к видео `integer`, \[`0`, `1`\] |
| `video_comment_restore` | Восстановление комментария к видео `integer`, \[`0`, `1`\] |
| `market_comment_new` | Добавление нового комментария к товару `integer`, \[`0`, `1`\] |
| `market_comment_edit` | Редактирование комментария к товару `integer`, \[`0`, `1`\] |
| `market_comment_delete` | Удаление комментария к товару `integer`, \[`0`, `1`\] |
| `market_comment_restore` | Восстановление удалённого комментария к товару `integer`, \[`0`, `1`\] |
| `poll_vote_new` | Новый голос в публичном опросе `integer`, \[`0`, `1`\] |
| `group_join` | Вступление в сообщество `integer`, \[`0`, `1`\] |
| `group_leave` | Выход участника из сообщества `integer`, \[`0`, `1`\] |
| `user_block` | Занесение пользователя в черный список `integer`, \[`0`, `1`\] |
| `user_unblock` | Удаление пользователя из черного списка `integer`, \[`0`, `1`\] |
| `group_change_settings` | Изменение настроек сообщества `integer`, \[`0`, `1`\] |
| `group_change_photo` | Изменение главной фотографии `integer`, \[`0`, `1`\] |
| `group_officers_edit` | Изменение руководства сообщества `integer`, \[`0`, `1`\] |
| `donut_subscription_create` | Создание подписки `integer`, \[`0`, `1`\] |
| `donut_subscription_prolonged` | Продление подписки `integer`, \[`0`, `1`\] |
| `donut_subscription_expired` | Подписка истекла `integer`, \[`0`, `1`\] |
| `donut_subscription_cancelled` | Отмена подписки `integer`, \[`0`, `1`\] |
| `subscription_price_changed` | Изменение стоимости подписки `integer`, \[`0`, `1`\] |
| `donut_money_withdraw` | Вывод денег `integer`, \[`0`, `1`\] |
| `donut_money_withdraw_error` | Ошибка вывода денег `integer`, \[`0`, `1`\] |

## <a id="Коды ошибок"></a>Коды ошибок

104

Not found

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

server\_id

v

5.199 (текущая)

{}

## <a id="Связанные версии"></a>Связанные версии

[Перейти на страницу версий API](../reference/versions.md)

[5.70](https://dev.vk.ru/ru/reference/version/5.70)

- В поле `action` объекта [сообщения](../reference/objects/message.md) может возвращаться значение `chat_invite_user_by_link`.
- В объекте [сообщения](../reference/objects/message.md) добавлено поле `update_time`.
- Методы [`wall.post`](https://dev.vk.ru/ru/wall.post), [`wall.editAdsStealth`](https://dev.vk.ru/ru/wall.editAdsStealth), [`wall.edit`](https://dev.vk.ru/ru/wall.edit), [`wall.repost`](https://dev.vk.ru/ru/wall.repost) могут возвращать новую ошибку `224` — превышен лимит рекламных записей.
- В Callback API добавлено новое событие — `message_edit`.

[5.64](https://dev.vk.ru/ru/reference/version/5.64)

- В ответ метода `messages.getDialogs` добавлены поля `unanswered` и `important`. Они используются в объектах, описывающих сообщения сообществ.
- В ответ метода `groups.getCallbackSettings` добавлено поле `wall_repost`, которое содержит информацию о настройках уведомления о репосте.
- Метод `video.save` возвращает ошибку `15`, если в вызове указан параметр `wallpost = 1`, и приложение не запрашивало права доступа **wall**.

[5.58](https://dev.vk.ru/ru/reference/version/5.58)

- В возвращаемых объектах, описывающих [сообщества](../reference/objects/group.md), появилось новое поле `is_messages_blocked`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события: `message_allow` и `message_deny`. Метод [`groups.setCallbackSettings`](groups.setCallbackSettings.md) принимает два новых параметра, а метод [`groups.getCallbackSettings`](groups.getCallbackSettings.md) возвращает два новых поля, соответственно.
