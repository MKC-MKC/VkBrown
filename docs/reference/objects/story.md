# История

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/story)

Объект, описывающий историю, содержит следующие поля:

## <a id="id"></a>`id`

`integer` Идентификатор истории.

## <a id="owner_id"></a>`owner_id`

`integer` Идентификатор владельца истории.

## <a id="date"></a>`date`

`integer` Дата добавления в Unixtime.

## <a id="expires_at"></a>`expires_at`

`integer` Дата в Unixtime, когда история истечёт.

## <a id="is_expired"></a>`is_expired`

`boolean` `true`, если срок хранения истории истёк. В этом случае объект истории содержит только поля `id`, `owner_id`, `date`, `expires_at`, `is_expired`.

## <a id="is_deleted"></a>`is_deleted`

`boolean` `true`, если история удалена или не существует. В этом случае объект истории содержит только поля `id`, `owner_id`, `is_deleted`.

## <a id="can_see"></a>`can_see`

`integer` Информация о том, может ли пользователь просмотреть историю (`0` — нет, `1` — да). Если `can_see` = `0`, объект истории содержит только поля `id`, `owner_id`, `date`, `expires_at`, `can_see`, `type`.

## <a id="seen"></a>`seen`

`integer` `1`, если история просмотрена текущим пользователем.

## <a id="type"></a>`type`

`string` Тип истории. Возможные значения:

- `photo` — фотография;
- `video` — видеозапись.

## <a id="photo"></a>`photo`

`object` Фотография из истории, если тип истории — `photo`. Подробнее о полях объекта `photo` — в разделе [Фотография](photo.md).

## <a id="video"></a>`video`

`object` Видеозапись из истории, если тип истории — `video`. Подробнее о полях объекта `video` — в разделе [Видеозапись](video.md).

## <a id="link"></a>`link`

`object` Ссылка для перехода из истории. Объект, который содержит поля:

- `text` (`string`) — текст ссылки;
- `url` (`string`) — URL для перехода.

## <a id="parent_story_owner_id"></a>`parent_story_owner_id`

`integer` Идентификатор пользователя, загрузившего историю, ответом на которую является текущая.

## <a id="parent_story_id"></a>`parent_story_id`

`integer` Идентификатор истории, ответом на которую является текущая.

## <a id="parent_story"></a>`parent_story`

`object` Объект родительской истории.

## <a id="replies"></a>`replies`

`object` Информация об ответах на текущую историю. Объект, который содержит поля:

- `count` (`integer`) — число ответов;
- `new` (`integer`) — число новых ответов. Возвращается только для историй текущего пользователя.

Получить истории-ответы можно методом [`stories.getReplies`](https://dev.vk.ru/ru/method/stories.getReplies).

## <a id="can_reply"></a>`can_reply`

`integer` Информация о том, может ли пользователь ответить на историю (`0` — нет, `1` — да).

## <a id="can_share"></a>`can_share`

`integer` Информация о том, может ли пользователь расшарить историю (`0` — нет, `1` — да).

## <a id="can_comment"></a>`can_comment`

`integer` Информация о том, может ли пользователь комментировать историю (`0` — нет, `1` — да).

## <a id="clickable_stickers"></a>`clickable_stickers`

`object` Объект [кликабельного стикера](https://dev.vk.ru/ru/reference/objects/clickable-sticker).

## <a id="views"></a>`views`

`integer` Число просмотров.

## <a id="access_key"></a>`access_key`

`string` Ключ доступа для приватного объекта.
