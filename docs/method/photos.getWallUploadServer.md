# photos.getWallUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getWallUploadServer)

Метод получает адрес сервера для [загрузки фотографии на стену](https://dev.vk.ru/ru/api/upload/wall-photo) пользователя или сообщества.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### group\_id

integer

**Необязательный параметр.** Идентификатор сообщества, на стену которого нужно загрузить фотографии (без знака `-`).

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `album_id` | `integer` | Идентификатор альбома, в который нужно загрузить фотографии. |
| `upload_url` | `string` | Адрес, по которому нужно загрузить фотографии. |
| `user_id` | `integer` | Идентификатор пользователя или сообщества, на стену которого будут загружены фотографии. |

Пример ответа:

```json
{
  "response":{
    "album_id":-14
    "upload_url":"https://pu.vk.com/c856312/ss2152/upload.php?act=do_add&mid=743784474&aid=-14&gid=0&hash=bd9a7f37b8af6c5e486a3762a4c7b797&rhash=f4c2595ded6f9b3e8954567d4f8eae57&swfupload=1&api=1&wallphoto=1"
    "user_id":743784474
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

group\_id

v

5.199 (текущая)

{}
