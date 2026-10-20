# Документация VK для VkBrown

Локальный справочник из 131 сохранённой страницы VK. Описания, параметры, типы, ограничения, результаты, ошибки и примеры перенесены из webarchive в Markdown. Ссылки между сохранёнными страницами относительные. Несохранённые страницы доступны по внешним ссылкам.

## Область применения

SDK для бота сообщества: ключ сообщества, личные сообщения с сообществом, необходимые операции стены и вложений, Callback API с Confirmation, Bots Long Poll и клавиатуры. Данные пользователей и аватарки получаем тем же ключом там, где VK это разрешает. Пользовательская авторизация, Implicit Flow и работа с приложениями в объём SDK не входят; резервные способы авторизации не предусмотрены.

Начальная версия SDK - API 5.199, с возможностью добавлять отдельные версии. Сохранённые страницы могут описывать изменения других версий; перенос не меняет их содержание и не означает, что каждое поле относится к 5.199. Для проверки версионных контрактов используется [официальная схема VK](https://github.com/VKCOM/vk-api-schema).

Это справочник VK, а не список уже реализованных возможностей VkBrown. Текст всех сохранённых страниц включён, в том числе материалы вне области применения. В разделе методов пометка о ключе сообщества основана на блоке допустимых ключей самой сохранённой страницы. Она не отменяет указанные там права и ограничения.

Адреса страниц сверены с заголовками и ссылками внутри архивов: исходный адрес webarchive иногда относится к предыдущей странице. Ссылки на отсутствующие в сохранённой странице разделы оставлены внешними.

Перечень источников, контрольные суммы архивов, адреса оригиналов и соответствующие Markdown-файлы находятся в [sources.json](sources.json).

## Использование API

- [Общие сведения](api/access-token/getting-started.md)
- [Ключ доступа пользователя](api/access-token/user-token.md) - вне области SDK
- [Формат запросов](api/api-requests.md)
- [Bots Long Poll API](api/bots-long-poll/getting-started.md)
- [Взаимодействие с приложением](api/bots/development/app-interaction.md) - вне области SDK
- [Обзор](api/bots/development/keyboard.md)
- [Работа с callback-кнопками](api/bots/development/keyboard/callback-keys.md)
- [Подключение](api/bots/development/keyboard/enable-keyboard.md)
- [Типы кнопок](api/bots/development/keyboard/key-types.md)
- [Отправка сообщений](api/bots/development/messages.md)
- [Вложения в сообщениях](api/bots/development/messages/attachments.md)
- [Управление сообщениями](api/bots/development/messages/management.md)
- [Пользовательский контент и шаблоны](api/bots/development/messages/user-content.md)
- [Быстрый старт](api/bots/getting-started.md)
- [Обзор](api/bots/overview.md)
- [Callback API](api/callback/getting-started.md)
- [Ошибка с Captcha](api/captcha-error.md)
- [События в сообществах](api/community-events/json-schema.md)
- [Сообщения сообществ](api/community-messages/getting-started.md)
- [Подтверждение действия пользователем](api/confirmation-required-error.md)
- [Сообщение "Deprecated version"](api/deprecated-version-message.md)
- [События в реальном времени](api/events/overview.md)
- [Быстрый старт](api/getting-started.md)
- [Open API](api/open-api/getting-started.md) - вне области SDK
- [Обзор](api/overview.md)
- [Права доступа и приватность](api/privacy.md)
- [Загрузка изображения товара](api/upload/photo-in-market.md)
- [Загрузка фотографии в личное сообщение](api/upload/photo-in-message.md)
- [User Long Poll API](api/user-long-poll/getting-started.md) - вне области SDK
- [Валидация действия](api/validation-required-error.md)

## Справочник

- [Коды стран](reference/country-codes.md)
- [Коды Emoji](reference/emoji.md)
- [Коды ошибок](reference/errors.md)
- [JSON-схема](reference/json-schema.md)
- [Список объектов](reference/objects.md)
- [Адрес](reference/objects/address.md)
- [Медиавложения в личных сообщениях](reference/objects/attachments-message.md)
- [Медиавложения в записях на стене](reference/objects/attachments-wall.md)
- [Аудиозапись](reference/objects/audio.md)
- [Кнопка](reference/objects/button.md)
- [Чат](reference/objects/chat.md)
- [Комментарий в обсуждении](reference/objects/comment-topic.md)
- [Комментарий на стене](reference/objects/comment.md)
- [Беседа](reference/objects/conversation.md)
- [Файл](reference/objects/doc.md)
- [Граффити](reference/objects/graffiti.md)
- [Сообщество](reference/objects/group.md)
- [Прикреплённая ссылка](reference/objects/link.md)
- [Личное сообщение](reference/objects/message.md)
- [Фотография](reference/objects/photo.md)
- [Закреплённое сообщение](reference/objects/pinned-message.md)
- [Запись на стене](reference/objects/post.md)
- [Настройки приватности](reference/objects/privacy.md)
- [Стикер](reference/objects/sticker.md)
- [История](reference/objects/story.md)
- [Пользователь](reference/objects/user.md)
- [Видеозапись](reference/objects/video.md)
- [Версии API](reference/versions.md)

## Методы

- [docs.get](method/docs.get.md) - ключ сообщества не указан среди допустимых
- [docs.getById](method/docs.getById.md) - ключ сообщества разрешён
- [docs.getMessagesUploadServer](method/docs.getMessagesUploadServer.md) - ключ сообщества разрешён
- [docs.getWallUploadServer](method/docs.getWallUploadServer.md) - ключ сообщества разрешён
- [docs.save](method/docs.save.md) - ключ сообщества разрешён
- [friends.getLists](method/friends.getLists.md) - ключ сообщества не указан среди допустимых
- [groups.addAddress](method/groups.addAddress.md) - ключ сообщества разрешён
- [groups.addCallbackServer](method/groups.addCallbackServer.md) - ключ сообщества разрешён
- [groups.deleteAddress](method/groups.deleteAddress.md) - ключ сообщества разрешён
- [groups.deleteCallbackServer](method/groups.deleteCallbackServer.md) - ключ сообщества разрешён
- [groups.disableOnline](method/groups.disableOnline.md) - ключ сообщества разрешён
- [groups.editAddress](method/groups.editAddress.md) - ключ сообщества разрешён
- [groups.editCallbackServer](method/groups.editCallbackServer.md) - ключ сообщества разрешён
- [groups.enableOnline](method/groups.enableOnline.md) - ключ сообщества разрешён
- [groups.getBanned](method/groups.getBanned.md) - ключ сообщества разрешён
- [groups.getById](method/groups.getById.md) - ключ сообщества разрешён
- [groups.getCallbackConfirmationCode](method/groups.getCallbackConfirmationCode.md) - ключ сообщества разрешён
- [groups.getCallbackServers](method/groups.getCallbackServers.md) - ключ сообщества разрешён
- [groups.getCallbackSettings](method/groups.getCallbackSettings.md) - ключ сообщества разрешён
- [groups.getLongPollServer](method/groups.getLongPollServer.md) - ключ сообщества разрешён
- [groups.getLongPollSettings](method/groups.getLongPollSettings.md) - ключ сообщества разрешён
- [groups.getMembers](method/groups.getMembers.md) - ключ сообщества разрешён
- [groups.getOnlineStatus](method/groups.getOnlineStatus.md) - ключ сообщества разрешён
- [groups.getTagList](method/groups.getTagList.md) - ключ сообщества разрешён
- [groups.getTokenPermissions](method/groups.getTokenPermissions.md) - ключ сообщества разрешён
- [groups.isMember](method/groups.isMember.md) - ключ сообщества разрешён
- [Groups](method/groups.md)
- [groups.setCallbackSettings](method/groups.setCallbackSettings.md) - ключ сообщества разрешён
- [groups.setLongPollSettings](method/groups.setLongPollSettings.md) - ключ сообщества разрешён
- [groups.setSettings](method/groups.setSettings.md) - ключ сообщества разрешён
- [groups.setUserNote](method/groups.setUserNote.md) - ключ сообщества разрешён
- [groups.tagAdd](method/groups.tagAdd.md) - ключ сообщества разрешён
- [groups.tagBind](method/groups.tagBind.md) - ключ сообщества разрешён
- [groups.tagDelete](method/groups.tagDelete.md) - ключ сообщества разрешён
- [groups.tagUpdate](method/groups.tagUpdate.md) - ключ сообщества разрешён
- [market.getProductPhotoUploadServer](method/market.getProductPhotoUploadServer.md) - ключ сообщества не указан среди допустимых
- [messages.allowMessagesFromGroup](method/messages.allowMessagesFromGroup.md) - ключ сообщества не указан среди допустимых
- [messages.delete](method/messages.delete.md) - ключ сообщества разрешён
- [messages.edit](method/messages.edit.md) - ключ сообщества разрешён
- [messages.getById](method/messages.getById.md) - ключ сообщества разрешён
- [messages.getConversations](method/messages.getConversations.md) - ключ сообщества разрешён
- [messages.getHistory](method/messages.getHistory.md) - ключ сообщества разрешён
- [Messages](method/messages.md)
- [messages.send](method/messages.send.md) - ключ сообщества разрешён
- [messages.sendMessageEventAnswer](method/messages.sendMessageEventAnswer.md) - ключ сообщества разрешён
- [photos.copy](method/photos.copy.md) - ключ сообщества не указан среди допустимых
- [photos.createAlbum](method/photos.createAlbum.md) - ключ сообщества не указан среди допустимых
- [photos.createComment](method/photos.createComment.md) - ключ сообщества не указан среди допустимых
- [photos.delete](method/photos.delete.md) - ключ сообщества не указан среди допустимых
- [photos.deleteAlbum](method/photos.deleteAlbum.md) - ключ сообщества не указан среди допустимых
- [photos.deleteComment](method/photos.deleteComment.md) - ключ сообщества не указан среди допустимых
- [photos.edit](method/photos.edit.md) - ключ сообщества не указан среди допустимых
- [photos.editAlbum](method/photos.editAlbum.md) - ключ сообщества не указан среди допустимых
- [photos.editComment](method/photos.editComment.md) - ключ сообщества не указан среди допустимых
- [photos.get](method/photos.get.md) - ключ сообщества не указан среди допустимых
- [photos.getAlbums](method/photos.getAlbums.md) - ключ сообщества не указан среди допустимых
- [photos.getAlbumsCount](method/photos.getAlbumsCount.md) - ключ сообщества не указан среди допустимых
- [photos.getAll](method/photos.getAll.md) - ключ сообщества не указан среди допустимых
- [photos.getAllComments](method/photos.getAllComments.md) - ключ сообщества не указан среди допустимых
- [photos.getById](method/photos.getById.md) - ключ сообщества не указан среди допустимых
- [photos.getChatUploadServer](method/photos.getChatUploadServer.md) - ключ сообщества разрешён
- [photos.getComments](method/photos.getComments.md) - ключ сообщества не указан среди допустимых
- [photos.getMarketAlbumUploadServer](method/photos.getMarketAlbumUploadServer.md) - ключ сообщества не указан среди допустимых
- [photos.getMessagesUploadServer](method/photos.getMessagesUploadServer.md) - ключ сообщества разрешён
- [photos.getOwnerCoverPhotoUploadServer](method/photos.getOwnerCoverPhotoUploadServer.md) - ключ сообщества разрешён
- [photos.getOwnerPhotoUploadServer](method/photos.getOwnerPhotoUploadServer.md) - ключ сообщества не указан среди допустимых
- [photos.getUploadServer](method/photos.getUploadServer.md) - ключ сообщества не указан среди допустимых
- [photos.getUserPhotos](method/photos.getUserPhotos.md) - ключ сообщества не указан среди допустимых
- [photos.getWallUploadServer](method/photos.getWallUploadServer.md) - ключ сообщества не указан среди допустимых
- [photos.save](method/photos.save.md) - ключ сообщества не указан среди допустимых
- [photos.saveMessagesPhoto](method/photos.saveMessagesPhoto.md) - ключ сообщества разрешён
- [photos.search](method/photos.search.md) - ключ сообщества не указан среди допустимых
- [users.get](method/users.get.md) - ключ сообщества разрешён
