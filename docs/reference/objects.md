# Список объектов

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects)

Некоторые объекты используются сразу в целых группах методов. Ниже представлены ссылки на страницы с подробным описанием структуры таких объектов.

## <a id="Ключ доступа к данным (access_key)"></a>Ключ доступа к данным (`access_key`)

При получении объектов, прямого доступа к которым может не быть, например, фотографий или видео в новостях, вместе с объектами приходит поле `access_key`, которое необходимо передавать при получении этих объектов напрямую или при совершении с ними действий.

Например, поле `access_key` принимают методы: [`video.get`](https://dev.vk.ru/ru/method/video.get), [`photos.getById`](../method/photos.getById.md).

`access_key` нужно добавить к строковому идентификатору объекта через символ подчёркивания:

 `123456_654312_6d103522bc13b790c5`

## <a id="Основные объекты"></a>Основные объекты

| Объект | Пример использования |
| --- | --- |
| [Пользователь](objects/user.md) | [`users.get`](../method/users.get.md) |
| [Сообщество](objects/group.md) | [`groups.get`](https://dev.vk.ru/ru/method/groups.get) |
| [Запись на стене](objects/post.md) | [`wall.get`](https://dev.vk.ru/ru/method/wall.get) |
| [Комментарий на стене](objects/comment.md) | [`wall.getComments`](https://dev.vk.ru/ru/method/wall.getComments) |
| [Личное сообщение](objects/message.md) | [`messages.getById`](../method/messages.getById.md) |
| [Беседа](objects/conversation.md) | [`messages.getConversationsById`](https://dev.vk.ru/ru/method/messages.getConversationsById) |
| [Чат](objects/chat.md) | [`messages.getChat`](https://dev.vk.ru/ru/method/messages.getChat) |
| [Вики-страница](https://dev.vk.ru/ru/reference/objects/wiki-page) | [`pages.get`](https://dev.vk.ru/ru/method/pages.get) |
| [Товар](https://dev.vk.ru/ru/reference/objects/market-item) | [`market.get`](https://dev.vk.ru/ru/method/market.get) |
| [Подборка товаров](https://dev.vk.ru/ru/reference/objects/market-album) | [`market.getAlbums`](https://dev.vk.ru/ru/method/market.getAlbums) |
| [Заказ](https://dev.vk.ru/ru/reference/objects/market-order) | [`market.getOrders`](https://dev.vk.ru/ru/method/market.getOrders) |
| [Обсуждение](https://dev.vk.ru/ru/reference/objects/topic) | [`board.getTopics`](https://dev.vk.ru/ru/method/board.getTopics) |
| [Комментарий в обсуждении](objects/comment-topic.md) | [`board.getComments`](https://dev.vk.ru/ru/method/board.getComments) |
| [Приложение](https://dev.vk.ru/ru/reference/objects/app) | [`apps.get`](https://dev.vk.ru/ru/method/apps.get) |
| [Опрос](https://dev.vk.ru/ru/reference/objects/poll) | [`polls.getById`](https://dev.vk.ru/ru/method/polls.getById) |
| [Данные статистики](https://dev.vk.ru/ru/reference/objects/stats-format) | [`stats.get`](https://dev.vk.ru/ru/method/stats.get) |
| [Адрес](objects/address.md) | [`groups.getAddresses`](https://dev.vk.ru/ru/method/groups.getAddresses) |

## <a id="Медиаконтент и вложения"></a>Медиаконтент и вложения

| Объект | Пример использования |
| --- | --- |
| [Фотография](objects/photo.md) | [`photos.get`](../method/photos.get.md) |
| [Аудиозапись](objects/audio.md) | — |
| [Видеозапись](objects/video.md) | [`video.get`](https://dev.vk.ru/ru/method/video.get) |
| [Файл](objects/doc.md) | [`docs.get`](../method/docs.get.md) |
| [Медиавложения в записях на стене](objects/attachments-wall.md) | [`wall.get`](https://dev.vk.ru/ru/method/wall.get) |
| [Медиавложения в личных сообщениях](objects/attachments-message.md) | [`messages.getById`](../method/messages.getById.md) |
| [Прикрепленная ссылка](objects/link.md) | [`wall.get`](https://dev.vk.ru/ru/method/wall.get) |
| [Стикер](objects/sticker.md) | [`messages.getById`](../method/messages.getById.md) |
| [Подарок](https://dev.vk.ru/ru/reference/objects/gift-item) | [`gifts.get`](https://dev.vk.ru/ru/method/gifts.get) |
| [Геометка](https://dev.vk.ru/ru/reference/objects/geo) | [`messages.getById`](../method/messages.getById.md) |
| [Виджеты приложений сообществ](https://dev.vk.ru/ru/reference/objects/app-widget) | [`appWidgets.update`](https://dev.vk.ru/ru/method/appWidgets.update) |
| [История](objects/story.md) | [`stories.get`](https://dev.vk.ru/ru/method/stories.get) |
| [Блок ленты историй](https://dev.vk.ru/ru/reference/objects/story-feed-item) | [`stories.get`](https://dev.vk.ru/ru/method/stories.get) |
| [Кликабельный стикер в истории](https://dev.vk.ru/ru/reference/objects/clickable-sticker) | [`stories.getPhotoUploadServer`](https://dev.vk.ru/ru/method/stories.getPhotoUploadServer) |
| [Граффити](objects/graffiti.md) | — |
| [Звонок](https://dev.vk.ru/ru/reference/objects/call) | — |

## <a id="Вспомогательные объекты и наборы значений"></a>Вспомогательные объекты и наборы значений

| Объект | Пример использования |
| --- | --- |
| [Жанры аудиозаписей](https://dev.vk.ru/ru/reference/objects/audio-genres) | — |
| [Источник записи](https://dev.vk.ru/ru/reference/objects/post-source) | [`wall.getById`](https://dev.vk.ru/ru/method/wall.getById) |
| [Кнопка](objects/button.md) | — |
| [Место](https://dev.vk.ru/ru/reference/objects/place) | — |
| [Настройки приватности](objects/privacy.md) | [`photos.getAlbums`](../method/photos.getAlbums.md) |
| [Приложение из магазина](https://dev.vk.ru/ru/reference/objects/application) | — |
| [Продукт](https://dev.vk.ru/ru/reference/objects/product) | — |
| [Рейтинг продукта](https://dev.vk.ru/ru/reference/objects/rating) | — |
| [Формат описания размеров фотографии](https://dev.vk.ru/ru/reference/objects/photo-sizes) | [`photos.get`](../method/photos.get.md) |
| [Цена](https://dev.vk.ru/ru/reference/objects/price) | — |
| [Эпизод подкаста](https://dev.vk.ru/ru/reference/objects/podcast-episode) | — |
