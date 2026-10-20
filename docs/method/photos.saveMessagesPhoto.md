# photos.saveMessagesPhoto

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/method/photos.saveMessagesPhoto)

Метод сохраняет фотографию в личном сообщении после её успешной [загрузки на сервер](../api/upload/photo-in-message.md).

Для вызова метода можно использовать:

• ключ доступа пользователя, полученный в Standalone‑приложении через [Implicit Flow](https://dev.vk.ru/ru/api/access-token/implicit-flow-user) (требуется [право доступа](https://dev.vk.ru/ru/reference/access-rights): photos — выдаётся в исключительных случаях через запрос в поддержку по электронной почте [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com))

• [ключ доступа сообщества](../api/access-token/getting-started.md#%D0%9A%D0%BB%D1%8E%D1%87%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0) (требуются [права доступа](https://dev.vk.ru/ru/reference/access-rights): photos)

## <a id="Параметры"></a>Параметры

### photo

string

**Обязательный параметр.** Фотография в формате `multipart/form-data`. Параметр возвращается в результате [загрузки фотографии на сервер](../api/upload/photo-in-message.md).

Обязательный параметр

### server

integer

**Обязательный параметр.** Идентификатор сервера, на который загружена фотография. Параметр возвращается в результате [загрузки фотографии на сервер](../api/upload/photo-in-market.md).

### hash

string

**Обязательный параметр.** Хеш фотографии. Параметр возвращается в результате [загрузки фотографии на сервер](../api/upload/photo-in-market.md).

## <a id="Результат"></a>Результат

Метод возвращает массив с объектом [фотографии](../reference/objects/photo.md).

Пример ответа:

```json
{
  "response":[
    {
      "album_id":-64,
      "date":1673862629,
      "id":457239023,
      "owner_id":-218252175,
      "access_key":"698e738862a7917b5b",
      "sizes":[
        {
          "height":50,
          "type":"s",
          "width":75,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/Vus7E6r8jZjgv5E9bnuM6fbvL9U_NP4-goegNOaEy8t4Z1DnzofjER9exwblecB6Hxb3EUbWv7lQvxdRaErZGoT3.jpg?size=75x50&quality=96&type=album"
        },
        {
          "height":87,
          "type":"m",
          "width":130,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/JTtJ-M4Y1Md4nbNyY6QNKBjs9xleCGkDwGw-NuMvLV0DKfQrPb_xN7QcfazSTrBcZ-_JzsJ21pTuLI7Slr8m9HcB.jpg?size=130x87&quality=96&type=album"
        },
        {
          "height":402,
          "type":"x",
          "width":604,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/2DBzUBeOMpydPcypQFkirgj6g9mzsj8le0qsrWQ_lPX3zNQN1229bLivxf26ya-91HF9D57exLSnkSnJwUxJdUBN.jpg?size=604x402&quality=96&type=album"
        },
        {
          "height":537,
          "type":"y",
          "width":807,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/Biye5eNVG4UA_ymuN60MU6Qp26yO7rYp0WB-ch55oxkaATpXs4Kmqqznz1keCYHg_BHyvPhyrSGyK3zRK29LoVKH.jpg?size=807x537&quality=96&type=album"
        },
        {
          "height":852,
          "type":"z",
          "width":1280,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/O-BkqGyWMw2ZKcOyYz8sH543Ihkws7mAn6x76JYh0mVW2MCR9x9eig_AS6gT6OLeySlvewx5oyri1Ejj0uNhJuKo.jpg?size=1280x852&quality=96&type=album"
        },
        {
          "height":1704,
          "type":"w",
          "width":2560,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/o5klH0kpqicWBkDGQl_ch2j8VRpW69xrnq_PXw823wrMYc2qnXQLuDZeECtcKSaka1gfCpP9smoz7XwGAMDTk7vo.jpg?size=2560x1704&quality=96&type=album"
        },
        {
          "height":87,
          "type":"o",
          "width":130,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/JTtJ-M4Y1Md4nbNyY6QNKBjs9xleCGkDwGw-NuMvLV0DKfQrPb_xN7QcfazSTrBcZ-_JzsJ21pTuLI7Slr8m9HcB.jpg?size=130x87&quality=96&type=album"
        },
        {
          "height":133,
          "type":"p",
          "width":200,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/dFvcZ_sYZeMJtmvotINsevf_0x4KbDxo-jcrZojRQtebIKvM0juMU9U9NjybaidOukkrImr2CWcW8u6IHdlceWKD.jpg?size=200x133&quality=96&type=album"
        },
        {
          "height":213,
          "type":"q",
          "width":320,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/GglL_Kv0x1_rnPwXwtTPZUMFg9sT_JB9xUSUeNvNIRapPRhGvQbQAaCwD57WBhUKU8sPD6-BhyadPIXaALqERkS1.jpg?size=320x213&quality=96&type=album"
        },
        {
          "height":340,
          "type":"r",
          "width":510,
          "url":"https:\/\/sun9-west.userapi.com\/sun9-45\/s\/v1\/ig2\/LnQwirb-SUb689R2k90Q8MwuwHJ0tfO03a0IkCeXObaQERRE2-UUyLBCTTLme2qkLcxXAekHVbkLMEZhRq5E6Ggr.jpg?size=510x340&quality=96&crop=2,0,2556,1704&type=album"
        }
      ],
      "text":"",
      "user_id":100,
      "has_tags":false
    }
  ]
}
```

## <a id="Коды ошибок"></a>Коды ошибок

114

Invalid album id

118

Invalid server

121

Invalid hash

В ходе выполнения могут произойти [общие ошибки](../reference/errors.md)

## <a id="Пример запроса"></a>Пример запроса

Ввести вручную

access\_token \*

photo \*

server

hash

v

5.199 (текущая)

{}
