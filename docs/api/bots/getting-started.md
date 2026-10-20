# Быстрый старт

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/bots/getting-started)

Для создания бота потребуются:

- Сообщество, от имени которого бот будет общаться с пользователями.
- Сервер, который будет принимать события и выполнять логику бота.
- Сценарии бота, то есть правила обработки команд и событий.

Подробнее о работе с API ВКонтакте — в разделе [Использование API | Быстрый старт](../getting-started.md).

## <a id="Шаг 1. Подготовьте скрипт"></a>Шаг 1. Подготовьте скрипт

1. Перед разработкой составьте список команд и событий, на которые бот должен реагировать. Также предусмотрите действие по умолчанию, если команда не распознана, например подсказку со списком доступных команд.
2. Убедитесь, что бот соответствует [правилам](https://dev.vk.ru/ru/bots-rules).

## <a id="Шаг 2. Подготовьте сообщество"></a>Шаг 2. Подготовьте сообщество

1. Оформите сообщество, подготовьте описание, чтобы пользователи пониманили функции и назначение бота. Для подключения чат-бота можно использовать любое сообщество ВКонтакте.
2. Включите работу бота в сообществе. На странице сообщества перейдите в **Управление** → **Сообщения** → **Настройки для бота** и напротив **Возможности ботов** установите **Включены**.
3. Когда бот будет готов, перейдите в **Управление** → **Сообщения** и включите **Сообщения сообщества**. После этого пользователи смогут писать сообществу.

## <a id="Шаг 3. Получите ключ доступа"></a>Шаг 3. Получите ключ доступа

Ключ доступа нужен для работы с API и для получения обновлений через Long Poll.

1. На странице сообщества перейдите в **Управление** → **Дополнительно** → **Работа с API**.
2. Нажмите **Создать ключ**, отметьте нужные права доступа и подтвердите выбор.

Можно создать несколько ключей с разными правами. Не размещайте ключи публично: получив ключ, третье лицо сможет обращаться к API от имени сообщества. Если ключ скомпрометирован, удалите его — после этого он станет недействителен.

Ключ доступа сообщества также можно получить с помощью схемы авторизации [Authorization Code Flow](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.ru%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Foauth%2Foauth-vkontakte%2Fauthcode-flow-community).

## <a id="Шаг 4. Настройте работу в чатах"></a>Шаг 4. Настройте работу в чатах

Чтобы пользователи могли добавлять бота в чаты, на странице сообщества перейдите в **Управление** → **Сообщения** → **Настройки для бота** → **Разрешать добавлять сообщество в чаты**.

На странице сообщества появится кнопка добавления бота в чат.

У бота в чате может быть три вида доступа:

- **Только упоминания.** Доступ выдаётся сразу после добавления в чат. Бот может:



  - Отправлять сообщения в чат.
  - Видеть упоминания и ответы на сообщения бота.
- **Полный.** Доступ выдаёт любой администратор чата. Бот может:



  - Отправлять сообщения в чат.
  - Видеть все сообщения в чате.
- **Администратор.** Доступ выдаёт создатель чата или администратор с правом назначать администраторов. Бот может:



  - Отправлять сообщения в чат.
  - Видеть все сообщения в чате.
  - Получать объект [Беседа](../../reference/objects/conversation.md).
  - Получать участников чата.

> Чтобы получить события из чата, версия API у callback-сервера должна быть не ниже 5.80.

## <a id="Шаг 5. Подключите получение событий"></a>Шаг 5. Подключите получение событий

Чтобы бот реагировал на события, сервер должен получать обновления. Используйте один из подходов: Callback API или Bots Long Poll API.

### <a id="Callback API"></a>Callback API

Callback API отправляет уведомления на ваш сервер, когда в сообществе происходит нужное событие, например, комментарий к фотографии, новая запись на стене, вступление в сообщество. Подробнее о событиях и настройке — в [документации Callback API](../callback/getting-started.md).

Уведомления приходят в формате JSON с основной информацией о событии:

```json
{
   "type":"message_new",
   "object":{
      "id":694,
      "date":1499441696,
      "out":0,
      "user_id":123456,
      "read_state":0,
      "title":" ... ",
      "body":"start"
   },
   "group_id":1,
   "secret":"sjr948dff3kjnfd3"
}
```

В этом примере пользователь с `id` = `123456` отправил сообществу сообщение с текстом `start`.

Для каждого события Callback API отправляет отдельный запрос на сервер. Ваш скрипт должен подтверждать получение каждого запроса, отправляя в ответ строку `ok`.

```php
<?
define('CALLBACK_API_CONFIRMATION_TOKEN', '213fefef3');  // Строка, которую должен вернуть сервер
define('VK_API_ACCESS_TOKEN', '016cb552 ... 989fb8345');   // Ключ доступа сообщества

define('CALLBACK_API_EVENT_CONFIRMATION', 'confirmation'); // Тип события о подтверждении сервера
define('CALLBACK_API_EVENT_MESSAGE_NEW', 'message_new'); // Тип события о новом сообщении
define('VK_API_ENDPOINT', '[https://api.vk.ru/method/]');   // Адрес обращения к API
define('VK_API_VERSION', '5.199'); // Используемая версия API

$event = json_decode(file_get_contents('php://input'), true);

switch ($event['type']) {
  // Подтверждение сервера
  case CALLBACK_API_EVENT_CONFIRMATION:
    echo(CALLBACK_API_CONFIRMATION_TOKEN);
    break;
  // Получение нового сообщения
  case CALLBACK_API_EVENT_MESSAGE_NEW:
    $message = $event['object'];
    $peer_id = $message['peer_id'] ?: $message['user_id'];
    send_message($peer_id, "Hello world! (peer_id: {$peer_id})");
    echo('ok');
    break;
  default:
    echo('Unsupported event');
    break;
}

function send_message($peer_id, $message) {
  api('messages.send', array(
    'peer_id' => $peer_id,
    'message' => $message,
  ));
}

function api($method, $params) {
  $params['v'] = VK_API_VERSION;
  $query       = http_build_query($params);
  $url         = VK_API_ENDPOINT . $method . '?' . $query;
  $curl        = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Authorization: Bearer ' . VK_API_ACCESS_TOKEN,
  ]);
  $json  = curl_exec($curl);
  $error = curl_error($curl);
  if ($error) {
    error_log($error);
    throw new Exception("Failed {$method} request");
  }
  curl_close($curl);
  $response = json_decode($json, true);
  if (!$response || !isset($response['response'])) {
    error_log($json);
    throw new Exception("Invalid response for {$method} request");
  }
  return $response['response'];
}
```

### <a id="Bots Long Poll API"></a>Bots Long Poll API

Bots Long Poll API позволяет получать обновления через запросы к серверу ВКонтакте. Подробнее — в [документации Bots Long Poll API](../bots-long-poll/getting-started.md).

Когда произошло новое событие или время ожидания истекло, сервер отправляет ответ в формате JSON:

```json
{
  "ts": "4",
  "updates": [
    {
      "type": "wall_post_new",
      "object": {
        "id": 28,
        "from_id": -123456,
        "owner_id": -123456,
        "date": 1519631591,
        "marked_as_ads": 0,
        "post_type": "post",
        "text": "Post text",
        "can_edit": 1,
        "created_by": 564321,
        "can_delete": 1,
        "comments": {
          "count": 0
        }
      },
      "group_id": 123456
    }
  ]
}
```

## <a id="Информация о возможностях клиента"></a>Информация о возможностях клиента

Некоторые функции ботов могут быть недоступны, потому что пользователи:

- Используют разные платформы и версии клиента.
- Обновляют официальные приложения постепенно.
- Пользуются приложениями сторонних разработчиков.

Отправляйте сообщения с учётом возможностей клиента. Если клавиатура недоступна, предложите варианты ответов в тексте и пронумеруйте их. Если клавиатура доступна, не дублируйте варианты ответов в тексте.

Начиная с версии API 5.103, информация о доступных функциях приходит вместе с событием [`message_new`](../community-events/json-schema.md) в Callback API и Bots Long Poll API. Она находится в объекте `client_info`.

```json
"client_info": {
    "button_actions": [
      "text",
      "vkpay",
      "open_app",
      "location",
      "open_link",
      "callback"
    ],
    "keyboard": true,
    "inline_keyboard": true,
    "carousel": false,
    "lang_id": 0
}
```

Поля объекта:

- `button_actions` — массив действий кнопок, которые поддерживает клиент. Возможные значения — в разделе [Клавиатура](development/keyboard.md#%D0%9F%D0%B0%D1%80%D0%B0%D0%BC%D0%B5%D1%82%D1%80%D1%8B%20%D0%BA%D0%BB%D0%B0%D0%B2%D0%B8%D0%B0%D1%82%D1%83%D1%80%D1%8B).
- `keyboard` (`bool`) — поддерживается ли клавиатура ботов клиентом.
- `inline_keyboard` (`bool`) — поддерживается ли inline-клавиатура ботов клиентом.
- `carousel` (`bool`) — поддерживаются ли [карусели](development/messages/user-content.md#%D0%9A%D0%B0%D1%80%D1%83%D1%81%D0%B5%D0%BB%D1%8C) клиентом.
- `lang_id` — [ID](../api-requests.md) используемого языка.

## <a id="Примеры реализации"></a>Примеры реализации

#### <a id="PHP"></a>PHP

[VK PHP Бот](https://vk.ru/away.php?to=https%3A%2F%2Fvk.ru%2Fbotexample), созданный нашим разработчиком на PHP. Для обработки событий используется Callback API, а голосовые сообщения генерируются через API [Яндекс SpeechKit](https://vk.ru/away.php?to=https%3A%2F%2Faistudio.yandex.ru%2Fdocs%2Fru%2Fspeechkit%2Fstt%2F). [Код проекта на GitHub](https://vk.ru/away.php?to=https%3A%2F%2Fgithub.com%2FVKCOM%2Fbot-example-php).

#### <a id="Java"></a>Java

Бот для работы с YouTrack, созданный нашими разработчиками на Java ([Java SDK](https://dev.vk.ru/ru/sdk/java)). Для обработки событий используется Callback API. [Код проекта на GitHub](https://vk.ru/away.php?to=https%3A%2F%2Fgithub.com%2FVKCOM%2Fvk-java-sdk%2Fwiki%2FYouTrack-bot).

#### <a id="JS"></a>JS

Библиотека для работы с ботами на Node.js, автор — [Михаил Семин](https://vk.ru/away.php?to=https%3A%2F%2Fvk.ru%2Fbifot). Используется Long Poll, есть возможность быстро добавлять новые команды и реакции. [Код проекта на GitHub](https://vk.ru/away.php?to=https%3A%2F%2Fgithub.com%2Fbifot%2Fnode-vk-bot-api).

## <a id="Материалы по теме"></a>Материалы по теме

- [Сообщения](development/messages.md)
- [Клавиатура](development/keyboard.md)
- [Взаимодействие с приложением](development/app-interaction.md)
- [Использование API | Быстрый старт](../getting-started.md)
