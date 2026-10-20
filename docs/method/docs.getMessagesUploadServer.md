# docs.getMessagesUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/docs.getMessagesUploadServer)

Метод получает адрес сервера для [загрузки файла](https://dev.vk.ru/ru/api/upload/document-in-profile) в личное сообщение.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): docs — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): docs)

## <a id="Параметры"></a>Параметры

### type

string

**Необязательный параметр.** Тип файла. Возможные значения:

- `doc` — обычный файл.
- `audio_message` — голосовое сообщение.

### peer\_id

string

**Необязательный параметр.** Идентификатор назначения. Возможные значения:

- Для пользователя: `{ИДЕНТИФИКАТОР_ПОЛЬЗОВАТЕЛЯ}`.
- Для групповой беседы: `2000000000 + {ИДЕНТИФИКАТОР_БЕСЕДЫ}`.
- Для сообщества: `-{ИДЕНТИФИКАТОР_СООБЩЕСТВА}`.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить файл. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c236331\/upload.php?act=add_doc_new&mid=743784474&aid=-1&gid=0&type=0&peer_id=0&rhash=4acca3170eeadfe8b76873d486d11962&api=1&server=236331&_origin=https%3A%2F%2Fapi.vk.com&_sig=a203dced42d9533f74c1130fa58a495f"
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

type

peer\_id

v

5.199 (текущая)

{}
