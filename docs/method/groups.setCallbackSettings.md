# groups.setCallbackSettings

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/groups.setCallbackSettings)

Позволяет задать настройки уведомлений о событиях в [Callback API](../api/callback/getting-started.md).

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

### api\_version

string

Версия Callback API

### message\_new

checkbox

Уведомления о новых сообщениях (`0` — выключить, `1` — включить).

### message\_reply

checkbox

Уведомления об исходящем сообщении (`0` — выключить, `1` — включить).

### message\_allow

checkbox

Уведомления о подписке на сообщения (`0` — выключить, `1` — включить).

### message\_edit

checkbox

Уведомления о редактировании сообщения (`0` — выключить, `1` — включить).

### message\_deny

checkbox

Уведомления о запрете на сообщения (`0` — выключить, `1` — включить).

### message\_typing\_state

checkbox

Уведомления о наборе текста сообщения (`0` — выключить, `1` — включить).

### message\_read

checkbox

### photo\_new

checkbox

Уведомления о добавлении новой фотографии (`0` — выключить, `1` — включить).

### audio\_new

checkbox

Уведомления о добавлении новой аудиозаписи (`0` — выключить, `1` — включить).

### video\_new

checkbox

Уведомления о добавлении новой видеозаписи (`0` — выключить, `1` — включить).

### wall\_reply\_new

checkbox

Уведомления о добавлении нового комментария на стене (`0` — выключить, `1` — включить).

### wall\_reply\_edit

checkbox

Уведомления о редактировании комментария на стене (`0` — выключить, `1` — включить).

### wall\_reply\_delete

checkbox

Уведомления об удалении комментария на стене (`0` — выключить, `1` — включить).

### wall\_reply\_restore

checkbox

Уведомления о восстановлении комментария на стене (`0` — выключить, `1` — включить).

### wall\_post\_new

checkbox

Уведомления о новой записи на стене (`0` — выключить, `1` — включить).

### wall\_repost

checkbox

Уведомления о репосте записи (`0` — выключить, `1` — включить).

### board\_post\_new

checkbox

Уведомления о создании комментария в обсуждении (`0` — выключить, `1` — включить).

### board\_post\_edit

checkbox

Уведомления о редактировании комментария в обсуждении (`0` — выключить, `1` — включить).

### board\_post\_restore

checkbox

Уведомление о восстановлении комментария в обсуждении (`0` — выключить, `1` — включить).

### board\_post\_delete

checkbox

Уведомления об удалении комментария в обсуждении (`0` — выключить, `1` — включить).

### photo\_comment\_new

checkbox

Уведомления о добавлении нового комментария к фото (`0` — выключить, `1` — включить).

### photo\_comment\_edit

checkbox

Уведомления о редактировании комментария к фото (`0` — выключить, `1` — включить).

### photo\_comment\_delete

checkbox

Уведомления об удалении комментария к фото (`0` — выключить, `1` — включить).

### photo\_comment\_restore

checkbox

Уведомления о восстановлении комментария к фото (`0` — выключить, `1` — включить).

### video\_comment\_new

checkbox

Уведомления о добавлении нового комментария к видео (`0` — выключить, `1` — включить).

### video\_comment\_edit

checkbox

Уведомления о редактировании комментария к видео (`0` — выключить, `1` — включить).

### video\_comment\_delete

checkbox

Уведомления об удалении комментария к видео (`0` — выключить, `1` — включить).

### video\_comment\_restore

checkbox

Уведомления о восстановлении комментария к видео (`0` — выключить, `1` — включить).

### market\_comment\_new

checkbox

Уведомления о добавлении нового комментария к товару (`0` — выключить, `1` — включить).

### market\_comment\_edit

checkbox

Уведомления о редактировании комментария к товару (`0` — выключить, `1` — включить).

### market\_comment\_delete

checkbox

Уведомления об удалении комментария к товару (`0` — выключить, `1` — включить).

### market\_comment\_restore

checkbox

Уведомления о восстановлении комментария к товару (`0` — выключить, `1` — включить).

### market\_order\_new

checkbox

### market\_order\_edit

checkbox

### poll\_vote\_new

checkbox

Уведомления о новом голосе в публичных опросах (`0` — выключить, `1` — включить).

### group\_join

checkbox

