# docs.getById

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/docs.getById)

Возвращает информацию о документах по их идентификаторам.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): docs — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): docs)

## <a id="Параметры"></a>Параметры

### docs

string

Идентификаторы документов, информацию о которых нужно вернуть, в формате `<owner_id>_<doc_id>`. Пример значения `docs`:

 `66748_91488,66748_91455`

Метод поддерживает передачу [`access_key`](../reference/objects.md).

Обязательный параметр

### return\_tags

checkbox

`1` — добавить в ответ массив меток документа.

## <a id="Результат"></a>Результат

После успешного выполнения возвращает объект, содержащий массив объектов [документов](../reference/objects/doc.md).

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

docs \*

return\_tags

bool0

v

5.199 (текущая)

{}
