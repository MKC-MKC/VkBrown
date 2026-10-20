# photos.getChatUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getChatUploadServer)

Метод получает адрес сервера для [загрузки обложки чата](https://dev.vk.ru/ru/api/upload/main-photo-in-chat).

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): messages — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): messages)

## <a id="Параметры"></a>Параметры

### chat\_id

positive

**Обязательный параметр.** Идентификатор беседы, для которой нужно загрузить фотографию.

Если вы вызываете метод с ключом доступа сообщества, этот параметр равен `peer_id` — `2000000000`. `peer_id` нужной беседы можно узнать перебором бесед с помощью метода [`messages.getConversationsById`](https://dev.vk.ru/ru/method/messages.getConversationsById) либо с помощью Callback- или Longpoll-события `message_new`.

Обязательный параметр

### crop\_x

positive

**Необязательный параметр.** Координата `x` для обрезки фотографии (правый верхний угол).

### crop\_y

positive

**Необязательный параметр.** Координата `y` для обрезки фотографии (правый верхний угол).

### crop\_width

positive

**Необязательный параметр.** Ширина фотографии после обрезки в пикселях.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить обложку чата. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c842430\/ss2085\/upload.php?_query=eyJhY3QiOiJvd25lcl9waG90byIsIm9pZCI6MjAwMDAwMDAwMSwic2F2ZSI6MSwic3F1YXJlIjoxLCJhcGlfd3JhcCI6eyJyZXNwb25zZSI6IntyZXN1bHR9In0sIm1pZCI6NzQzNzg0NDc0LCJzZXJ2ZXIiOjg0MjQzMCwiX29yaWdpbiI6Imh0dHBzOlwvXC9hcGkudmsuY29tIiwiX3NpZyI6ImM4ZjI4MTkzY2YwOGVhZTRiMDkyYzk1Yjk0ZmMyM2QxIn0"
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

chat\_id \*

crop\_x

crop\_y

crop\_width

v

5.199 (текущая)

{}
