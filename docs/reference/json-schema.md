# JSON-схема

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/reference/json-schema)

JSON Schema — это распространенный стандарт описания структуры данных. Схема используется для описания JSON-данных, но и сама она при этом является JSON-объектом. С помощью ключевых слов в схеме создаются правила валидации структуры объекта и типов его полей. Подробнее об ограничениях и типах данных — на официальном сайте [JSON Schema](https://vk.ru/away.php?to=https%3A%2F%2Fjson-schema.org%2F).

JSON Schema API ВКонтакте размещена по адресу: [github.com/VKCOM/vk-api-schema](https://vk.ru/away.php?to=https%3A%2F%2Fgithub.com%2FVKCOM%2Fvk-api-schema).

Рассмотрим простой пример.

У каждого пользователя ВКонтакте есть идентификатор `id` (число), имя `first_name` (строка) и фамилия `last_name` (строка). В API эти данные представлены в виде объекта с набором соответствующих полей. В JSON объект выглядит вот так:

```json
{
  "id": 210700286,
  "first_name": "Lindsey",
  "last_name": "Stirling"
}
```

JSON-схема, описывающая этот объект:

```json
{
      "type": "object",
      "properties": {
        "id": {
          "type": "integer",
          "description": "User ID"
        },
        "first_name": {
          "type": "string",
          "description": "User first name"
        },
        "last_name": {
          "type": "string",
          "description": "User last name"
        }
      },
      "required": [
        "id",
        "first_name",
        "last_name"
      ],
      "additionalProperties": false
}
```

Ключевое слово `required` задает перечень обязательных полей. Если хотя бы одно из перечисленных полей будет отсутствовать, объект не пройдет валидацию по такой схеме.

Ключевое слово `additionalProperties` задает возможность наличия дополнительных полей у объекта. В нашем случае дополнительные поля запрещены (при их наличии объект не пройдет валидацию по схеме).

Перейдем к более сложной структуре.

Вызовем метод [`users.get`](../method/users.get.md) с параметрами `user_ids=210700286,297428682` и `v=5.52`. В ответе сервер вернет JSON:

```json
{
  "response": [
    {
      "id": 210700286,
      "first_name": "Lindsey",
      "last_name": "Stirling"
    },
    {
      "id": 297428682,
      "first_name": "Jared",
      "last_name": "Leto"
    }
  ]
}
```

Это объект с единственным полем `response`, которое, в свою очередь, содержит массив объектов с базовой информацией о пользователе ВКонтакте. Вложенный объект содержит все те же три поля: `id` — численное значение, идентификатор пользователя; `first_name` — строковое значение, имя пользователя; `last_name` — строковое значение, фамилия пользователя.

JSON-схема для этого объекта выглядит так:

```json
{
  "type": "object",
  "properties": {
    "response": {
      "type": "array",
      "items": {
        "type": "object",
        "properties": {
          "id": {
            "type": "integer",
            "description": "User ID"
          },
          "first_name": {
            "type": "string",
            "description": "User first name"
          },
          "last_name": {
            "type": "string",
            "description": "User last name"
          }
        },
        "required": [
          "id",
          "first_name",
          "last_name"
        ]
      }
    }
  }
}
```

## <a id="Структура"></a>Структура

Репозиторий включает в себя 4 `.json` файла.

### <a id="methods.json"></a>`methods.json`

Описывает все [методы API](https://dev.vk.ru/ru/method). Например, метод [`users.get`](../method/users.get.md):

```json
{
      "name": "users.get",
      "description": "Returns detailed information on users.",
      "access_token_type": [
        "user",
        "group",
        "service"
      ],
      "parameters": [
        {
          "name": "user_ids",
          "description": "User IDs or screen names ('screen_name'). By default, current user ID.",
          "type": "array",
          "items": {
            "type": "string"
          },
          "maxItems": 1000
        },
        {
          "name": "fields",
          "description": "Profile fields to return. Sample values: 'nickname', 'screen_name', 'sex', 'bdate' (birthdate), 'city', 'country', 'timezone', 'photo', 'photo_medium', 'photo_big', 'has_mobile', 'contacts', 'education', 'online', 'counters', 'relation', 'last_seen', 'activity', 'can_write_private_message', 'can_see_all_posts', 'can_post', 'universities', 'can_invite_to_chats'",
          "type": "array",
          "items": {
            "$ref": "objects.json#/definitions/users_fields"
          }
        },
        {
          "name": "name_case",
          "description": "Case for declension of user name and surname: 'nom' — nominative (default), 'gen' — genitive , 'dat' — dative, 'acc' — accusative , 'ins' — instrumental , 'abl' — prepositional",
          "type": "string",
          "enum": [
            "nom",
            "gen",
            "dat",
            "acc",
            "ins",
            "abl"
          ],
          "enumNames": [
            "nominative",
            "genitive",
            "dative",
            "accusative",
            "instrumental",
            "prepositional"
          ]
        }
      ],
      "responses": {
        "response": {
          "$ref": "responses.json#/definitions/users_get_response"
        }
      }
    }
```

### <a id="objects.json"></a>`objects.json`

Описывает формат объектов, приходящих в ответах от методов. Например, объект `audio_audio`:

```json
{
  "audio_audio": {
    "type": "object",
    "properties": {
      "access_key": {
        "type": "string",
        "description": "Access key for the audio"
      },
      "artist": {
        "type": "string",
        "description": "Artist name"
      },
      "id": {
        "type": "integer",
        "description": "Audio ID",
        "minimum": 0
      },
      "owner_id": {
        "type": "integer",
        "description": "Audio owner's ID"
      },
      "title": {
        "type": "string",
        "description": "Title"
      },
      "url": {
        "type": "string",
        "format": "uri",
        "description": "URL of mp3 file"
      },
      "duration": {
        "type": "integer",
        "description": "Duration in seconds",
        "minimum": 0
      },
      "date": {
        "type": "integer",
        "description": "Date when uploaded",
        "minimum": 0
      },
      "album_id": {
        "type": "integer",
        "description": "Album ID",
        "minimum": 0
      },
      "genre_id": {
        "type": "integer",
        "description": "Genre ID",
        "minimum": 0
      },
      "performer": {
        "type": "string",
        "description": "Performer name"
      }
    },
    "required": [
      "id",
      "owner_id",
      "duration",
      "artist",
      "title"
    ],
    "additionalProperties": false
  }
}
```

Название объекта состоит из названия секции, методы которой возвращают этот объект, и названия самого объекта после знака подчеркивания.

### <a id="responses.json"></a>`responses.json`

Описывает формат ответов методов. Например, ответ метода [`utils.resolveScreenName`](https://dev.vk.ru/ru/method/utils.resolveScreenName):

```json
{
    "utils_resolveScreenName_response": {
      "type": "object",
      "properties": {
        "response": {
          "$ref": "../utils/objects.json#/definitions/utils_domain_resolved",
          "required": true
        }
      }
    }
}
```

### <a id="schema.json"></a>`schema.json`

Описывает дополнительные сущности, которые используются в схеме, такие как `method`, `error`, `parameter` и прочие. Это необходимо, чтобы расширить возможности JSON-схемы, придерживаясь спецификации. Например, у нас используется сущность `error`:

```json
{
  "error": {
    "type": "object",
    "properties": {
      "code": {
        "type": "integer",
        "description": "Error code",
        "minimum": 0
      },
      "description": {
        "type": "string",
        "description": "Error description"
      },
      "subcodes": {
        "type": "array",
        "items": {
          "$ref": "#/definitions/error_subcode"
        },
        "description": "Array of error subcodes"
      },
      "global": {
        "type": "boolean",
        "default": false
      },
      "disabled": {
        "type": "boolean",
        "default": false
      },
      "deprecated_from_version": {
        "$ref": "#/definitions/deprecated_from_version"
      },
      "from_version": {
        "$ref": "#/definitions/from_version"
      }
    },
    "required": [
      "code",
      "description"
    ],
    "additionalProperties": false
  }
}
```

Разделение на файлы необходимо только для удобства ручного поиска данных. Использовать их по отдельности бессмысленно, поскольку каждая схема ссылается на все остальные.

## <a id="Использование"></a>Использование

На основе схемы можно создавать SDK для API на любой платформе. Вы можете работать только с одной секцией методов или использовать их все, чтобы реализовать полнофункциональный клиент.

Схема позволяет работать с кодогенераторами, такой подход дает вам возможность уделить больше времени внутренней логике вашего приложения, сэкономив ресурсы на изучении формата данных API.

Пример SDK, реализованного на основе схемы, вы можете найти [на этой странице](https://dev.vk.ru/ru/sdk/java).

Если ранее вы не были знакомы с нашим API, мы бы советовали также прочитать это [руководство](../api/getting-started.md) перед началом работы.
