# Аудиозапись

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/objects/audio)

Объект, описывающий аудиозапись, содержит следующие поля:

## <a id="id"></a>`id`

`integer` Идентификатор аудиозаписи.

## <a id="owner_id"></a>`owner_id`

`integer` Идентификатор владельца аудиозаписи.

## <a id="artist"></a>`artist`

`string` Исполнитель.

## <a id="title"></a>`title`

`string` Название композиции.

## <a id="duration"></a>`duration`

`integer` Длительность аудиозаписи в секундах.

## <a id="url"></a>`url`

`string` Ссылка на mp3.

## <a id="lyrics_id"></a>`lyrics_id`

`integer` Идентификатор текста аудиозаписи (если доступно).

## <a id="album_id"></a>`album_id`

`integer` Идентификатор альбома, в котором находится аудиозапись (если присвоен).

## <a id="genre_id"></a>`genre_id`

`integer` Идентификатор жанра из [списка аудио жанров](https://dev.vk.ru/ru/reference/objects/audio-genres).

## <a id="date"></a>`date`

`integer` Дата добавления.

## <a id="no_search"></a>`no_search`

`integer` `1`, если включена опция «Не выводить при поиске». Если опция отключена, поле не возвращается.

## <a id="is_hq"></a>`is_hq`

`integer` `1`, если аудио в высоком качестве.

## <a id="Версии API ниже 5.0"></a>Версии API ниже 5.0

Для [версий](../versions.md) ниже 5.0 названия полей и их структура отличаются от приведенных выше. Мы не рекомендуем использовать версии ниже 5.0.

### <a id="aid"></a>`aid`

`integer` Идентификатор аудиозаписи

### <a id="owner_id"></a>`owner_id`

`integer` Идентификатор владельца аудиозаписи.

### <a id="artist"></a>`artist`

`string` Исполнитель.

### <a id="title"></a>`title`

`string` Название композиции.

### <a id="duration"></a>`duration`

`integer` Длительность аудиозаписи в секундах.

### <a id="url"></a>`url`

`string` Ссылка на mp3.

### <a id="lyrics_id"></a>`lyrics_id`

`integer` Идентификатор текста аудиозаписи (если доступно).

### <a id="album"></a>`album`

`integer` Идентификатор альбома, в котором находится аудиозапись (если присвоен).

### <a id="genre"></a>`genre`

`integer` Идентификатор жанра из [списка аудио жанров](https://dev.vk.ru/ru/reference/objects/audio-genres).
