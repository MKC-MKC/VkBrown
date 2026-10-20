# docs.save

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/docs.save)

Метод сохраняет файл после его успешной [загрузки на сервер](https://dev.vk.ru/ru/api/upload/document-in-profile).

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F)

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0)

## <a id="Параметры"></a>Параметры

### file

string

**Обязательный параметр.** Файл в формате `multipart/form-data`. Параметр возвращается в результате [загрузки файла на сервер](https://dev.vk.ru/ru/api/upload/document-in-profile).

Обязательный параметр

### title

string

Название файла.

### tags

string

Метки для поиска, которые будут добавлены к документу.

### return\_tags

checkbox

`1` — добавить в ответ массив меток документа.

## <a id="Результат"></a>Результат

Метод возвращает объект:

| Поле | Тип | Описание |
| --- | --- | --- |
| `type` | `string` | Тип файла. |
| `audio_message` | `object` | Объект [голосового сообщения](https://dev.vk.ru/ru/reference/objects/audio-message). |
| `doc` | `object` | Объект [других типов файлов](../reference/objects/doc.md). |

Пример ответа:

```json
{
  "response":{
    "type":"doc",
    "doc":{
      "id":657626222,
      "owner_id":743784474,
      "title":"\\u041f\\u0435\\u0440\\u0432\\u044b\\u0435 \\u0448\\u0430\\u0433\\u0438.pdf",
      "size":14854,
      "ext":"pdf",
      "date":1674050872,"type":1,
      "url":"https:\/\/vk.com\/doc743784474_657626222?hash=jWHXvoUCYCxklaOiBsI0bZRACXzH6CiauvHlkgrIjYg&dl=G42DGNZYGQ2DONA:1674050872:7rxkHS8nSaTa5C0DkRfjpZZagKIs1Z3lKnPABTOqr4P&api=1&no_preview=1"
    }
  }
}
```

## <a id="Коды ошибок"></a>Коды ошибок

105

Couldn't save file

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

file \*

title

tags

return\_tags

bool0

v

5.199 (текущая)

{}
