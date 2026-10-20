# Отправка сообщений

[Оглавление](../../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/bots/development/messages)

Чат-бот общается с пользователями с помощью [сообщений сообщества](../../community-messages/getting-started.md). Вы можете отправлять в сообщениях текст и вложения: фотографии, аудиозаписи или видео, документы, аудиосообщения, ссылки. Сообщения отправляются с помощью запросов к [API ВКонтакте](../../api-requests.md).

## <a id="Метод messages.send"></a>Метод `messages.send`

Для отправки сообщения используется метод [`messages.send`](../../../method/messages.send.md).

В ответе метод вернёт вашему серверу идентификатор отправленного сообщения или ошибку. Если вы используете Callback API, в случае удачной отправки будет сгенерировано событие `message_reply`.

### <a id="Особенности использования"></a>Особенности использования

- С [ключом доступа сообщества](https://dev.vk.ru/ru/api/access-token/community-token) можно совершать до 20 запросов в секунду.



  Чтобы сократить число запросов к API, группируйте сообщения с одинаковым текстом в параметр `message` для разных получателей. Для этого перечислите идентификаторы получателей (до 100) в параметре `user_ids`.
- Используйте параметр `random_id` (`int32`), чтобы избежать повторной отправки сообщения одному и тому же получателю. Этот параметр должен быть всегда уникальным, поэтому используйте большие случайные числа.
- С помощью метода [`messages.send`](../../../method/messages.send.md) бот может пересылать сообщения или отвечать на сообщения в рамках чата. Для этого передайте JSON-объект в параметре `forward`.

### <a id="Пример на PHP"></a>Пример на PHP

```php
define('VK_API_VERSION', '5.199'); // Используемая версия API
define('VK_API_ENDPOINT', "https://api.vk.ru/method/");

// Функция для вызова произвольного метода API
function _vkApi_call($method, $params = array()) {
  $params['v'] = VK_API_VERSION;
  $url = VK_API_ENDPOINT.$method.'?'.http_build_query($params);
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  // VK_API_ACCESS_TOKEN передаём в заголовке Authorization
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer '.VK_API_ACCESS_TOKEN
  ));

  $json = curl_exec($curl);
  curl_close($curl);
  $response = json_decode($json, true);
  return $response['response'];
}

// Функция для вызова messages.send
function vkApi_messagesSend($peer_id, $message, $attachments = array()) {
  return _vkApi_call('messages.send', array(
    'peer_id'    => $peer_id,
    'message'    => $message,
    'attachment' => implode(',', $attachments)
  ));
}

vkApi_messagesSend(494075, 'Hello world!');
```

## <a id="Материалы по теме"></a>Материалы по теме

- [Быстрый старт](../getting-started.md)
- [Управление сообщениями](messages/management.md)
- [Вложения в сообщениях](messages/attachments.md)
- [Пользовательский контент и шаблоны](messages/user-content.md)
- [Клавиатура](keyboard.md)
