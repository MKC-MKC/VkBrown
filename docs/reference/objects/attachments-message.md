# Медиавложения в личных сообщениях

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/attachments-message)

Информация о медиавложениях в личных сообщениях возвращается в виде массива `attachments`. Каждый элемент массива представляет собой объект с двумя полями. Первое поле — `type` (`string`) содержит тип вложения (`photo`,`video`,`audio` и т.д.). Название второго поля совпадает со значением, переданным в `type`. Второе поле содержит объект, представляющий медиавложение. Структура объекта в этом поле зависит от его типа.

Пример объекта `attachments` для двух вложений (фото и аудио):

```json
[
  {
    "type": "photo",
    "photo": <объект photo>
  },
  {
    "type": "audio",
    "audio": <объект audio>
  }
]
```

> Каждый объект может содержать дополнительное поле `access_key` — ключ доступа к контенту. [Подробнее об `access_key`](../objects.md)

## <a id="Возможные значения поля type"></a>Возможные значения поля `type`

| `type` | Объект | Ссылка на описание |
| --- | --- | --- |
| `photo` | Фотография | [/objects/photo](photo.md) |
| `video` | Видеозапись | [/objects/video](video.md) |
| `audio` | Аудиозапись | [/objects/audio](audio.md) |
| `audio_message` | Голосовое сообщение | [/objects/audio-message](https://dev.vk.ru/ru/reference/objects/audio-message) |
| `doc` | Документ | [/objects/doc](doc.md) |
| `link` | Ссылка | [/objects/link](link.md) |
| `market` | Товар | [/objects/market](https://dev.vk.ru/ru/reference/objects/market) |
| `market_album` | Подборка товаров | [/objects/photo](https://dev.vk.ru/ru/reference/objects/market_album) |
| `wall` | Запись на стене. Во вложении возвращается объект [записи на стене](post.md). Обратите внимание, вместо поля `owner_id` возвращается `to_id`. | [/objects/wall](https://dev.vk.ru/ru/reference/objects/wall) |
| `wall_reply` | Комментарий на стене. Во вложении возвращается объект [комментария на стене](comment.md) с дополнительными полями: • `post_id`(`integer`) — идентификатор записи, к которой оставлен комментарий; • `owner_id`(`integer`) — идентификатор владельца стены, на которой оставлен комментарий. | [/objects/wall\_reply](https://dev.vk.ru/ru/reference/objects/wall_reply) |
| `sticker` | Стикер | [/objects/photo](photo.md) |
| `gift-item` | Подарок | [/objects/gift-item](https://dev.vk.ru/ru/reference/objects/gift-item) |
| `call` | Звонок. Возвращается для версии 5.80 и выше. | [/objects/call](https://dev.vk.ru/ru/reference/objects/call) |
