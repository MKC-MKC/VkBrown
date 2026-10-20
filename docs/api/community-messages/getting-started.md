# Сообщения сообществ

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/community-messages/getting-started)

**Сообщения сообществ** — сервис для прямого диалога между пользователем и сообществом ВКонтакте.

- Вашим клиентам не придётся искать форму обратной связи, проходить регистрацию, отвечать через email — никаких лишних действий.
- Вместе с сообщением вы получаете все необходимые данные о его авторе, можете автоматически обрабатывать типовые заявки и мгновенно отвечать на сообщения с помощью бота.

Сообщения сообществ работают в полной и мобильной версиях ВКонтакте, а также во всех официальных приложениях: с вашей компанией можно связаться на любой платформе. Подробнее о сообщениях сообществ — в статье [Полезные настройки для сообщений в сообществе](https://vk.ru/away.php?to=https%3A%2F%2Fvk.com%2F%40business-poleznye-nastroiki-dlya-soobschenii-v-soobschestve).

## <a id="API для сообщений сообществ"></a>API для сообщений сообществ

В этом руководстве рассказывается о том, как использовать API для работы с сообщениями сообществ.

## <a id="Ключ доступа"></a>Ключ доступа

Для работы с API от имени сообщества необходимо получить специальный ключ доступа. Вы можете сделать это двумя способами — в интерфейсе управления сообществом или программно, с помощью специального запроса к нашему серверу.

Ключ доступа — это строка, включающая латинские буквы и цифры. Её необходимо передавать в заголовке `Authorization` в формате `Bearer <ключ_доступа>`, обращаясь к методам API от имени сообщества.

## <a id="Получение ключа доступа в настройках сообщества"></a>Получение ключа доступа в настройках сообщества

1. Откройте vk.com и перейдите в сообщество, в котором вы являетесь администратором.
2. В меню справа выберите **Управление** и затем **Дополнительно → Работа с API**.
3. Нажмите **Создать ключ**. Отметьте необходимые права доступа и подтвердите свой выбор.

Вы можете создать несколько ключей с разными правами доступа. Ключи нельзя размещать публично — узнав его, третье лицо может обращаться к API ВКонтакте от имени вашего сообщества. Если ключ был скомпрометирован, необходимо удалить его из списка — после этого он станет недействителен.

## <a id="Получение ключа доступа на oauth.vk.ru"></a>Получение ключа доступа на oauth.vk.ru

Мы предлагаем два способа авторизации, основанных на протоколе OAuth 2.0. Используйте этот подход, если необходимо работать со многими сообществами пользователя, например, при разработке мобильного приложения.

Для работы с API с серверной стороны используйте [Authorization Code Flow](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Foauth%2Foauth-vkontakte%2Fauthcode-flow-community).

Для работы с API со стороны клиента используйте [Implicit Flow](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Foauth%2Foauth-vkontakte%2Fimplicit-flow-community).

## <a id="Работа с сообщениями"></a>Работа с сообщениями

В API сообщений сообществ используются те же методы, что и для работы с личными сообщениями пользователя. Если раньше вы уже имели дело с сообщениями в API ВКонтакте, схема работы будет вам знакома. Стоит, однако, учитывать некоторые особенности:

- необходимо проставлять статус прочитанности сообщения при общении с клиентом;
- если ответ получен пользователем, его необходимо помечать как прочитанный;
- в беседах сообществ доступны специальные метки: **Важные**, **Неотвеченные**, **Непрочитанные**.

Чтобы вы могли отправлять пользователю сообщения от имени сообщества, пользователь должен разрешить их получение. Если пользователь написал сообщение сообществу первым, это приравнивается к согласию на получение ответных сообщений (без ограничений по времени, если пользователь не запретил сообщения вручную). Чтобы запросить у пользователя разрешение на отправку сообщений, используйте:

- Событие [`VKWebAppAllowMessagesFromGroup`](https://dev.vk.ru/ru/bridge/VKWebAppAllowMessagesFromGroup) библиотеки [VK Bridge](https://dev.vk.ru/ru/bridge/overview).
- Метод [`messages.allowMessagesFromGroup`](../../method/messages.allowMessagesFromGroup.md) в Standalone-приложениях.
- Виджет [Разрешить писать сообществу](https://dev.vk.ru/ru/widgets/allow-messages-from-community) на внешнем сайте.

В [Callback API](../callback/getting-started.md) и [Bots Longpoll API](../bots-long-poll/getting-started.md) события `message_allow` и `message_deny` помогут отслеживать факт разрешения и запрета сообщений от сообщества.

**Внимание!** Через API нельзя получить список всех пользователей, разрешивших сообщения сообществу. Необходимо хранить и синхронизировать этот список на своей стороне.

## <a id="Доступные инструменты и методы"></a>Доступные инструменты и методы

- [Long Poll сервер](../user-long-poll/getting-started.md) — синхронизация обновлений;
- [Callback API](../callback/getting-started.md) — мгновенные оповещения о новых сообщениях и других действиях пользователей в сообществе.
- [`messages.getConversations`](../../method/messages.getConversations.md) — метод для получения списка бесед;
- [`messages.markAsRead`](https://dev.vk.ru/ru/method/messages.markAsRead) — метод для присвоения сообщению метки **Прочитано**;
- [`messages.markAsImportantConversation`](https://dev.vk.ru/ru/method/messages.markAsImportantConversation), [`messages.markAsAnsweredConversation`](https://dev.vk.ru/ru/method/messages.markAsAnsweredConversation) — методы для присвоения меток беседам;
- [`messages.send`](../../method/messages.send.md) — метод для отправки нового сообщения;
- [`messages.delete`](../../method/messages.delete.md), [`messages.deleteConversation`](https://dev.vk.ru/ru/method/messages.deleteConversation), [`messages.restore`](https://dev.vk.ru/ru/method/messages.restore) — методы для удаления и восстановления сообщений и бесед;
- [`messages.search`](https://dev.vk.ru/ru/method/messages.search) — метод для поиска по сообщениям;
- [`messages.allowMessagesFromGroup`](../../method/messages.allowMessagesFromGroup.md), [`messages.denyMessagesFromGroup`](https://dev.vk.ru/ru/method/messages.denyMessagesFromGroup) — методы для подписки на сообщения сообщества и запрета на получение сообщений;
- [`docs.getWallUploadServer`](../../method/docs.getWallUploadServer.md) — метод для загрузки документа на стену.
- [`groups.getCallbackConfirmationCode`](../../method/groups.getCallbackConfirmationCode.md), [`groups.getCallbackServerSettings`](https://dev.vk.ru/ru/method/groups.getCallbackServerSettings), [`groups.getCallbackSettings`](../../method/groups.getCallbackSettings.md), [`groups.setCallbackSettings`](../../method/groups.setCallbackSettings.md) — методы для работы с настройками Callback API.

## <a id="Получение списка бесед"></a>Получение списка бесед

Метод [`messages.getConversations`](../../method/messages.getConversations.md).

Параметр `start_message_id` используется для защиты от смещения из-за новых сообщений при подгрузке старых бесед. При первом вызове не передавайте `start_message_id`, запомните значение `id` у сообщения в первой беседе и используйте его в качестве `start_message_id` в последующих вызовах при подгрузке бесед.

## <a id="Получение новых бесед"></a>Получение новых бесед

Метод [`messages.getConversations`](../../method/messages.getConversations.md).

Передавайте значения параметров:

- `start_message_id` — значение `id` сообщения в первой беседе.
- `count` — максимальное количество новых бесед.
- `offset` — отрицательное значение.

## <a id="Получение истории сообщений в беседе"></a>Получение истории сообщений в беседе

Метод [`messages.getHistory`](../../method/messages.getHistory.md).

Чтобы получить историю конкретной беседы, используйте параметр `peer_id`. Параметр `start_message_id` используется для защиты от смещения из-за новых сообщений при подгрузке истории. При первом вызове не передавайте `start_message_id`, запомните значение `id` первого сообщения из ответа и используйте его в качестве `start_message_id` в последующих вызовах.

## <a id="Получение новых сообщений с помощью Callback API"></a>Получение новых сообщений с помощью Callback API

[Callback API](../callback/getting-started.md) позволяет мгновенно получать информацию о новых сообщениях в адрес сообщества.

Для работы с Callback API вам потребуется серверный скрипт для обработки уведомлений. Настройте оповещения, следуя [документации](../callback/getting-started.md), среди типов событий выберите **Получение нового сообщения** (`message_new`).

ВКонтакте будет отправлять на ваш сервер оповещение о каждом новом сообщении с [объектом личного сообщения](../../reference/objects/message.md) в формате:

```json
{
  "type": "message_new",
  "object": "..."
}
```

В уведомлении содержится исчерпывающая информация о сообщении — вы можете сразу ответить на него, используя метод [`messages.send`](../../method/messages.send.md).

## <a id="Передача произвольного параметра с помощью ссылки vk.me"></a>Передача произвольного параметра с помощью ссылки vk.me

vk.me — это сервис коротких URL, который перенаправляет пользователей в указанную беседу. Ссылка имеет формат [http://vk.me/{group\_name}](https://vk.ru/away.php?to=http%3A%2F%2Fvk.me%2F%257Bgroup_name%257D), где `group_name` — идентификатор сообщества. К примеру, vk.me/apiclub.

Вы можете не только создать красивую ссылку на беседу с сообществом, но и передать в такой ссылке произвольные параметры `ref` и `ref_source`, которые вернутся в объекте сообщения в [событии](../community-events/json-schema.md) `message_new` [Callback API](../callback/getting-started.md) или [Bots Long Poll API](../bots-long-poll/getting-started.md), в случае если пользователь начнёт или продолжит беседу по ссылке вида vk.me.

Это полезно для отслеживания эффективности ссылок, размещенных в разных каналах, или привязки пользователя к сеансу или аккаунту во внешнем приложении. В зависимости от переданного параметра можно варьировать ответы бота в сообществе.

Ссылка vk.me с дополнительными параметрами выглядит следующим образом:

 `vk.me/{group_name}?ref={ref}&ref_source={ref_source}`

Также сработает ссылка вида:

 `vk.com/write-{group_id}?ref={ref}&ref_source={ref_source}`

## <a id="Отправка изображений"></a>Отправка изображений

Чтобы отправить изображение в сообщении, используйте параметр `attachments` в методе [`messages.send`](../../method/messages.send.md). Вы можете использовать изображение, которое уже есть на сайте ВКонтакте, либо [загрузить новое](../upload/photo-in-message.md).

Для загрузки фотографий и документов в сообщения сообщества используйте, соответственно, методы [`photos.getMessagesUploadServer`](../../method/photos.getMessagesUploadServer.md) и [`docs.getMessagesUploadServer`](../../method/docs.getMessagesUploadServer.md). Это позволит загружать вложения для неограниченного числа собеседников.
