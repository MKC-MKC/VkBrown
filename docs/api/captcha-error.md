# Ошибка с Captcha

[Оглавление](../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/captcha-error)

Если пользователь слишком часто выполняет какое-то действие, например отправляет сообщения, API ВКонтакте может вернуть ошибку с кодом `14` и текстом `"Captcha needed"`.

```json
{
  "error_code": 14,
  "error_msg": "Captcha needed"
}
```

Это означает, что пользователь должен подтвердить, что он не бот, — пройти капчу. Для этого вам необходимо обработать ошибку и отобразить капчу. Если пользователь успешно прошёл проверку, VK ID Captcha вернёт вам данные для подтверждения. Эти данные нужно указать в запросе от вашего приложения к API ВКонтакте на выполнение действия, которое вызвало ошибку.

Для обработки ошибки у вас предварительно должен быть подключён [VK ID Captcha SDK](https://dev.vk.ru/ru/vkcaptcha/overview).

## <a id="Обработка ошибки"></a>Обработка ошибки

В ошибке капчи, помимо `error_code` и `error_msg`, возвращается параметр `redirect_uri` — ссылка для инициализации сессии капчи, которая содержит токен сессии.

Обработка капчи без параметра `redirect_uri` — с использованием идентификатора сессии `captcha_sid` и ссылки на изображение `captcha_img` — больше не поддерживается. Используйте обработку с `redirect_uri`, описанную в этом разделе.

После получения ошибки "Captcha needed" попросите пользователя пройти капчу, а затем повторите запрос к VK ID Captcha SDK, добавив в него `success_token` — токен успешного прохождения капчи, который вернёт VK ID Captcha SDK. Подробнее — в [инструкции по подключению](https://dev.vk.ru/ru/vkcaptcha/web/autointegration).

Если вы используете сценарий [server-to-server взаимодействия](https://dev.vk.ru/ru/vkcaptcha/servertoserver), вместе с токеном необходимо отправить значение параметра `remixstlid`, которое вы получили в ошибке капчи.

Подробнее о параметрах — в разделе [Параметры ошибки](captcha-error.md#%D0%9F%D0%B0%D1%80%D0%B0%D0%BC%D0%B5%D1%82%D1%80%D1%8B%20%D0%BE%D1%88%D0%B8%D0%B1%D0%BA%D0%B8).

**Пример ошибки**

```json
{
    "error": {
        "error_code": 14,
        "error_msg": "Captcha needed",
        "request_params": [
            {
                "key": "method",
                "value": "users.get"
            },
            {
                "key": "oauth",
                "value": "1"
            },
            {
                "key": "v",
                "value": "5.199"
            }
        ],
        "redirect_uri": "https://id.vk.com/not_robot_captcha?domain=vk.com&session_token=eyJhbGcikIjozH.0PlWiuiqx3xDGkxfjX3Khg&variant=popup&blank=1",
        "remixstlid": 9069780796616521905
    }
}
```

## <a id="Параметры ошибки"></a>Параметры ошибки

Параметры со звёздочкой (\*) — устаревшие, могут возвращаться, если ранее вы использовали обработку ошибки без параметра `redirect_uri`: с использованием идентификатора сессии `captcha_sid` и ссылки на изображение `captcha_img`. Сейчас такой способ не поддерживается — подключите [VK ID Captcha SDK](https://dev.vk.ru/ru/vkcaptcha/overview) и обрабатывайте ошибку капчи с использованием `redirect_uri`.

| Параметр | Описание, пример |
| --- | --- |
| `error_code` | Всегда принимает значение `14`. |
| `error_msg` | Всегда принимает значение `Captcha needed`. |
| `request_params` | Структура параметров, которые вы передали в запросе. Формат: `"key": "value"` |
| `redirect_uri` | Ссылка для инициализации сессии капчи, которая содержит токен сессии и все необходимые метаданные: • `domain` — домен, на котором будет использоваться капча. • `session_token` — токен сессии капчи. Время жизни — 5 минут. • `variant` — вид отображения капчи: `block` или `popup`. Формат ссылки: `https://id.vk.ru/not_robot_captcha?variant=(popup/block)&domain=(parent_domain)&session_token=(token_value)` |
| `remixstlid` | Временный идентификатор пользователя. Используется только в сценарии [server-to-server взаимодействия](https://dev.vk.ru/ru/vkcaptcha/servertoserver) с VK ID Captcha. Когда пользователь прошёл капчу, необходимо отправить значение `remixstlid` в повторном запросе к API ВКонтакте, вместе с `success_token`. |
| `captcha_sid`\* | Идентификатор сессии капчи. Пример: `575877115543` |
| `is_refresh_enabled`\* | Параметр показывает, отображается ли в интерфейсе кнопка обновления капчи-картинки. Доступные значения: • `true` – кнопка **Обновить картинку** отображается. • `false` – кнопка **Обновить картинку** скрыта. |
| `captcha_img`\* | Ссылка на изображение, которое нужно показать пользователю, чтобы он ввёл текст с этого изображения. Пример: `https://vk.ru/captcha.php?sid=575877115543&source=api_users_get&app_id=0&device_id=&s=1&resized=1` |
| `captcha_track`\* | Параметр содержит ссылку на звуковую дорожку. Возвращается, если `is_sound_captcha_available = true`. |
| `captcha_ts`\* | Служебный параметр. |
| `captcha_attempt`\* | Количество попыток прохождения капчи. Пример: `1` |
| `captcha_ratio`\* | Соотношение сторон картинки капчи. Пример: `2.6` |
| `is_sound_captcha_available`\* | Параметр показывает, есть ли в интерфейсе кнопка перехода с капчи-картинки на звуковую капчу. Доступные значения: • `true` – кнопка отображается. • `false` – кнопка не отображается. |

**Пример ошибки**

```json
{
    "error": {
        "error_code": 14,
        "error_msg": "Captcha needed",
        "request_params": [
            {
                "key": "method",
                "value": "users.get"
            },
            {
                "key": "oauth",
                "value": "1"
            },
            {
                "key": "v",
                "value": "5.199"
            }
        ],
        "redirect_uri": "",
        "captcha_sid": "575877115543",
        "remixstlid": 9069780796616521905,
        "is_refresh_enabled": false,
        "captcha_img": "https://vk.ru/captcha.php?sid=575877115543&source=api_users_get&app_id=0&device_id=&s=1&resized=1",
        "captcha_ts": 1738590926.995,
        "captcha_attempt": 1,
        "captcha_ratio": 2.6,
        "is_sound_captcha_available": false
    }
}
```
