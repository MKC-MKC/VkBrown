# photos.getMessagesUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.getMessagesUploadServer)

Метод получает адрес сервера для [загрузки фотографии в личное сообщение](../api/upload/photo-in-message.md) пользователя или в сообщение сообщества.

**Примечание.** Убедитесь, что вы включили сообщения в сообществе. Для этого:

1. Войдите ВКонтакте под своей учётной записью.
2. Откройте сообщество, где вы являетесь администратором.
3. Нажмите на кнопку **Управление**.
4. Нажмите на кнопку **Сообщения**.
5. Убедитесь, что в блоке **Сообщения сообщества** включён режим **Включены**.
6. Нажмите на кнопку **Сохранить**.

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): photos)

## <a id="Параметры"></a>Параметры

### peer\_id

integer

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `album_id` | `integer` | Идентификатор альбома, в который нужно загрузить фотографию. |
| `upload_url` | `string` | Адрес, по которому нужно загрузить фотографию. |
| `user_id` | `integer` | Идентификатор пользователя. |
| `group_id` | `integer` | Идентификатор сообщества, если используются сообщения сообщества. |

Пример ответа:

```json
{
  "response":{
    "album_id":-64,
    "upload_url":"https:\/\/pu.vk.com\/c231331\/ss2269\/upload.php?act=do_add&mid=743784474&aid=-64&gid=218252175&hash=2e60ee02a7dd5aaaf0bce3e034b1dc30&rhash=eda561bac91afb0270fc9ca741ac626b&swfupload=1&api=1&mailphoto=1",
    "user_id":0,
    "group_id":218252175
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

901

Can't send messages for users without permission

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

peer\_id

v

5.199 (текущая)

{}
