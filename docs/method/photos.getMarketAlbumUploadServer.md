# photos.getMarketAlbumUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getMarketAlbumUploadServer)

Метод получает адрес сервера для [загрузки фотографии подборки товаров](https://dev.vk.ru/ru/api/upload/main-photo-in-market) в сообществе.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): market, photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### group\_id

positive

**Обязательный параметр.** Идентификатор сообщества, для которого необходимо загрузить фотографию подборки товаров.

Обязательный параметр

Минимальный размер фотографии — 1280x720 пикселей.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить фотографию подборки товаров. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c855312\/ss2189\/upload.php?_query=eyJhY3QiOiJtYXJrZXRfYWxidW0iLCJnaWQiOjIxODI1MjE3NSwiYWlkIjotNTMsImFwaV91cGxvYWQiOjEsImFwaV93cmFwIjp7InNlcnZlciI6OTk5LCJwaG90byI6IntyZXN1bHR9IiwiZ2lkIjoyMTgyNTIxNzUsImhhc2giOiI5MmMyZDgxMzE3NzgzODMyMTM3NTBjZDYwM2I4N2EzZSJ9LCJtaWQiOjc0Mzc4NDQ3NCwic2VydmVyIjo4NTUzMTIsIl9vcmlnaW4iOiJodHRwczpcL1wvYXBpLnZrLmNvbSIsIl9zaWciOiIxYTUwZTc1OWUzOGUxMjdmOTU2MmFjZDlhNTYyNDNhZCJ9"
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

1438

Market not enabled

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id \*

v

5.199 (текущая)

{}
