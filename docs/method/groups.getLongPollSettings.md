# groups.getLongPollSettings

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.getLongPollSettings)

Получает настройки Bots Longpoll API для сообщества.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): groups — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### group\_id

positive

Идентификатор сообщества.

Обязательный параметр

## <a id="Результат"></a>Результат

Возвращает объект, который содержит следующие поля:

- `is_enabled` (`boolean`) — `true`, если Bots Longpoll включен в сообществе.
- `events` (`object`) — настройки Bots Longpoll. объект, содержащий настройки уведомлений в формате «название события» : «статус» (`0` — уведомления о событии выключены, `1` — уведомления о событии включены). Объект содержит следующие поля:

| Поле | Описание |
| --- | --- |
| `message_new` | Новое сообщение `integer`, \[`0`, `1`\] |
| `message_reply` | Новое исходящее сообщение `integer`, \[`0`, `1`\] |
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

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

v

5.199 (текущая)

{}