Уведомления о вступлении в сообщество (`0` — выключить, `1` — включить).

### group\_leave

checkbox

Уведомления о выходе из сообщества (`0` — выключить, `1` — включить).

### group\_change\_settings

checkbox

Уведомления об изменении настроек (`0` — выключить, `1` — включить).

### group\_change\_photo

checkbox

Уведомления об изменении главной фотографии (`0` — выключить, `1` — включить).

### group\_officers\_edit

checkbox

Уведомления об изменении руководства (`0` — выключить, `1` — включить).

### user\_block

checkbox

Уведомления об внесении пользователя в чёрный список (`0` — выключить, `1` — включить).

### user\_unblock

checkbox

Уведомления об исключении пользователя из чёрного списка (`0` — выключить, `1` — включить).

### lead\_forms\_new

checkbox

Уведомления о заполнении формы.

### like\_add

checkbox

Уведомления о новой отметке «Мне нравится» (`0` — выключить, `1` — включить).

### like\_remove

checkbox

Уведомления о снятии отметки «Мне нравится» (`0` — выключить, `1` — включить).

### message\_event

checkbox

### message\_reaction\_event

checkbox

### donut\_subscription\_create

checkbox

Уведомление о создании подписки (`0` — выключить, `1` — включить).

### donut\_subscription\_prolonged

checkbox

Уведомление о продлении подписки (`0` — выключить, `1` — включить).

### donut\_subscription\_cancelled

checkbox

Уведомление об отмене подписки (`0` — выключить, `1` — включить).

### donut\_subscription\_price\_changed

checkbox

Уведомление об изменении стоимости подписки (`0` — выключить, `1` — включить).

### donut\_subscription\_expired

checkbox

Уведомление о том, что подписка истекла (`0` — выключить, `1` — включить).

### donut\_money\_withdraw

checkbox

Уведомление о выводе денег (`0` — выключить, `1` — включить).

### donut\_money\_withdraw\_error

checkbox

Уведомление об ошибке при выводе денег (`0` — выключить, `1` — включить).

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

104

Not found

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

server\_id

api\_version

message\_new

bool0

message\_reply

bool0

message\_allow

bool0

message\_edit

bool0

message\_deny

bool0

message\_typing\_state

bool0

message\_read

bool0

photo\_new

bool0

audio\_new

bool0

video\_new

bool0

wall\_reply\_new

bool0

wall\_reply\_edit

bool0

wall\_reply\_delete

bool0

wall\_reply\_restore

bool0

wall\_post\_new

bool0

wall\_repost

bool0

board\_post\_new

bool0

board\_post\_edit

bool0

board\_post\_restore

bool0

board\_post\_delete

bool0

photo\_comment\_new

bool0

photo\_comment\_edit

bool0

photo\_comment\_delete

bool0

photo\_comment\_restore

bool0

video\_comment\_new

bool0

video\_comment\_edit

bool0

video\_comment\_delete

bool0

video\_comment\_restore

bool0

market\_comment\_new

bool0

market\_comment\_edit

bool0

market\_comment\_delete

bool0

market\_comment\_restore

bool0

market\_order\_new

bool0

market\_order\_edit

bool0

poll\_vote\_new

bool0

group\_join

bool0

group\_leave

bool0

group\_change\_settings

bool0

group\_change\_photo

bool0

group\_officers\_edit

bool0

user\_block

bool0

user\_unblock

bool0

lead\_forms\_new

bool0

like\_add

bool0

like\_remove

bool0

message\_event

bool0

message\_reaction\_event

bool0

donut\_subscription\_create

bool0

donut\_subscription\_prolonged

bool0

donut\_subscription\_cancelled

bool0

donut\_subscription\_price\_changed

bool0

donut\_subscription\_expired

bool0

donut\_money\_withdraw

bool0

donut\_money\_withdraw\_error

bool0

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

[5.58](https://dev.vk.ru/ru/reference/version/5.58)

- В возвращаемых объектах, описывающих [сообщества](../reference/objects/group.md), появилось новое поле `is_messages_blocked`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события: `message_allow` и `message_deny`. Метод [`groups.setCallbackSettings`](groups.setCallbackSettings.md) принимает два новых параметра, а метод [`groups.getCallbackSettings`](groups.getCallbackSettings.md) возвращает два новых поля, соответственно.
