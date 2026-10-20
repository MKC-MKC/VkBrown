# Прикреплённая ссылка

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/link)

Объект, описывающий прикреплённую ссылку в сообщении, комментарии или записи на стене, содержит следующие поля:

## <a id="url"></a>`url`

`string` URL ссылки.

## <a id="title"></a>`title`

`string` Заголовок ссылки.

## <a id="caption"></a>`caption`

`string` Подпись ссылки (если имеется).

## <a id="description"></a>`description`

`string` Описание ссылки.

## <a id="photo"></a>`photo`

`object` Изображение превью, объект [фотографии](photo.md) (если имеется).

## <a id="product"></a>`product`

`object` Информация о продукте (если имеется). Поле возвращается для ссылок на магазины, например, AliExpress. Объект с единственным полем `price` (`object`), которое описано [на отдельной странице](../objects.md).

## <a id="button"></a>`button`

`object` Информация о кнопке для перехода (если имеется). Объект описан [на отдельной странице](../objects.md).

## <a id="preview_page"></a>`preview_page`

`string` Идентификатор вики-страницы с контентом для предпросмотра содержимого страницы. Возвращается в формате `"owner_id_page_id"`.

## <a id="preview_url"></a>`preview_url`

`string` URL страницы с контентом для предпросмотра содержимого страницы.

## <a id="Для версий API от 5.37 до 5.39"></a>Для версий API от 5.37 до 5.39

### <a id="url"></a>`url`

`string` URL ссылки.

### <a id="title"></a>`title`

`string` Заголовок ссылки.

### <a id="description"></a>`description`

`string` Описание ссылки.

### <a id="photo"></a>`photo`

`object` Изображение превью, объект [фотографии](photo.md) (если имеется).

### <a id="preview_page"></a>`preview_page`

`string` Идентификатор вики-страницы с контентом для предпросмотра содержимого страницы. Возвращается в формате `"owner_id_page_id"`.

### <a id="preview_url"></a>`preview_url`

`string` URL страницы с контентом для предпросмотра содержимого страницы.

### <a id="url"></a>`url`

`string` URL ссылки.

### <a id="title"></a>`title`

`string` Заголовок ссылки.

### <a id="description"></a>`description`

`string` Описание ссылки.

### <a id="image_src"></a>`image_src`

`string` URL изображения для превью ссылки.

### <a id="preview_page"></a>`preview_page`

`string` Идентификатор вики-страницы с контентом для предпросмотра содержимого страницы. Возвращается в формате `"owner_id`\_`page_id"`.

### <a id="preview_url"></a>`preview_url`

`string` URL страницы с контентом для предпросмотра содержимого страницы.
