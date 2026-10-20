# photos.getOwnerPhotoUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getOwnerPhotoUploadServer)

Метод получает адрес сервера для [загрузки главной фотографии](https://dev.vk.ru/ru/api/upload/main-photo-in-profile) на страницу пользователя или сообщества.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F)

## <a id="Параметры"></a>Параметры

### owner\_id

integer

**Необязательный параметр.** Идентификатор пользователя или сообщества. Идентификатор сообщества должен начинаться со знака `-`.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить фотографию. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c521232\/ss2215\/upload.php?_query=eyJhY3QiOiJvd25lcl9waG90byIsInNhdmUiOjEsImFwaV93cmFwIjp7InNlcnZlciI6OTk5LCJwaG90byI6IntyZXN1bHR9IiwibWlkIjo3NDM3ODQ0NzQsImhhc2giOiI3NDQ4ZjkzZjQwNWRmZDVjNDQ0ZjVkNGFhYmI4NDk0MiIsIm1lc3NhZ2VfY29kZSI6MiwicHJvZmlsZV9haWQiOi02fSwib2lkIjo3NDM3ODQ0NzQsIm1pZCI6NzQzNzg0NDc0LCJzZXJ2ZXIiOjUyMTIzMiwiX29yaWdpbiI6Imh0dHBzOlwvXC9hcGkudmsuY29tIiwiX3NpZyI6IjhhNmFhYzQ2Y2FkN2FhYTlmMTBjYTVjNzY1M2VlNjgyIn0"
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

703

You need to enable 2FA for this action

13000

Content upload was denied due to active community strikes

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

owner\_id

v

5.199 (текущая)

{}
