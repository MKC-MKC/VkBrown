# Версии API

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/versions)

## <a id="Версии API"></a>Версии API

## <a id="5.199"></a>[5.199](https://dev.vk.ru/ru/reference/version/5.199)

Изменения во внутренних алгоритмах обработки некоторых запросов.<br> Изменений в составе API-методов, их параметров и возвращаемых значений нет.

## <a id="5.195"></a>[5.195](https://dev.vk.ru/ru/reference/version/5.195)

- В методе `video.edit` изменён формат ответа.

Влияет на методы: [video.edit](https://dev.vk.ru/method/video.edit)

## <a id="5.194"></a>[5.194](https://dev.vk.ru/ru/reference/version/5.194)

- В методы `ads.createClients` и `ads.updateClients` добавлен параметр `ord_data` для сохранения данных клиента по объекту оператора рекламных данных (ОРД).
- Метод ads.`getClients` возвращает данные клиента по ОРД в поле `ord_data`.
- Метод `messages.getChatPreview` возвращает поле `chat_settings.state` со значением `out` и поле `joined` со значением `false`, если пользователь никогда не был участником чата.

Влияет на методы: [ads.createClients](https://dev.vk.ru/method/ads.createClients) [ads.updateClients](https://dev.vk.ru/method/ads.updateClients) [ads.getClients](https://dev.vk.ru/method/ads.getClients) [messages.getChatPreview](https://dev.vk.ru/method/messages.getChatPreview)

## <a id="5.193"></a>[5.193](https://dev.vk.ru/ru/reference/version/5.193)

- В методе `messages.markAsRead` параметр `start_cmid` переименован в `up_to_cmid`.
- В глобальном поиске в мобильном приложении изменяется текст блока мини-приложений на блок **Сервисы**.

Влияет на методы: [messages.markAsRead](https://dev.vk.ru/method/messages.markAsRead)

## <a id="5.192"></a>[5.192](https://dev.vk.ru/ru/reference/version/5.192)

- В методе `database.getSchoolClasses` изменён формат ответа.

## <a id="5.154"></a>[5.154](https://dev.vk.ru/ru/reference/version/5.154)

- В методах `messages.*` добавлен тип вложения — сюжет (`narrative`).

## <a id="5.141"></a>[5.141](https://dev.vk.ru/ru/reference/version/5.141)

- В объект заказа добавлено поле `is_viewed_by_admin`.

## <a id="5.139"></a>[5.139](https://dev.vk.ru/ru/reference/version/5.139)

- В методе `groups.getById` изменён формат ответа. В `response` возвращаются:



  - Поле `groups` с информацией о необходимых сообществах.
  - Поле `profiles` c описанием пользователей, отметивших сообщество отметкой «Нравится».



  Также в объект группы добавлено поле `like`.
- Полностью поменялся формат метода `market.getCategories`. В `response` возвращается вложенное дерево категорий (вложенность бесконечная). Поля `offset` и `count` стали deprecated — дерево возвращается полностью.
- В методе `market.getById` изменился формат поля `category`: у поля был обязательное поле `section`, сейчас — поле parent (необязательное), указывающее на родителя. В `parent` может быть ещё `parent`, который указывает на его родителя. Вложенность бесконечная. Если родителя нет, то поле `parent` не возвращается.

## <a id="5.138"></a>[5.138](https://dev.vk.ru/ru/reference/version/5.138)

- В методе `wall.getById` изменён формат ответа, если параметр `extended` имеет значение `0`: теперь для однородности результат обёрнут в поле `items`, как в случае запроса с параметром `extended`, равным `1`.
- В методе `messages.send` параметр `user_ids` помечен как deprecated. Используйте вместо него параметр `peer_ids`.

## <a id="5.137"></a>[5.137](https://dev.vk.ru/ru/reference/version/5.137)

- В методе `newsfeed.ignoreItem` изменился формат ответа. Теперь в `response` возвращаются поля `status` (обязательное, `boolean`) и `message` (необязательное, `string`) с сообщением о скрытии блока.

## <a id="5.134"></a>[5.134](https://dev.vk.ru/ru/reference/version/5.134)

- Поле `icon` объекта `store_product` теперь содержит объект типа `stickers_image_set`.

## <a id="5.131"></a>[5.131](https://dev.vk.ru/ru/reference/version/5.131)

- В методах `market.add` и `market.edit` добавлено поле `sku` — артикул товара.
- В методах `market.getOrderItems`, `market.getOrderById` и `market.get` в объект `item` добалено поле `sku`, обозначающее артикул товара.
- В методе `market.getOrderItems` добавлен новый опциональный параметр `user_id`. При этом метод сохраняет предыдущую логику поведения при отсутствии указания `user_id`.

Влияет на методы: [market.add](https://dev.vk.ru/method/market.add) [market.edit](https://dev.vk.ru/method/market.edit) [market.getOrderItems](https://dev.vk.ru/method/market.getOrderItems) [market.getOrderById](https://dev.vk.ru/method/market.getOrderById) [market.get](https://dev.vk.ru/method/market.get)

## <a id="5.130"></a>[5.130](https://dev.vk.ru/ru/reference/version/5.130)

- В методе `market.editOrder` добавлены поля, которые может изменять администратор сообщества:



  - `delivery_price` — стоимость доставки.
  - `track_number` — трек-номер.
  - `payment_status` — статус оплаты.



  Также добавлены поля для редактирования габаритов и веса заказа:



  - `width` — ширина.
  - `length` — длина.
  - `height` — высота.
  - `weight` — вес.



  Поле `merchant_comment` теперь сохраняет комментарий продавца.

Влияет на методы: [market.editOrder](https://dev.vk.ru/method/market.editOrder) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory) [messages.getConversations](https://dev.vk.ru/method/messages.getConversations) [messages.getConversationsById](https://dev.vk.ru/method/messages.getConversationsById) [wall.get](https://dev.vk.ru/method/wall.get)

## <a id="5.126"></a>[5.126](https://dev.vk.ru/ru/reference/version/5.126)

- В объекте [товара](https://dev.vk.ru/ru/reference/objects/market-item), в объекте цены возвращается `old_amount_text` с текстовым представлением старой цены.

Влияет на методы: [market.get](https://dev.vk.ru/method/market.get) [market.getById](https://dev.vk.ru/method/market.getById)

## <a id="5.125"></a>[5.125](https://dev.vk.ru/ru/reference/version/5.125)

- Появились методы для работы с VK Donut: [`donut.isDon`](https://dev.vk.ru/ru/donut.isDon), [`donut.getFriends`](https://dev.vk.ru/ru/donut.getFriends), [`donut.getSubscription`](https://dev.vk.ru/ru/donut.getSubscription), [`donut.getSubscriptions`](https://dev.vk.ru/ru/donut.getSubscriptions)
- В объекте [записи](objects/post.md) появилась информация о VK Donut.
- В объекте [комментария](objects/comment.md) появилась информация о VK Donut.

Влияет на методы: [donut.getFriends](https://dev.vk.ru/method/donut.getFriends) [donut.getSubscription](https://dev.vk.ru/method/donut.getSubscription) [donut.getSubscriptions](https://dev.vk.ru/method/donut.getSubscriptions)

## <a id="5.124"></a>[5.124](https://dev.vk.ru/ru/reference/version/5.124)

- В методе [`groups.get`](https://dev.vk.ru/ru/groups.get) в объекте `market` приходит поле `type (string)`, которое может иметь значения `basic` и `advanced` в зависимости от типа магазина. Поле приходит, если в группе включен раздел «Товары».

Влияет на методы: [groups.get](https://dev.vk.ru/method/groups.get)

## <a id="5.122"></a>[5.122](https://dev.vk.ru/ru/reference/version/5.122)

- В объекте товара поля `date` и `views_count` теперь возвращаются только администратору группы, которой принадлежит товар.
- В объекте [заказа](https://dev.vk.ru/ru/reference/objects/market-order) информация о доставке и заказчике вынесена из основного объекта в новые вложенные объекты: `delivery` и `recepient`.

Влияет на методы: [market.getById](https://dev.vk.ru/method/market.getById) [market.getGroupOrders](https://dev.vk.ru/method/market.getGroupOrders) [market.get](https://dev.vk.ru/method/market.get) [market.getOrderById](https://dev.vk.ru/method/market.getOrderById)

## <a id="5.120"></a>[5.120](https://dev.vk.ru/ru/reference/version/5.120)

- В объекте [товара](https://dev.vk.ru/ru/reference/objects/market-item) появился объект `dimensions` — габариты и вес товара. Возвращаются, если они были указаны при редактировании или сохранении товара.

Влияет на методы: [market.get](https://dev.vk.ru/method/market.get) [market.getById](https://dev.vk.ru/method/market.getById)

## <a id="5.118"></a>[5.118](https://dev.vk.ru/ru/reference/version/5.118)

- В [`stories.save`](https://dev.vk.ru/ru/stories.save) изменён процесс загрузки историй. Начиная с этой версии, у методов [`stories.getPhotoUploadServer`](https://dev.vk.ru/ru/stories.getPhotoUploadServer) и [`stories.getVideoUploadServer`](https://dev.vk.ru/ru/stories.getVideoUploadServer) в ответе upload-сервера будет только один параметр — `upload_result (string)`. Для сохранения загруженных историй нужно дополнительно вызвать [`stories.save`](https://dev.vk.ru/ru/stories.save), передав туда полученный ранее `upload_result`.

Влияет на методы: [stories.save](https://dev.vk.ru/method/stories.save) [stories.getPhotoUploadServer](https://dev.vk.ru/method/stories.getPhotoUploadServer) [stories.getVideoUploadServer](https://dev.vk.ru/method/stories.getVideoUploadServer)

## <a id="5.115"></a>[5.115](https://dev.vk.ru/ru/reference/version/5.115)

- В [`stories.getViewers`](https://dev.vk.ru/ru/stories.getViewers) изменился ответ: в `items` теперь возвращается массив объектов. В объекте есть следующие поля: `is_liked (bool)` и `user_id (int)`.

Влияет на методы: [stories.getViewers](https://dev.vk.ru/method/stories.getViewers)

## <a id="5.114"></a>[5.114](https://dev.vk.ru/ru/reference/version/5.114)

- В пересланных сообщениях и ответах теперь возвращается `payload`.

## <a id="5.113"></a>[5.113](https://dev.vk.ru/ru/reference/version/5.113)

- В методах [`stories.get`](https://dev.vk.ru/ru/stories.get), [`stories.getReplies`](https://dev.vk.ru/ru/stories.getReplies), [`stories.search`](https://dev.vk.ru/ru/stories.search) возвращается новый формат ленты историй. Вместо массива массивов историй, теперь — массив объектов [блока ленты историй](https://dev.vk.ru/ru/reference/objects/story-feed-item).

Влияет на методы: [stories.get](https://dev.vk.ru/method/stories.get) [stories.getReplies](https://dev.vk.ru/method/stories.getReplies) [stories.search](https://dev.vk.ru/method/stories.search)

## <a id="5.111"></a>[5.111](https://dev.vk.ru/ru/reference/version/5.111)

- В объекте сообщения появилось поле [`template`](../api/bots/development/messages.md).

Влияет на методы: [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [messages.send](https://dev.vk.ru/method/messages.send) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.getById](https://dev.vk.ru/method/messages.getById)

## <a id="5.110"></a>[5.110](https://dev.vk.ru/ru/reference/version/5.110)

- Изменился формат ответа в методе [`storage.get`](https://dev.vk.ru/ru/storage.get) для одного ключа `key`, теперь возвращается объект того же типа, что и при передаче `keys`.
- В объекте `market`, который возвращает [`groups.getSettings`](https://dev.vk.ru/ru/groups.getSettings), появилось поле `can_message (integer[1,0])`, определяющее, что у сообщества включены сообщения.

Влияет на методы: [storage.get](https://dev.vk.ru/method/storage.get)

## <a id="5.107"></a>[5.107](https://dev.vk.ru/ru/reference/version/5.107)

- Клавиатуры бесед больше не возвращаются в [объекте сообщения](objects/message.md).
- В [объекте сообщения](objects/message.md) в поле `keyboard` возвращаются inline-клавиатуры.

Влияет на методы: [messages.getById](https://dev.vk.ru/method/messages.getById)

## <a id="5.106"></a>[5.106](https://dev.vk.ru/ru/reference/version/5.106)

- В объекте [товара](https://dev.vk.ru/ru/reference/objects/market-item) внутри объекта `price` теперь возвращается новое поле `old_amount (string)`, которое содержит старую стоимость товара.

Влияет на методы: [market.get](https://dev.vk.ru/method/market.get)

## <a id="5.105"></a>[5.105](https://dev.vk.ru/ru/reference/version/5.105)

- В методе [`ads.getStatistics`](https://dev.vk.ru/ru/method/ads.getStatistics) из ответа убрали поле `goals`, вместо него возвращается поле `lead_form_sends`.
- В метод [`apps.getActivity`](https://dev.vk.ru/ru/method/apps.getActivity) для типа `achievement` добавлен новый объект `media`, содержащий по ключу `images` картинки для данного достижения. Если картинок нет, то поле `media` будет отсутствовать.
- В метод [`apps.get`](https://dev.vk.ru/ru/method/apps.get) и [объект приложения](https://dev.vk.ru/ru/reference/objects/app) добавлены 2 новых поля: `mobile_controls_type` и `mobile_view_support_type`, которые описывают, как отображаются элементы управления для игр в WebView и в нативных клиентах:

  - Если `mobile_controls_type = 0`, то отображается чёрная полоса над областью с игрой.
  - Если `mobile_controls_type = 1`, то отображается прозрачный элемент управления поверх области с игрой.
  - Если `mobile_controls_type = 2`, элементы управления не отображаются (только для мини-приложений).
  - Если `mobile_view_support_type = 0`, то игра не использует нижнюю часть экрана на iPhoneX, черная полоса есть.
  - Если `mobile_view_support_type = 1`, то игра использует нижнюю часть экрана на iPhoneX, черной полосы нет.

Влияет на методы: [apps.get](https://dev.vk.ru/method/apps.get) [ads.getStatistics](https://dev.vk.ru/method/ads.getStatistics)

## <a id="5.104"></a>[5.104](https://dev.vk.ru/ru/reference/version/5.104)

- В объекте [groups](objects/group.md) поле `app_buttons` не возвращается, если в группе включено меню.

## <a id="5.103"></a>[5.103](https://dev.vk.ru/ru/reference/version/5.103)

- Для метода [`ads.getPostsReach`](https://dev.vk.ru/ru/method/ads.getPostsReach) изменилось поведение при ошибках, они будут возвращаться для каждого объявления отдельно.
- Метод [`ads.getAdsPostsReach`](https://dev.vk.ru/ru/method/ads.getAdsPostsReach) отключён, вместо него следует использовать [`ads.getPostsReach`](https://dev.vk.ru/ru/method/ads.getPostsReach).
- Добавлена поддержка новых типов клавиш в клавиатуре ботов.
- В Callback API и LongPoll API у события `message_new` вместо `{ object: message }` будет приходить `{ object: { message, client_info } }`.
- В [`client_info`](https://dev.vk.ru/ru/api/bots/getting-started#%D0%98%D0%BD%D1%84%D0%BE%D1%80%D0%BC%D0%B0%D1%86%D0%B8%D1%8F%20%D0%BE%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%BD%D1%8B%D1%85%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8E%20%D1%84%D1%83%D0%BD%D0%BA%D1%86%D0%B8%D1%8F%D1%85) содержится информация о клиенте, полезная для формирования сообщений ботами.

Влияет на методы: [ads.getPostsReach](https://dev.vk.ru/method/ads.getPostsReach)

## <a id="5.102"></a>[5.102](https://dev.vk.ru/ru/reference/version/5.102)

- В методах секции [`messages.*`](../method/messages.md) доступен метод для получения [материалов диалога или беседы](https://dev.vk.ru/ru/reference/objects/story-feed-item).
- Сообщения, которые не помещаются в Bots Long Poll API или Callback API, обрезаются и имеют пометку `is_cropped`. В случае обрезания остается одно пересланное сообщение или ответ и только одно вложение на каждое сообщение.
- Для методов [`ads.createTargetGroup`](https://dev.vk.ru/ru/method/ads.createTargetGroup) и [`ads.updateTargetGroup`](https://dev.vk.ru/ru/method/ads.updateTargetGroup) параметр `lifetime` стал обязательным. Параметр принимает значения от `1` до `720`.
- Истории в методе [`stories.get`](https://dev.vk.ru/ru/method/stories.get) в рамках одного автора теперь приходят в хронологическом порядке. Раньше приходили в обратном.
- В методы [`stories.getPhotoUploadServer`](https://dev.vk.ru/ru/method/stories.getPhotoUploadServer) и [`stories.getVideoUploadServer`](https://dev.vk.ru/ru/method/stories.getVideoUploadServer) добавлен параметр `clickable_stickers`.

Влияет на методы: [ads.createTargetGroup](https://dev.vk.ru/method/ads.createTargetGroup) [ads.updateTargetGroup](https://dev.vk.ru/method/ads.updateTargetGroup) [stories.get](https://dev.vk.ru/method/stories.get) [stories.getVideoUploadServer](https://dev.vk.ru/method/stories.getVideoUploadServer) [stories.getPhotoUploadServer](https://dev.vk.ru/method/stories.getPhotoUploadServer)

## <a id="5.101"></a>[5.101](https://dev.vk.ru/ru/reference/version/5.101)

- Методы работы со стеной возвращают новый аттач-сниппет для событий с типом [`events`](objects/video.md).
- Обложки в объекте [видео](objects/video.md) теперь передаются в полях `image` и `first_frame` в виде массивов объектов [`video_image`](https://dev.vk.ru/ru/reference/objects/video-image).
- Обложки в объекте [альбома видео](https://dev.vk.ru/ru/reference/objects/video-album-full) теперь передается в поле `image` в виде массива объектов [`video_image`](https://dev.vk.ru/ru/reference/objects/video-image).

## <a id="5.100"></a>[5.100](https://dev.vk.ru/ru/reference/version/5.100)

- Параметры `limit`, `count` и `offset` в методе [`messages.deleteConversation`](https://dev.vk.ru/ru/method/messages.deleteConversation) объявлены устаревшими.
- Метод [`wall.edit`](https://dev.vk.ru/ru/method/wall.edit) в случае успеха возвращает `post_id` — идентификатор отредактированного поста.

Влияет на методы: [messages.deleteConversation](https://dev.vk.ru/method/messages.deleteConversation) [wall.edit](https://dev.vk.ru/method/wall.edit)

## <a id="5.95"></a>[5.95](https://dev.vk.ru/ru/reference/version/5.95)

- В методах [`wall.getComments`](https://dev.vk.ru/ru/method/wall.getComments), [`market.getComments`](https://dev.vk.ru/ru/method/market.getComments), [`video.getComments`](https://dev.vk.ru/ru/method/video.getComments), [`board.getComments`](https://dev.vk.ru/ru/method/board.getComments) граффити вынесен в отдельный тип `attach`.
- Методы [`market.add`](https://dev.vk.ru/ru/method/market.add), [`market.edit`](https://dev.vk.ru/ru/method/market.edit) принимают параметр `url`. Объект `market` теперь может возвращать `url` и `button_title`.

Влияет на методы: [wall.getComments](https://dev.vk.ru/method/wall.getComments) [market.getComments](https://dev.vk.ru/method/market.getComments) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.getComments](https://dev.vk.ru/method/video.getComments) [board.getComments](https://dev.vk.ru/method/board.getComments)

## <a id="5.93"></a>[5.93](https://dev.vk.ru/ru/reference/version/5.93)

- Метод [`wall.createComment`](https://dev.vk.ru/ru/wall.createComment) возвращает новую ошибку `222`.

## <a id="5.92"></a>[5.92](https://dev.vk.ru/ru/reference/version/5.92)

- Метод [`wall.getComments`](https://dev.vk.ru/ru/wall.getComments) возвращает новые поля: `comment_id (integer)`, `current_level_count (integer)`.
- Метод [`wall.createComment`](https://dev.vk.ru/ru/wall.createComment) возвращает новое поле `parents_stack (array)`.
- Добавлен метод [`wall.getComment`](https://dev.vk.ru/ru/wall.getComment).
- В объекте [комментария к записи на стене](objects/comment.md) возвращаются новые поля: `parents_stack (array)`, `thread (object)`. Может возвращаться поле `deleted (boolean)`, говорящее о том, что комментарий был удалён.
- В [объекте сообщения](objects/message.md) разделены ответы и пересланные сообщения (`reply_message` и `fwd_messages`).
- В объектах [записи на стене](objects/post.md), [видеозаписи](objects/video.md), [товара](https://dev.vk.ru/ru/reference/objects/market-item) может возвращаться поле `is_favorite (boolean)`.

Влияет на методы: [wall.getComments](https://dev.vk.ru/method/wall.getComments) [wall.getComment](https://dev.vk.ru/method/wall.getComment) [wall.createComment](https://dev.vk.ru/method/wall.createComment)

## <a id="5.90"></a>[5.90](https://dev.vk.ru/ru/reference/version/5.90)

- Метод [`account.getBanned`](https://dev.vk.ru/ru/account.getBanned) возвращает поля `profiles (array)` и `groups (array)` с данными [пользователей](objects/user.md) и [сообществ](objects/group.md).
- Добавлен новый формат ответа метода [`docs.save`](https://dev.vk.ru/ru/docs.save).
- Параметр `random_id` в методе [`messages.send`](https://dev.vk.ru/ru/messages.send) теперь обязательный.

Влияет на методы: [messages.send](https://dev.vk.ru/method/messages.send) [docs.save](https://dev.vk.ru/method/docs.save)

## <a id="5.89"></a>[5.89](https://dev.vk.ru/ru/reference/version/5.89)

В [объекте пользователя](objects/user.md) добавлены новые обязательные поля:

- `is_closed (boolean)` — включена ли приватность профиля.
- `can_access_closed (boolean)` — есть ли у текущего пользователя возможность видеть профиль пользователя при `is_closed = true`.

Влияет на методы: [users.get](https://dev.vk.ru/method/users.get) [users.search](https://dev.vk.ru/method/users.search)

## <a id="5.88"></a>[5.88](https://dev.vk.ru/ru/reference/version/5.88)

- Метод [`messages.removeChatUser`](https://dev.vk.ru/ru/messages.removeChatUser) возвращает ошибку `935: User not found in chat`, если пользователя нет в чате.

Влияет на методы: [messages.removeChatUser](https://dev.vk.ru/method/messages.removeChatUser)

## <a id="5.87"></a>[5.87](https://dev.vk.ru/ru/reference/version/5.87)

- В объекте [сообщества](objects/group.md) у поля `wall` поменялись значения. Для сообществ возвращаются значения:

  - `2` – стена ограничена (было `1`).
  - `3` – стена закрытая (было `0`).

## <a id="5.86"></a>[5.86](https://dev.vk.ru/ru/reference/version/5.86)

- Метод [`messages.search`](https://dev.vk.ru/ru/messages.search) при использовании параметра `extended` = `1` возвращает массив объектов [бесед](objects/conversation.md).
- Изменения в методе [`stats.get`](https://dev.vk.ru/ru/stats.get):

  - Входные параметры `date_from` и `date_to` устарели, вместо них используются `timestamp_from` и `timestamp_to` — целые числа, представляющее собой время в Unixtime.
  - Появился входной параметр `stats_groups`, который позволяет фильтровать по отдельным блокам в статистике. Возможные значения: `visitors`, `reach`, `activity`.
  - В ответе поля `period_from` и `period_to` являются целыми числами и так же представляют собой время в Unixtime.

Влияет на методы: [messages.search](https://dev.vk.ru/method/messages.search) [stats.get](https://dev.vk.ru/method/stats.get)

## <a id="5.85"></a>[5.85](https://dev.vk.ru/ru/reference/version/5.85)

- В объекте [приложения](https://dev.vk.ru/ru/reference/objects/app) в поле `type` приходят новые значения.

  - `app` — социальное приложение.
  - `game` — игра.
  - `site` — подключенный сайт.
  - `standalone` — отдельное приложение (для мобильного устройства).
  - `vk_app` — мини-приложение.
  - `community_app` — приложение сообщества.
  - `html5_game` — HTML5 игра.
- В объекте приложения больше не приходит поле `is_html5_app`.
- Метод [`messages.getConversationMembers`](https://dev.vk.ru/ru/messages.getConversationMembers) возвращает новую ошибку `917`.
- Изменения в API опросов:

  - Новый формат [объекта опроса](https://dev.vk.ru/ru/reference/objects/poll).
  - Метод [`polls.create`](https://dev.vk.ru/ru/polls.create) поддерживает новые параметры для опросов с мультивыбором и фоном.
- В методе [`groups.getLongPollServer`](https://dev.vk.ru/ru/groups.getLongPollServer) изменился тип поля `ts` — теперь это `string`, а не `integer`.

Влияет на методы: [apps.get](https://dev.vk.ru/method/apps.get) [polls.create](https://dev.vk.ru/method/polls.create) [polls.getById](https://dev.vk.ru/method/polls.getById) [messages.getConversationMembers](https://dev.vk.ru/method/messages.getConversationMembers) [groups.getLongPollServer](https://dev.vk.ru/method/groups.getLongPollServer)

## <a id="5.84"></a>[5.84](https://dev.vk.ru/ru/reference/version/5.84)

- Метод [`messages.getChatPreview`](https://dev.vk.ru/ru/messages.getChatPreview) теперь возвращает максимум 5 участников из чата. Метод [`messages.getConversationMembers`](https://dev.vk.ru/ru/messages.getConversationMembers) возвращает поле `can_kick (boolean)` для участников беседы.
- В объекте [записи на стене](objects/post.md) для комментариев могут вернуться поля `can_close` (boolean) и `can_open (boolean)`.

Влияет на методы: [messages.getChatPreview](https://dev.vk.ru/method/messages.getChatPreview) [messages.getConversationMembers](https://dev.vk.ru/method/messages.getConversationMembers) [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getComments](https://dev.vk.ru/method/wall.getComments)

## <a id="5.83"></a>[5.83](https://dev.vk.ru/ru/reference/version/5.83)

- В объекте [сообщения](objects/message.md) могут приходить вложения с типами `graffiti` и `audio_message`. В объекте [беседы](objects/conversation.md) возвращается поле `acl`.

## <a id="5.82"></a>[5.82](https://dev.vk.ru/ru/reference/version/5.82)

- В объекте [беседы](objects/conversation.md) возвращается новое поле `is_group_channel (boolean)` для каналов сообществ.
- Метод [`stories.get`](https://dev.vk.ru/ru/stories.get) возвращает истории в реверсивном порядке.

Влияет на методы: [stories.get](https://dev.vk.ru/method/stories.get)

## <a id="5.81"></a>[5.81](https://dev.vk.ru/ru/reference/version/5.81)

- Метод [`messages.removeChatUser`](https://dev.vk.ru/ru/messages.removeChatUser) принимает новый параметр `member_id (integer)`.
- В Callback API и Bots Longpoll добавлено новое [событие](../api/events/overview.md) — платёж через VK Pay.
- Метод [`messages.deleteConversation`](https://dev.vk.ru/ru/messages.deleteConversation) в ответе возвращает поле `last_deleted_id`, содержащее идентификатор последнего удалённого сообщения.

Влияет на методы: [messages.removeChatUser](https://dev.vk.ru/method/messages.removeChatUser) [messages.deleteConversation](https://dev.vk.ru/method/messages.deleteConversation)

## <a id="5.80"></a>[5.80](https://dev.vk.ru/ru/reference/version/5.80)

- Добавили новый API для сообщений. Изменился объект [`message`](objects/message.md), а также появился объект [`conversation`](objects/conversation.md) и связанные с ним методы.
- Следующие методы объявлены устаревшими и обновляться не будут:

[`messages.getDialogs`](https://dev.vk.ru/ru/messages.getDialogs), [`messages.getChat`](https://dev.vk.ru/ru/messages.getChat), [`messages.getChatUsers`](https://dev.vk.ru/ru/messages.getChatUsers), [`messages.get`](https://dev.vk.ru/ru/messages.get), [`messages.searchDialogs`](https://dev.vk.ru/ru/messages.searchDialogs) объявлены устаревшими и больше обновляться не будут.

- В методе [`messages.markAsRead`](https://dev.vk.ru/ru/messages.markAsRead) больше не поддерживается параметр `message_ids`.
- Следующие методы будут перенаправляться на новые версии:

  - [`messages.markAsImportantDialog`](https://dev.vk.ru/ru/messages.markAsImportantDialog) → [`messages.markAsImportantConversation`](https://dev.vk.ru/ru/messages.markAsImportantConversation)
  - [`messages.markAsAnsweredDialog`](https://dev.vk.ru/ru/messages.markAsAnsweredDialog) → [`messages.markAsAnsweredConversation`](https://dev.vk.ru/ru/messages.markAsAnsweredConversation)
  - [`messages.deleteDialog`](https://dev.vk.ru/ru/messages.deleteDialog) → [`messages.deleteConversation`](https://dev.vk.ru/ru/messages.deleteConversation).
- Метод [`secure.sendSMSNotification`](https://dev.vk.ru/ru/secure.sendSMSNotification) теперь отправляет несколько сообщений. Изменился формат ответа.

Влияет на методы: [messages.getByConversationMessageId](https://dev.vk.ru/method/messages.getByConversationMessageId) [messages.getConversations](https://dev.vk.ru/method/messages.getConversations) [messages.getConversationsById](https://dev.vk.ru/method/messages.getConversationsById) [messages.getConversationMembers](https://dev.vk.ru/method/messages.getConversationMembers) [messages.searchConversations](https://dev.vk.ru/method/messages.searchConversations) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory) [messages.search](https://dev.vk.ru/method/messages.search) [messages.markAsRead](https://dev.vk.ru/method/messages.markAsRead)

## <a id="5.78"></a>[5.78](https://dev.vk.ru/ru/reference/version/5.78)

Метод [`groups.getSettings`](https://dev.vk.ru/ru/groups.getSettings) возвращает поле `events`.

## <a id="5.77"></a>[5.77](https://dev.vk.ru/ru/reference/version/5.77)

Добавлен новый формат объекта [`photo`](objects/photo.md).

Влияет на методы: [photos.get](https://dev.vk.ru/method/photos.get) [photos.getAll](https://dev.vk.ru/method/photos.getAll) [photos.getById](https://dev.vk.ru/method/photos.getById) [photos.save](https://dev.vk.ru/method/photos.save)

## <a id="5.76"></a>[5.76](https://dev.vk.ru/ru/reference/version/5.76)

- Прекращена поддержка ответов в XML-формате.

## <a id="5.75"></a>[5.75](https://dev.vk.ru/ru/reference/version/5.75)

- Добавлен [новый формат](https://dev.vk.ru/ru/reference/objects/stats-format) ответа в методе [`stats.get`](https://dev.vk.ru/ru/stats.get).
- В настройках Callback-сервера и Long Poll API появилась возможность указывать версию API. От нее зависит формат получаемых событий.

Влияет на методы: [stats.get](https://dev.vk.ru/method/stats.get)

## <a id="5.74"></a>[5.74](https://dev.vk.ru/ru/reference/version/5.74)

- Добавлен новый формат [стикеров](objects/sticker.md).
- Метод с [`docs.search`](https://dev.vk.ru/ru/docs.search) с параметром `search_own` теперь не возвращает массив `local`. Вместо этого в `items` сначала возвращаются документы пользователя, а потом документы из глобального поиска.
- Добавлена новая ошибка: [`Ошибка 29: Rate limit reached`](errors.md)

Влияет на методы: [wall.getComments](https://dev.vk.ru/method/wall.getComments) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory)

## <a id="5.73"></a>[5.73](https://dev.vk.ru/ru/reference/version/5.73)

- В объекте [`post`](objects/post.md) возвращается поле `access_key`.

## <a id="5.71"></a>[5.71](https://dev.vk.ru/ru/reference/version/5.71)

- Метод [`groups.getBanned`](https://dev.vk.ru/ru/groups.getBanned) возвращает информацию о сообществах из чёрного списка.

Влияет на методы: [groups.getBanned](https://dev.vk.ru/method/groups.getBanned)

## <a id="5.70"></a>[5.70](https://dev.vk.ru/ru/reference/version/5.70)

- В поле `action` объекта [сообщения](objects/message.md) может возвращаться значение `chat_invite_user_by_link`.
- В объекте [сообщения](objects/message.md) добавлено поле `update_time`.
- Методы [`wall.post`](https://dev.vk.ru/ru/wall.post), [`wall.editAdsStealth`](https://dev.vk.ru/ru/wall.editAdsStealth), [`wall.edit`](https://dev.vk.ru/ru/wall.edit), [`wall.repost`](https://dev.vk.ru/ru/wall.repost) могут возвращать новую ошибку `224` — превышен лимит рекламных записей.
- В Callback API добавлено новое событие — `message_edit`.

Влияет на методы: [wall.post](https://dev.vk.ru/method/wall.post) [wall.editAdsStealth](https://dev.vk.ru/method/wall.editAdsStealth) [wall.edit](https://dev.vk.ru/method/wall.edit) [wall.repost](https://dev.vk.ru/method/wall.repost) [groups.getCallbackSettings](https://dev.vk.ru/method/groups.getCallbackSettings) [groups.setCallbackSettings](https://dev.vk.ru/method/groups.setCallbackSettings)

## <a id="5.69"></a>[5.69](https://dev.vk.ru/ru/reference/version/5.69)

- Метод [`messages.getLongPollHistory`](https://dev.vk.ru/ru/messages.getLongPollHistory) возвращает информацию о сообществах в отдельном массиве `groups`.
- Методы [`newsfeed.search`](https://dev.vk.ru/ru/newsfeed.search) и [`search.getHints`](https://dev.vk.ru/ru/search.getHints) возвращают в ответе поле `suggested_queries` с подсказками для поиска.
- Метод [`messages.send`](https://dev.vk.ru/ru/messages.send) может вернуть новые ошибки `913` и `921`.
- Метод [`friends.getRequests`](https://dev.vk.ru/ru/friends.getRequests) возвращает новое поле `count_unread`.
- Метод [`search.getHints`](https://dev.vk.ru/ru/search.getHints) принимает новый параметр `offset`.
- В объекте [пользователя](objects/user.md) и [сообщества](objects/group.md) может возвращаться дополнительное поле `trending` («огонёк»).
- В поле `action` объекта [сообщения](objects/message.md) могут возвращаться значения `chat_pin_message`, `chat_unpin_message`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события — добавление пользователя в черный список и удаление из него, `user_block` и `user_unblock`.

## <a id="5.68"></a>[5.68](https://dev.vk.ru/ru/reference/version/5.68)

- В объекте [записи на стене](objects/post.md) добавлено поле `groups_can_post` с информацией о том, могут ли сообщества комментировать запись.
- Метод [`messages.send`](https://dev.vk.ru/ru/messages.send) возвращает массив статусов отправки при использовании параметра `user_ids` и вызове с ключом доступа сообщества.
- Методы [`groups.getCallbackServerSettings`](https://dev.vk.ru/ru/groups.getCallbackServerSettings), `groups.setCallbackServerSettings` и `groups.setCallbackServer` устарели.
- В методах [`groups.setCallbackSettings`](https://dev.vk.ru/ru/groups.setCallbackSettings), [`groups.getCallbackSettings`](https://dev.vk.ru/ru/groups.getCallbackSettings) добавлен параметр `server_id`.

Влияет на методы: [messages.send](https://dev.vk.ru/method/messages.send) [groups.getCallbackServerSettings](https://dev.vk.ru/method/groups.getCallbackServerSettings)

## <a id="5.67"></a>[5.67](https://dev.vk.ru/ru/reference/version/5.67)

- В метод `wall.createComment` добавлен новый параметр `from_group`. Он позволяет указать идентификатор сообщества, от лица которого будет опубликован комментарий.
- Метод `messages.getChat` не добавляет в возвращаемые объекты [`chat`](objects/chat.md) поле `users`, если оно пустое.

Влияет на методы: [wall.createComment](https://dev.vk.ru/method/wall.createComment) [messages.getChat](https://dev.vk.ru/method/messages.getChat)

## <a id="5.66"></a>[5.66](https://dev.vk.ru/ru/reference/version/5.66)

В метод `auth.signup` добавлен обязательный параметр `birthday`.

## <a id="5.65"></a>[5.65](https://dev.vk.ru/ru/reference/version/5.65)

- В метод `auth.restore` добавлен обязательный параметр `last_name`.
- В метод `messages.getLongPollServer` добавлен параметр `lp_version`.
- Метод `ads.getCategories` возвращает результат в новом формате.
- Метод `wall.edit` больше нельзя использовать для редактирования рекламной записи, вместо него нужно использовать метод `wall.editAdsStealth`.
- Методы `audio.getAlbums`, `audio.addAlbum`, `audio.editAlbum`, `audio.deleteAlbum` и `audio.moveToAlbum` устарели.

Влияет на методы: [audio.addAlbum](https://dev.vk.ru/method/audio.addAlbum) [audio.editAlbum](https://dev.vk.ru/method/audio.editAlbum) [audio.deleteAlbum](https://dev.vk.ru/method/audio.deleteAlbum) [messages.getLongPollServer](https://dev.vk.ru/method/messages.getLongPollServer)

## <a id="5.64"></a>[5.64](https://dev.vk.ru/ru/reference/version/5.64)

- В ответ метода `messages.getDialogs` добавлены поля `unanswered` и `important`. Они используются в объектах, описывающих сообщения сообществ.
- В ответ метода `groups.getCallbackSettings` добавлено поле `wall_repost`, которое содержит информацию о настройках уведомления о репосте.
- Метод `video.save` возвращает ошибку `15`, если в вызове указан параметр `wallpost = 1`, и приложение не запрашивало права доступа **wall**.

Влияет на методы: [groups.getCallbackSettings](https://dev.vk.ru/method/groups.getCallbackSettings) [video.save](https://dev.vk.ru/method/video.save)

## <a id="5.63"></a>[5.63](https://dev.vk.ru/ru/reference/version/5.63)

- В объекты, описывающие [запись на стене](objects/post.md), добавлено поле `views`, которое содержит количество просмотров записи.
- В методы `wall.getComments` и `video.getComments` добавлен параметр `fields`.
- Метод `utils.getShortLink` возвращает новый тип объекта, описывающего ссылку. Этот объект содержит следующие поля:



  - `access_key` — ключ для доступа к приватной статистике ссылки.
  - `key` — содержательная часть ссылки, то есть та, что идёт после "vk.cc".
  - `url` — оригинальный URL.

Влияет на методы: [wall.getComments](https://dev.vk.ru/method/wall.getComments) [video.getComments](https://dev.vk.ru/method/video.getComments) [utils.getShortLink](https://dev.vk.ru/method/utils.getShortLink) [likes.getList](https://dev.vk.ru/method/likes.getList) [wall.get](https://dev.vk.ru/method/wall.get)

## <a id="5.62"></a>[5.62](https://dev.vk.ru/ru/reference/version/5.62)

- Метод `messages.getHistoryAttachments` возвращает поле `message_id` для вложений.
- Добавлено новое значение семейного положения `8 — «в гражданском браке»` в объекты, [описывающие пользователей](objects/user.md).

Влияет на методы: [messages.getHistoryAttachments](https://dev.vk.ru/method/messages.getHistoryAttachments) [users.get](https://dev.vk.ru/method/users.get) [ads.createAds](https://dev.vk.ru/method/ads.createAds)

## <a id="5.61"></a>[5.61](https://dev.vk.ru/ru/reference/version/5.61)

- В объектах, [описывающих сообщества](objects/group.md) появилось новое поле `cover`.
- Параметр `filter` метода `account.getCounters` может принимать новое значение `friends_suggestions`.
- Метод `pages.get` теперь выполняет проверку на наличие прав администратора при использовании параметра `need_source`.

Влияет на методы: [groups.get](https://dev.vk.ru/method/groups.get) [groups.getById](https://dev.vk.ru/method/groups.getById) [pages.get](https://dev.vk.ru/method/pages.get)

## <a id="5.60"></a>[5.60](https://dev.vk.ru/ru/reference/version/5.60)

- Метод `account.getInfo` возвращает поле `2fa_required` для аккаунтов с включенной двухфакторной аутентификацией.
- В метод `photos.get` добавлено ограничение на значение параметра `feed`: не более месяца с текущей даты.
- Изменение в методах `wall.getById`, `wall.get` и `newsfeed.get`: в медиаложениях вида [`link`](objects/link.md) поле `button` содержит объект [нового формата](objects/button.md).

Влияет на методы: [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.get](https://dev.vk.ru/method/wall.get) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [photos.get](https://dev.vk.ru/method/photos.get)

## <a id="5.59"></a>[5.59](https://dev.vk.ru/ru/reference/version/5.59)

Обновлены требования к размерам изображений в рекламных объявлениях. [Подробности](https://dev.vk.ru/ru/method/ads.getUploadURL).

Влияет на методы: [ads.createAds](https://dev.vk.ru/method/ads.createAds) [ads.getUploadURL](https://dev.vk.ru/method/ads.getUploadURL) [ads.updateAds](https://dev.vk.ru/method/ads.updateAds)

## <a id="5.58"></a>[5.58](https://dev.vk.ru/ru/reference/version/5.58)

- В возвращаемых объектах, описывающих [сообщества](objects/group.md), появилось новое поле `is_messages_blocked`.
- В [Callback API](../api/callback/getting-started.md) добавлены новые события: `message_allow` и `message_deny`. Метод [`groups.setCallbackSettings`](../method/groups.setCallbackSettings.md) принимает два новых параметра, а метод [`groups.getCallbackSettings`](../method/groups.getCallbackSettings.md) возвращает два новых поля, соответственно.

Влияет на методы: [groups.setCallbackSettings](https://dev.vk.ru/method/groups.setCallbackSettings) [groups.getCallbackSettings](https://dev.vk.ru/method/groups.getCallbackSettings) [groups.get](https://dev.vk.ru/method/groups.get) [groups.getById](https://dev.vk.ru/method/groups.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.getBanned](https://dev.vk.ru/method/newsfeed.getBanned) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [newsfeed.getSuggestedSources](https://dev.vk.ru/method/newsfeed.getSuggestedSources) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.get](https://dev.vk.ru/method/video.get) [video.search](https://dev.vk.ru/method/video.search) [video.getUserVideos](https://dev.vk.ru/method/video.getUserVideos) [video.getComments](https://dev.vk.ru/method/video.getComments) [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById)

## <a id="5.57"></a>[5.57](https://dev.vk.ru/ru/reference/version/5.57)

В возвращаемом объекте `app`, [описывающем приложение](https://dev.vk.ru/ru/reference/objects/app), изменились названия полей и размеры изображений иконок и баннеров.

Влияет на методы: [apps.get](https://dev.vk.ru/method/apps.get) [apps.getCatalog](https://dev.vk.ru/method/apps.getCatalog)

## <a id="5.56"></a>[5.56](https://dev.vk.ru/ru/reference/version/5.56)

Делать запросы к api.vk.com, начиная с этой версии, можно только по протоколу HTTPS. [Подробности перехода на поддержку HTTPS](https://vk.ru/away.php?to=https%3A%2F%2Fvk.com%2Fdev%2Fhttps_only).

## <a id="5.54"></a>[5.54](https://dev.vk.ru/ru/reference/version/5.54)

Если в параметрах вызова метода не была указана дата окончания, возвращаемые объекты, которые описывают [сообщество](objects/group.md), теперь не содержат поле `finish_data`. Ранее это поле присутствовало в ответе и содержало по умолчанию, равное `start_date` + 2 часа.

Влияет на методы: [groups.getById](https://dev.vk.ru/method/groups.getById) [groups.get](https://dev.vk.ru/method/groups.get) [groups.search](https://dev.vk.ru/method/groups.search) [users.getSubscriptions](https://dev.vk.ru/method/users.getSubscriptions) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.getBanned](https://dev.vk.ru/method/newsfeed.getBanned) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [newsfeed.getSuggestedSources](https://dev.vk.ru/method/newsfeed.getSuggestedSources) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.get](https://dev.vk.ru/method/video.get) [video.search](https://dev.vk.ru/method/video.search) [video.getUserVideos](https://dev.vk.ru/method/video.getUserVideos) [video.getComments](https://dev.vk.ru/method/video.getComments) [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById)

## <a id="5.53"></a>[5.53](https://dev.vk.ru/ru/reference/version/5.53)

В объектах, [описывающих сообщества](objects/group.md), следующие поля возвращаются только запросами с передачей `access_token`:

- `can_message`
- `ban_info`
- `can_post`
- `can_upload_doc`
- `can_upload_video`
- `can_see_all_posts`
- `can_create_topic`
- `is_favorite`
- `is_hidden_from_feed`

Влияет на методы: [groups.getById](https://dev.vk.ru/method/groups.getById) [groups.get](https://dev.vk.ru/method/groups.get) [groups.search](https://dev.vk.ru/method/groups.search) [users.getSubscriptions](https://dev.vk.ru/method/users.getSubscriptions) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.getBanned](https://dev.vk.ru/method/newsfeed.getBanned) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [newsfeed.getSuggestedSources](https://dev.vk.ru/method/newsfeed.getSuggestedSources) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.get](https://dev.vk.ru/method/video.get) [video.search](https://dev.vk.ru/method/video.search) [video.getUserVideos](https://dev.vk.ru/method/video.getUserVideos) [video.getComments](https://dev.vk.ru/method/video.getComments) [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById)

## <a id="5.52"></a>[5.52](https://dev.vk.ru/ru/reference/version/5.52)

Методы, возвращающие информацию о медиавложениях [сообщений](objects/attachments-message.md) и [записей](objects/attachments-wall.md), теперь также возвращают медиавложения типов [`market`](https://dev.vk.ru/ru/reference/objects/attachments-message#%D0%A2%D0%BE%D0%B2%D0%B0%D1%80%20(type%20=%20market)) и [`market_album`](https://dev.vk.ru/ru/reference/objects/attachments-message#%D0%9F%D0%BE%D0%B4%D0%B1%D0%BE%D1%80%D0%BA%D0%B0%20%D1%82%D0%BE%D0%B2%D0%B0%D1%80%D0%BE%D0%B2%20(type%20=%20market_album)).

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getComments](https://dev.vk.ru/method/wall.getComments) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.search](https://dev.vk.ru/method/messages.search)

## <a id="5.50"></a>[5.50](https://dev.vk.ru/ru/reference/version/5.50)

- Изменения в методе [ads.getAds](https://dev.vk.ru/ru/ads.getAds):



  - Возвращаемое поле `impressions_limit` заменено двумя полями: `impressions_limit` и `impressions_limited`.
  - Изменено возвращаемое поле `ad_platform`.
  - Возвращаемое поле `disclaimer` заменено полями `disclaimer_medical`, `disclaimer_specialist`, `disclaimer_supplements`.
- Изменения в методах [ads.createAds](https://dev.vk.ru/ru/ads.createAds) и [ads.updateAds](https://dev.vk.ru/ru/ads.updateAds):



  - Параметр `impressions_limit` в `ad_specification` заменён двумя параметрами: `impressions_limit` и `impressions_limited`.
  - Изменён параметр `ad_specification.ad_platform`.
  - Поле `disclaimer` в `ad_specification` заменено на поля `disclaimer_medical`, `disclaimer_specialist`, `disclaimer_supplements`.
- Параметр `ad_specification.ad_format` метода [ads.createAds](https://dev.vk.ru/ru/ads.createAds) стал обязательным.
- Параметр `ad_format` метода [ads.getUploadURL](https://dev.vk.ru/ru/ads.getUploadURL) стал обязательным.

Влияет на методы: [ads.getAds](https://dev.vk.ru/method/ads.getAds) [ads.createAds](https://dev.vk.ru/method/ads.createAds) [ads.updateAds](https://dev.vk.ru/method/ads.updateAds) [ads.getUploadURL](https://dev.vk.ru/method/ads.getUploadURL)

## <a id="5.49"></a>[5.49](https://dev.vk.ru/ru/reference/version/5.49)

Метод `account.setInfo` теперь принимает универсальные параметры `name` и `value` вместо раздельных параметров.

## <a id="5.48"></a>[5.48](https://dev.vk.ru/ru/reference/version/5.48)

- Метод `messages.getHistory` принимает параметр `rev` вместе с `start_message_id` равный `0`.
- Метод `friends.edit` возвращает ошибку `"Code: 100, Message: invalid list_ids"`, если указан неправильный `list_ids`.

Влияет на методы: [messages.getHistory](https://dev.vk.ru/method/messages.getHistory)

## <a id="5.46"></a>[5.46](https://dev.vk.ru/ru/reference/version/5.46)

- Методы `messages.send` и `messages.sendSticker` теперь используют параметр `random_id` вместо `guid`.
- Метод `account.getPushSettings` возвращает поле `peer_id` вместо параметров `chat_id` и `user_id`.
- Метод `account.setSilenceMode` принимает параметр `peer_id` вместо параметров `chat_id` и `user_id`.
- Метод `messages.getHistoryAttachments` возвращает товары, записи со стены и комментарии в виде ссылок.

Влияет на методы: [messages.send](https://dev.vk.ru/method/messages.send) [messages.getHistoryAttachments](https://dev.vk.ru/method/messages.getHistoryAttachments)

## <a id="5.45"></a>[5.45](https://dev.vk.ru/ru/reference/version/5.45)

В объекты, [описывающие медиавложения](objects/attachments-message.md) с типом `link` в сообщениях, добавлены новые поля:

- `caption`
- `is_external`
- `product`
- `application`
- `rating`
- `button`

Влияет на методы: [messages.getHistoryAttachments](https://dev.vk.ru/method/messages.getHistoryAttachments) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.search](https://dev.vk.ru/method/messages.search)

## <a id="5.44"></a>[5.44](https://dev.vk.ru/ru/reference/version/5.44)

- Методы `docs.get`, `docs.getById` возвращают поле `preview` вместо полей `photo_100` и `photo_130`.
- Метод `messages.searchDialogs` возвращает сообщества в результате поиска.

Влияет на методы: [docs.get](https://dev.vk.ru/method/docs.get) [docs.getById](https://dev.vk.ru/method/docs.getById)

## <a id="5.43"></a>[5.43](https://dev.vk.ru/ru/reference/version/5.43)

- В методе `messages.get` введены ограничения на параметры `out`, `time_offset`, `filters`. Теперь их значения могут быть только положительными числами.
- В методе `messages.getById` параметр `message_ids` стал обязательным.

Влияет на методы: [messages.getById](https://dev.vk.ru/method/messages.getById)

## <a id="5.42"></a>[5.42](https://dev.vk.ru/ru/reference/version/5.42)

- Метод `gifts.get` может вернуть отрицательный `from_id`.
- Метод `notifications.get` возвращает уведомления об упоминаниях в описаниях фотографий.

Влияет на методы: [gifts.get](https://dev.vk.ru/method/gifts.get) [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.41"></a>[5.41](https://dev.vk.ru/ru/reference/version/5.41)

- Метод `notifications.get` возвращает уведомления о новых ответах к комментариям в товарах.
- Метод `newsfeed.getComments` возвращает комментарии к товарам.
- Методы `wall.get`, `wall.search` и `wall.getById` теперь возвращают объекты [`market_album`](https://dev.vk.ru/ru/reference/objects/market-album) в [медиавложениях](objects/attachments-message.md).

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById)

## <a id="5.40"></a>[5.40](https://dev.vk.ru/ru/reference/version/5.40)

Добавлена поддержка параметра `fields` для профилей.

Влияет на методы: [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search)

## <a id="5.39"></a>[5.39](https://dev.vk.ru/ru/reference/version/5.39)

Методы, возвращающие информацию о [медиавложениях](objects/attachments-wall.md) с типом `link`, теперь возвращают поля `caption`, `is_external`, `product`, `application`, `rating` и `button`.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getComments](https://dev.vk.ru/method/wall.getComments)

## <a id="5.38"></a>[5.38](https://dev.vk.ru/ru/reference/version/5.38)

- Методы `apps.get` и `apps.getCatalog` возвращают объект [photo](objects/photo.md) для полей `screenshots`.
- В ответы методов `messages.getDialogs` и `messages.getHistory` добавлены поля `in_read` и `out_read`.
- В методы `messages.send`, `messages.sendSticker`, `messages.deleteDialog`, `messages.setActivity` и `messages.getHistory` добавлен параметр `peer_id`.

Влияет на методы: [messages.send](https://dev.vk.ru/method/messages.send) [messages.deleteDialog](https://dev.vk.ru/method/messages.deleteDialog) [messages.setActivity](https://dev.vk.ru/method/messages.setActivity) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [apps.get](https://dev.vk.ru/method/apps.get) [apps.getCatalog](https://dev.vk.ru/method/apps.getCatalog)

## <a id="5.37"></a>[5.37](https://dev.vk.ru/ru/reference/version/5.37)

Для [медиавложений](objects/attachments-wall.md) типа `link` вместо полей `image_src` и `image_big` возвращается объект [`photo`](objects/photo.md).

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.search](https://dev.vk.ru/method/wall.search) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getComments](https://dev.vk.ru/method/wall.getComments)

## <a id="5.36"></a>[5.36](https://dev.vk.ru/ru/reference/version/5.36)

- В метод `apps.get` добавлены параметры `app_ids`, `return_friends`.
- В объект [`app`](https://dev.vk.ru/ru/reference/objects/app), который описывает приложения и который метод `apps.get` возвращает, добавлены поля `installed` и `screenshots`.

Влияет на методы: [apps.get](https://dev.vk.ru/method/apps.get)

## <a id="5.35"></a>[5.35](https://dev.vk.ru/ru/reference/version/5.35)

Добавлены методы для работы с активностями приложений.

## <a id="5.34"></a>[5.34](https://dev.vk.ru/ru/reference/version/5.34)

Теперь метод `video.getComments` возвращает ошибку при запросе комментариев к видео, если доступ к этим комментариям ограничен.

Влияет на методы: [video.getComments](https://dev.vk.ru/method/video.getComments)

## <a id="5.33"></a>[5.33](https://dev.vk.ru/ru/reference/version/5.33)

В методы, возвращающие комментарии, добавлен параметр `start_comment_id`, который указывает начальный комментарий для возврата.

Влияет на методы: [wall.getComments](https://dev.vk.ru/method/wall.getComments) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.getComments](https://dev.vk.ru/method/video.getComments) [board.getComments](https://dev.vk.ru/method/board.getComments)

## <a id="5.32"></a>[5.32](https://dev.vk.ru/ru/reference/version/5.32)

Объект [приватности](../api/privacy.md) теперь поддерживает возможное значение `friends_of_friends_only`.

## <a id="5.31"></a>[5.31](https://dev.vk.ru/ru/reference/version/5.31)

Параметр `device_id` является обязательным. Изменён формат настроек приватности.

## <a id="5.30"></a>[5.30](https://dev.vk.ru/ru/reference/version/5.30)

Изменён формат данных, [описывающих приватность](../api/privacy.md).

Влияет на методы: [photos.createAlbum](https://dev.vk.ru/method/photos.createAlbum) [photos.editAlbum](https://dev.vk.ru/method/photos.editAlbum) [photos.getAlbums](https://dev.vk.ru/method/photos.getAlbums) [video.get](https://dev.vk.ru/method/video.get) [video.edit](https://dev.vk.ru/method/video.edit) [video.getAlbums](https://dev.vk.ru/method/video.getAlbums) [video.getAlbumById](https://dev.vk.ru/method/video.getAlbumById) [video.getAlbumsByVideo](https://dev.vk.ru/method/video.getAlbumsByVideo) [video.addAlbum](https://dev.vk.ru/method/video.addAlbum) [video.editAlbum](https://dev.vk.ru/method/video.editAlbum) [video.save](https://dev.vk.ru/method/video.save) [notes.add](https://dev.vk.ru/method/notes.add) [notes.edit](https://dev.vk.ru/method/notes.edit) [notes.get](https://dev.vk.ru/method/notes.get) [notes.getById](https://dev.vk.ru/method/notes.getById)

## <a id="5.29"></a>[5.29](https://dev.vk.ru/ru/reference/version/5.29)

В метод `messages.getLongPollHistory` добавлен параметр `fields`.

Влияет на методы: [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory)

## <a id="5.28"></a>[5.28](https://dev.vk.ru/ru/reference/version/5.28)

Изменён формат результата метода `friends.delete`.

## <a id="5.27"></a>[5.27](https://dev.vk.ru/ru/reference/version/5.27)

В метод `notifications.get` добавлен новый параметры `start_from`. В возвращаемый методом объект добавлено поле `next_from`.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.26"></a>[5.26](https://dev.vk.ru/ru/reference/version/5.26)

Метод `newsfeed.getSuggestedSources` теперь возвращает результат в виде списка.

Влияет на методы: [newsfeed.getSuggestedSources](https://dev.vk.ru/method/newsfeed.getSuggestedSources)

## <a id="5.24"></a>[5.24](https://dev.vk.ru/ru/reference/version/5.24)

Изменения в методе `notifications.get`. Возвращаемое поле `items.type` может иметь новое значение `wall_publish`, которое означает, что предложенная запись размещена на стене.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.23"></a>[5.23](https://dev.vk.ru/ru/reference/version/5.23)

- При использовании параметра 'photo\_sizes' метод `photos.saveOwnerPhoto` вернёт ссылки на все размеры фотографии.
- Метод `newsfeed.getComments` поддерживает параметр `last_comments_count`, который указывает какое количество комментариев к записям нужно вернуть.
- Параметр `filter` метода `groups.getMembers` теперь поддерживает значение `unsure`. Его можно использовать для получения информации о возможных участниках мероприятия, то есть тех, кто выбрал «Возможно пойду».

Влияет на методы: [photos.saveOwnerPhoto](https://dev.vk.ru/method/photos.saveOwnerPhoto) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [groups.getMembers](https://dev.vk.ru/method/groups.getMembers)

## <a id="5.22"></a>[5.22](https://dev.vk.ru/ru/reference/version/5.22)

Убрано ошибочное разделение параметра `schools` на два. В запросах теперь снова используется один параметр `schools`. Список идентификаторов для этого параметра следует получать с помощью метода [`ads.getSuggestions`](https://dev.vk.ru/ru/method/ads.getSuggestions).

Влияет на методы: [ads.createAds](https://dev.vk.ru/method/ads.createAds) [ads.updateAds](https://dev.vk.ru/method/ads.updateAds) [ads.getAdsTargeting](https://dev.vk.ru/method/ads.getAdsTargeting) [ads.getTargetingStats](https://dev.vk.ru/method/ads.getTargetingStats)

## <a id="5.21"></a>[5.21](https://dev.vk.ru/ru/reference/version/5.21)

Поле `uid` в ответе метода `video.getTags` заменено на `user_id`.

Влияет на методы: [video.getTags](https://dev.vk.ru/method/video.getTags)

## <a id="5.20"></a>[5.20](https://dev.vk.ru/ru/reference/version/5.20)

- Информация о вики-странице, [вложенной](objects/attachments-wall.md#%D0%92%D0%B8%D0%BA%D0%B8-%D1%81%D1%82%D1%80%D0%B0%D0%BD%D0%B8%D1%86%D0%B0%20%28type%20%3D%20page%29) в [пост](objects/post.md), теперь возвращает в виде [объекта вики-страницы](https://dev.vk.ru/ru/reference/objects/wiki-page).
- В метод `pages.get` добавлен параметр `need_source`. Кроме того, по умолчанию метод больше не возвращает поле `source`.

Влияет на методы: [pages.get](https://dev.vk.ru/method/pages.get) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [notifications.get](https://dev.vk.ru/method/notifications.get) [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getReposts](https://dev.vk.ru/method/wall.getReposts)

## <a id="5.19"></a>[5.19](https://dev.vk.ru/ru/reference/version/5.19)

- В объекте, описывающем [сообщество](objects/group.md), изменился тип полей `start_date` и `finish_date` со строкового на числовой.
- Методы, работающие с новостями, при установленном фильтре `friend` возвращают поле `user_id` вместо `uid`.
- В методе `fave.getLinks` изображения возвращаются в полях `photo_50` и `photo_100` вместо `image_src` и `image_middle`.

Влияет на методы: [groups.getById](https://dev.vk.ru/method/groups.getById) [groups.get](https://dev.vk.ru/method/groups.get) [groups.search](https://dev.vk.ru/method/groups.search) [groups.getInvites](https://dev.vk.ru/method/groups.getInvites) [newsfeed.getSuggestedSources](https://dev.vk.ru/method/newsfeed.getSuggestedSources) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getReposts](https://dev.vk.ru/method/wall.getReposts) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [fave.getLinks](https://dev.vk.ru/method/fave.getLinks)

## <a id="5.18"></a>[5.18](https://dev.vk.ru/ru/reference/version/5.18)

Заменены возвращаемые переменные: `reply_to_uid` на `reply_to_user`, `reply_to_cid` на `reply_to_comment`.

Влияет на методы: [widgets.getComments](https://dev.vk.ru/method/widgets.getComments) [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.17"></a>[5.17](https://dev.vk.ru/ru/reference/version/5.17)

Новые возможные значения в поле `items.type`, которое возвращает метод `notifications.get`: `mention_comment_photo` и `mention_comment_video`.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.16"></a>[5.16](https://dev.vk.ru/ru/reference/version/5.16)

Параметр `schools` разделён на два: `schools` и `universities`. Теперь `id` этих объектов такие же, как и в методах `database`.

Влияет на методы: [ads.createAds](https://dev.vk.ru/method/ads.createAds) [ads.updateAds](https://dev.vk.ru/method/ads.updateAds) [ads.getAdsTargeting](https://dev.vk.ru/method/ads.getAdsTargeting) [ads.getTargetingStats](https://dev.vk.ru/method/ads.getTargetingStats)

## <a id="5.15"></a>[5.15](https://dev.vk.ru/ru/reference/version/5.15)

- В метод `newsfeed.search` добавлен параметр `extended`, при передаче которого возвращаются полные результаты со всеми необходимыми для вывода данными о сообществах и пользователях.
- В методе `friends.areFriends` изменён алгоритм генерации поля `sign`. Теперь он учитывает `id` пользователя.
- Объекты в массиве `notes`, который возвращают методы `newsfeed.get` и `newsfeed.getRecommeded`, теперь содержат поля `id` и `comments`.

Влияет на методы: [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [friends.areFriends](https://dev.vk.ru/method/friends.areFriends) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended)

## <a id="5.14"></a>[5.14](https://dev.vk.ru/ru/reference/version/5.14)

- В метод `messages.getDialogs` добавлен параметр `unread`. Если он использован в вызове, метод вернёт информацию о диалогах с непрочитанными входящими сообщениями. Возвращаемый объект будет содержать поле `unread_dialogs`, которое указывает количество таких диалогов (если оно больше нуля). Для каждого диалога будет возвращено поле `unread`, которое содержит количество непрочитанных входящих сообщений (если оно больше нуля).
- Изменения в методе `messages.getHistory`.



  - Параметр `rev` игнорируется, если в вызове используется `start_message_id`.
  - Значение параметра `start_message_id` и его связь с `offset` изменены.
  - Если `start_message_id` больше нуля, то в возвращаемое значение будет добавлено поле `unread`, которое указывает количество непрочитанных входящих сообщений (если оно больше нуля), а также поле `skipped`, которое содержит количество пропущенных сообщений (если оно больше нуля).

Влияет на методы: [messages.getHistory](https://dev.vk.ru/method/messages.getHistory)

## <a id="5.13"></a>[5.13](https://dev.vk.ru/ru/reference/version/5.13)

Методы `newsfeed.getComments`, `newsfeed.get`, `newsfeed.getRecommended` и `newsfeed.search` используют пару значений `start_from`-`next_from` для постраничного вывода элементов.

- `start_from` — параметр вызова, который указывает начало диапазона возвращаемых элементов.
- `next_from` — значение, которое приходит в результатах вызова метода и которое обозначает начало следующего диапазона.

Для постраничного вывода надо передать значение `next_from` из предыдущего вызова в параметр `start_from` в последующем вызове.

Влияет на методы: [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search)

## <a id="5.12"></a>[5.12](https://dev.vk.ru/ru/reference/version/5.12)

- Методы `audio.get` и `video.get` возвращают более подробную информацию об ошибках.

Влияет на методы: [video.get](https://dev.vk.ru/method/video.get)

## <a id="5.11"></a>[5.11](https://dev.vk.ru/ru/reference/version/5.11)

В случае успешной смены имени метод `account.saveProfileInfo` возвращает поле `name_request`, которое содержит объект, описывающий замену. Поле `status` этого объекта равно `success`.

## <a id="5.10"></a>[5.10](https://dev.vk.ru/ru/reference/version/5.10)

- В методе `messages.get` для параметра `filters` разрешены только значения `0` (все входящие или все исходящие сообщения, по полю `out`) и `8` (важные сообщения), остальные значения игнорируются.
- Метод `messages.markAsNew` больше не поддерживается.

## <a id="5.9"></a>[5.9](https://dev.vk.ru/ru/reference/version/5.9)

- В методе `newsfeed.getComments` поле `cid` было переименовано в `id`.
- Метод `notifications.get` возвращает объект `video` в новом формате.
- Метод `friends.getLists` возвращает список в виде объекта с полем `count`, а поле `list_id` в ответе заменено на `id`.
- Метод `board.getTopics` возвращает информацию об опросах в новом формате.
- В объектах, которые описывают альбомы и которые возвращаются методами `audio.getAlbums` и `video.getAlbums`, поле `album_id` было заменено на `id`.
- Методы `audio.getRecommendations`, `friends.getSuggestions`, `groups.getMembers` возвращают данные в форме списка.
- В объектах заметок, которые возвращает метод `places.getCheckins`, поле `user_id` было заменено на `uid`.

Влияет на методы: [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [notifications.get](https://dev.vk.ru/method/notifications.get) [friends.getLists](https://dev.vk.ru/method/friends.getLists) [video.getAlbums](https://dev.vk.ru/method/video.getAlbums) [friends.getSuggestions](https://dev.vk.ru/method/friends.getSuggestions) [groups.getMembers](https://dev.vk.ru/method/groups.getMembers)

## <a id="5.8"></a>[5.8](https://dev.vk.ru/ru/reference/version/5.8)

Поля `city` и `country` объекта, который [описывает пользователя](objects/user.md), теперь содержат объект, а не идентификатор.

Влияет на методы: [users.get](https://dev.vk.ru/method/users.get) [users.search](https://dev.vk.ru/method/users.search) [friends.get](https://dev.vk.ru/method/friends.get)

## <a id="5.7"></a>[5.7](https://dev.vk.ru/ru/reference/version/5.7)

Переименование полей в объектах, которые включены в возвращаемый объект `copy_history`:

- `owner_id` переименовано в `to_id`.
- `reply_to` переименовано в `reply_post_id`.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get)

## <a id="5.6"></a>[5.6](https://dev.vk.ru/ru/reference/version/5.6)

Поле `post_type` в [возвращаемом объекте](objects/post.md) использует значение `post` вместо `copy` для репостов.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get)

## <a id="5.5"></a>[5.5](https://dev.vk.ru/ru/reference/version/5.5)

Для группируемых оповещений, например, когда пользователи оценили, поделились, подписались, в поле `feedback` кроме идентификаторов последних пользователей, совершивших действие, возвращается также полное количество пользователей, совершивших это действие за последние сутки.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.4"></a>[5.4](https://dev.vk.ru/ru/reference/version/5.4)

- В объекте [описывающем пользователя](objects/user.md), поля `photo` и `photo_medium_rec` переименованы в `photo_50` и `photo_100`.
- Во вложении `wall` в сообщениях поля `from` и `copy_owner` возвращают объект [пользователя](objects/user.md) или [сообщества](objects/group.md), вместо массива.

Влияет на методы: [board.getTopics](https://dev.vk.ru/method/board.getTopics) [board.getComments](https://dev.vk.ru/method/board.getComments) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [notifications.get](https://dev.vk.ru/method/notifications.get) [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.getReposts](https://dev.vk.ru/method/wall.getReposts) [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.getHistory](https://dev.vk.ru/method/messages.getHistory) [messages.search](https://dev.vk.ru/method/messages.search)

## <a id="5.3"></a>[5.3](https://dev.vk.ru/ru/reference/version/5.3)

В возвращаемом объекте, описывающем [вики-страницу](https://dev.vk.ru/ru/reference/objects/wiki-page), поле `pid` переименовано в `id`, поля `edited` и `created` имеют новый формат.

Влияет на методы: [pages.get](https://dev.vk.ru/method/pages.get)

## <a id="5.2"></a>[5.2](https://dev.vk.ru/ru/reference/version/5.2)

В возвращаемом объекте `items.feedback` поле `owner_id` заменено на `from_id`. Также, был исправлен баг со строкой в `owner_id`.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.1"></a>[5.1](https://dev.vk.ru/ru/reference/version/5.1)

- Исправлен тип прикрепления `photos_list` (было `photo_list`).
- В объектах, которые возвращает метод `video.getUserVideos`, добавлены поля `photo_160`, `photo_320`.
- В объектах, которые возвращает метод `photos.getTags` удалены устаревшие поля `uid` и `tag_id`.
- В методе `notifications.getу возвращаемых объектов, которые описывают темы, поле`tid`заменено на`id\`.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [video.getUserVideos](https://dev.vk.ru/method/video.getUserVideos) [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="5.0"></a>[5.0](https://dev.vk.ru/ru/reference/version/5.0)

Большое обновление, затрагивающее почти все методы API ВКонтакте.

**[Посмотреть список изменений](https://dev.vk.ru/ru/reference/roadmap#%D0%A1%D0%BF%D0%B8%D1%81%D0%BE%D0%BA%20%D0%B8%D0%B7%D0%BC%D0%B5%D0%BD%D0%B5%D0%BD%D0%B8%D0%B9)**

## <a id="4.104"></a>[4.104](https://dev.vk.ru/ru/reference/version/4.104)

Возвращаемые объекты, которые описывают [медиавложения](objects/attachments-wall.md), поддерживают новый тип вложений `photos_list`.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments)

## <a id="4.103"></a>[4.103](https://dev.vk.ru/ru/reference/version/4.103)

Метод `likes.isLiked` поддерживает новые формат ответа — объект с полями `liked` и `copied`.

Влияет на методы: [likes.isLiked](https://dev.vk.ru/method/likes.isLiked)

## <a id="4.102"></a>[4.102](https://dev.vk.ru/ru/reference/version/4.102)

[Возвращаемые объекты](objects/post.md) содержат информацию о репостах в новом формате. Кроме того, методы возвращают информацию о последующих репостах.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById)

## <a id="4.101"></a>[4.101](https://dev.vk.ru/ru/reference/version/4.101)

Если к записи прикреплён альбом, ссылка на альбом не передаётся в тексте записи.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get) [wall.getById](https://dev.vk.ru/method/wall.getById) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments)

## <a id="4.100"></a>[4.100](https://dev.vk.ru/ru/reference/version/4.100)

При получении сообщения о смене или удалении фотографии, диалоговое окно больше не содержит пояснение действия.

Влияет на методы: [messages.getHistory](https://dev.vk.ru/method/messages.getHistory)

## <a id="4.99"></a>[4.99](https://dev.vk.ru/ru/reference/version/4.99)

Новый метод `audio.setBroadcast` добавляет информацию об аудиозаписи в строку статуса пользователя или администрируемых им сообществ.

## <a id="4.98"></a>[4.98](https://dev.vk.ru/ru/reference/version/4.98)

Первый элемент возвращаемого массива теперь содержит число возвращаемых альбомов.

Влияет на методы: [photos.getAlbums](https://dev.vk.ru/method/photos.getAlbums)

## <a id="4.97"></a>[4.97](https://dev.vk.ru/ru/reference/version/4.97)

В возвращаемых объектах удалены поля `online` и `reply_count`.

Влияет на методы: [wall.get](https://dev.vk.ru/method/wall.get)

## <a id="4.96"></a>[4.96](https://dev.vk.ru/ru/reference/version/4.96)

Первый элемент возвращаемого массива содержит количество результатов.

Влияет на методы: [video.search](https://dev.vk.ru/method/video.search)

## <a id="4.95"></a>[4.95](https://dev.vk.ru/ru/reference/version/4.95)

- Изменён объект, [описывающий комментарии](objects/comment.md).
- Все методы возвращают информацию о комментариях в единообразной форме.

Влияет на методы: [photos.getAllComments](https://dev.vk.ru/method/photos.getAllComments) [photos.editComment](https://dev.vk.ru/method/photos.editComment) [photos.getComments](https://dev.vk.ru/method/photos.getComments) [video.editComment](https://dev.vk.ru/method/video.editComment) [video.getComments](https://dev.vk.ru/method/video.getComments) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments)

## <a id="4.94"></a>[4.94](https://dev.vk.ru/ru/reference/version/4.94)

Информация о ссылках, прикрепленных к личным сообщениям, теперь возвращается в виде [объекта](objects/attachments-message.md).

Влияет на методы: [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.search](https://dev.vk.ru/method/messages.search) [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory)

## <a id="4.93"></a>[4.93](https://dev.vk.ru/ru/reference/version/4.93)

В возвращаемом объекте поле `users` переименовано в `items`, а `uid` в `item`.

Влияет на методы: [likes.getList](https://dev.vk.ru/method/likes.getList)

## <a id="4.92"></a>[4.92](https://dev.vk.ru/ru/reference/version/4.92)

Первые элемент возвращаемого массива содержит количество возвращаемых результатов.

## <a id="4.91"></a>[4.91](https://dev.vk.ru/ru/reference/version/4.91)

Изменено значение возвращаемого поля `uid`. Теперь оно указывает отправителя сообщения.

Влияет на методы: [messages.getHistory](https://dev.vk.ru/method/messages.getHistory)

## <a id="4.9"></a>[4.9](https://dev.vk.ru/ru/reference/version/4.9)

- Изменён формат описания местоположений.
- Начиная с этой версии в ответах не будут возвращаться поля, оставленные для совместимости.

Влияет на методы: [wall.getReposts](https://dev.vk.ru/method/wall.getReposts) [wall.getById](https://dev.vk.ru/method/wall.getById) [wall.get](https://dev.vk.ru/method/wall.get) [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [newsfeed.getMentions](https://dev.vk.ru/method/newsfeed.getMentions) [newsfeed.search](https://dev.vk.ru/method/newsfeed.search) [newsfeed.get](https://dev.vk.ru/method/newsfeed.get) [newsfeed.getRecommended](https://dev.vk.ru/method/newsfeed.getRecommended)

## <a id="4.8"></a>[4.8](https://dev.vk.ru/ru/reference/version/4.8)

Ответ метода содержит информацию о подарке в виде [объекта](https://dev.vk.ru/ru/reference/objects/gift), а не документа.

Влияет на методы: [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.search](https://dev.vk.ru/method/messages.search) [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory)

## <a id="4.7"></a>[4.7](https://dev.vk.ru/ru/reference/version/4.7)

Изменяет формат описания комментариев в возвращаемых объектах, делая его аналогичным формату, используемому в других методах.

Влияет на методы: [notifications.get](https://dev.vk.ru/method/notifications.get)

## <a id="4.6"></a>[4.6](https://dev.vk.ru/ru/reference/version/4.6)

Помечает анонимные опросы полем `anonymous`, не добавляя информации к заголовкам публичных опросов.

Влияет на методы: [polls.getById](https://dev.vk.ru/method/polls.getById)

## <a id="4.5"></a>[4.5](https://dev.vk.ru/ru/reference/version/4.5)

Изменён формат результатов методов `subscriptions.get` и `subscriptions.getFollowers`. Первый элемент возвращаемого массива указывает количество возвращаемых элементов.

## <a id="4.4"></a>[4.4](https://dev.vk.ru/ru/reference/version/4.4)

Методы `newsfeed.getComments` и `wall.getComments` возвращают информацию об объектах, прикреплённых к комментариям.

Влияет на методы: [newsfeed.getComments](https://dev.vk.ru/method/newsfeed.getComments) [wall.getComments](https://dev.vk.ru/method/wall.getComments)

## <a id="4.3"></a>[4.3](https://dev.vk.ru/ru/reference/version/4.3)

Возвращает результат в виде объекта, содержащего информацию [пользователях](objects/user.md) и [сообществах](objects/group.md), необходимых для отображения найденных записей.

Влияет на методы: [newsfeed.search](https://dev.vk.ru/method/newsfeed.search)

## <a id="4.2"></a>[4.2](https://dev.vk.ru/ru/reference/version/4.2)

Изменён формат поля `chat_active` в возвращаемом объекте. Теперь оно представлено массивом, а не строкой.

Влияет на методы: [messages.getById](https://dev.vk.ru/method/messages.getById) [messages.search](https://dev.vk.ru/method/messages.search) [messages.getLongPollHistory](https://dev.vk.ru/method/messages.getLongPollHistory)

## <a id="4.1"></a>[4.1](https://dev.vk.ru/ru/reference/version/4.1)

Первый элемент возвращаемого массива содержит количество возвращаемых изображений.

Влияет на методы: [photos.get](https://dev.vk.ru/method/photos.get)

## <a id="4.0"></a>[4.0](https://dev.vk.ru/ru/reference/version/4.0)

Параметр `count` должен быть положительным числом. Параметр `offset` должен быть неотрицательным.
