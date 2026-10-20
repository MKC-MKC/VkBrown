# photos.edit

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.edit)

Редактирует описание или геометку у фотографии.

Для вызова метода можно использовать:

• [ключ доступа пользователя](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

## <a id="Параметры"></a>Параметры

### owner\_id

string

Идентификатор пользователя или сообщества, которому принадлежит фотография.

> Обратите внимание, идентификатор сообщества в параметре `owner_id` необходимо указывать со знаком `«-»` — например, `owner_id`=`-1` соответствует идентификатору сообщества [ВКонтакте API](https://vk.ru/away.php?to=https%3A%2F%2Fvk.com%2Fapiclub) (club1).

### photo\_id

positive

Идентификатор фотографии.

Обязательный параметр

### caption

string

Новый текст описания к фотографии. Если параметр не задан, то считается, что он равен пустой строке.

### latitude

string

Географическая широта.

### longitude

string

Географическая долгота.

### place\_str

string

Название места.

### foursquare\_id

string

ID в Foursquare.

### delete\_place

checkbox

Удалить место (`0` — не удалять, `1` — удалить).

## <a id="Результат"></a>Результат

После успешного выполнения возвращает `1`.

## <a id="Коды ошибок"></a>Коды ошибок

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

owner\_id

photo\_id \*

caption

latitude

longitude

place\_str

foursquare\_id

delete\_place

bool0

v

5.199 (текущая)

{}
