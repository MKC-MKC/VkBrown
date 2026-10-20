# photos.getOwnerCoverPhotoUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getOwnerCoverPhotoUploadServer)

Метод получает адрес сервера для [загрузки обложки](https://dev.vk.ru/ru/api/upload/main-photo-in-group) сообщества.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): photos)

## <a id="Параметры"></a>Параметры

### group\_id

positive

**Обязательный параметр.** Идентификатор сообщества.

Обязательный параметр

### crop\_x

positive

**Необязательный параметр.** Координата `X` верхнего левого угла для обрезки фотографии.

### crop\_y

positive

**Необязательный параметр.** Координата `Y` верхнего левого угла для обрезки фотографии.

### crop\_x2

positive

**Необязательный параметр.** Координата `X` нижнего правого угла для обрезки изображения.

### crop\_y2

positive

**Необязательный параметр.** Координата `Y` нижнего правого угла для обрезки изображения.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поле объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить фотографию. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c534336\/ss2248\/upload.php?_query=eyJhY3QiOiJvd25lcl9jb3ZlciIsIm9pZCI6LTIxODI1MjE3NSwiYXBpIjp0cnVlLCJhcGlfd3JhcCI6eyJoYXNoIjoiMzhmYTEwMThiNGI5ODUxYzZjIiwicGhvdG8iOiJ7cmVzdWx0fSJ9LCJmb3JjZV9taW5fc2l6ZXMiOmZhbHNlLCJtaWQiOjc0Mzc4NDQ3NCwic2VydmVyIjo1MzQzMzYsIl9vcmlnaW4iOiJodHRwczpcL1wvYXBpLnZrLmNvbSIsIl9zaWciOiJkNWU5NjQ1MDhiZTM3YWEwMDUyZmJmZTljMWRhZjhjYyJ9&_crop=0,0,911,911"
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

group\_id \*

crop\_x

crop\_y

crop\_x2

crop\_y2

v

5.199 (текущая)

{}
