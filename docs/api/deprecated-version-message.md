# Сообщение "Deprecated version"

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/deprecated-version-message)

1 декабря 2024 года мы отключили использование старых версий API, поэтому рекомендуем перейти на актуальную версию [5.199](https://dev.vk.ru/ru/reference/version/5.199). Если этого не сделать, приложения и чат-боты, добавленные в сообщество, могут начать работать неправильно.

ВКонтакте отправляет это сообщение в ответе вашему серверу, когда обнаруживает, что сервер ожидает устаревшую версию API.

```json
{
    "group_id": 12345,
    "type": "wall_post_new",
    "event_id": "bcac94ca00d2f069fb6badb4cf0441dac637dcfc",
    "v": "5.80",
    "object": {
        "warning": "You are using a deprecated API version. It will be disabled soon. Read more here: https://dev.vk.com/api/deprecated-version-message"
    }
}
```

**Обратите внимание!** Начиная с версии [5.101](https://vk.ru/away.php?to=https%3A%2F%2Fdev.vk.com%2Fru%2Freference%2Fversion%2F5.103), у события `message_new` меняется формат: вместо `{ object: message }` будет приходить `{ object: { message, client_info } }`. Учтите это при переходе на актуальную версию.

## <a id="Callback API"></a>Callback API

О том, как изменить версию API, читайте в [инструкции](callback/getting-started.md#%D0%A7%D0%B5%D1%80%D0%B5%D0%B7%20API%20%D0%92%D0%9A%D0%BE%D0%BD%D1%82%D0%B0%D0%BA%D1%82%D0%B5).

Если у вас нет доступа к сообществу, вы можете изменить версию API, отправив в ответ на уведомление о любом событии сообщение `version 5.199`. Вместо 5.199 можно указать другую актуальную версию.

## <a id="LongPoll API"></a>LongPoll API

Чтобы изменить версию API, используйте метод [`groups.setLongPollSettings`](../method/groups.setLongPollSettings.md). Укажите нужную версию API в параметре `api_version`.

## <a id="Материалы по теме"></a>Материалы по теме

- [Версии API ВКонтакте](../reference/versions.md)
- [Callback API](callback/getting-started.md)
- [Bots Long Poll API](bots-long-poll/getting-started.md)
