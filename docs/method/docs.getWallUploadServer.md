# docs.getWallUploadServer

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/docs.getWallUploadServer)

Метод получает адрес сервера для [загрузки документа](https://dev.vk.ru/ru/api/upload/document-in-profile) в папку **Отправленные** для последующей отправки документа на стену или личным сообщением.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): docs — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): docs)

## <a id="Параметры"></a>Параметры

### group\_id

positive

**Необязательный параметр.** Идентификатор сообщества, если необходимо загрузить файл в список файлов сообщества. Если файл нужно загрузить в список пользователя, метод вызывается без дополнительных параметров.

## <a id="Результат"></a>Результат

Метод возвращает объект. Поля объекта:

| Поле | Тип | Описание |
| --- | --- | --- |
| `upload_url` | `string` | Адрес, по которому нужно загрузить документ. |

Пример ответа:

```json
{
  "response":{
    "upload_url":"https:\/\/pu.vk.com\/c237331\/upload_doc.php?act=add_doc&mid=743784474&aid=-1&gid=0&type=0&hash=daa35bf01486462ac67b3cc424be5ec6&rhash=4b76e3c083de5aa6cf8bbc3f657b10c5&api=1"
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
