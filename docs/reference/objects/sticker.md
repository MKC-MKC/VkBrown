# Стикер

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/sticker)

Объект, описывающий стикер, содержит следующие поля:

## <a id="product_id"></a>`product_id`

`integer` Идентификатор набора.

## <a id="sticker_id"></a>`sticker_id`

`integer` Идентификатор стикера.

## <a id="animation_url"></a>`animation_url`

`string` URL анимации стикера.

## <a id="is_allowed"></a>`is_allowed`

`boolean` Информация о том, доступен ли стикер.

## <a id="Версии API ниже 5.190"></a>Версии API ниже 5.190

### <a id="images"></a>`images`

`array` Изображения для стикера (с прозрачным фоном). Массив, каждый объект в котором содержит поля:

- `url` (`string`) — URL копии изображения.
- `width` (`integer`) — ширина копии в пикселях.
- `height` (`integer`) — высота копии в пикселях.

### <a id="images_with_background"></a>`images_with_background`

`array` Изображения для стикера (с непрозрачным фоном). Массив, каждый объект в котором содержит поля:

- `url` (`string`) — URL копии изображения.
- `width` (`integer`) — ширина копии в пикселях.
- `height` (`integer`) — высота копии в пикселях.
