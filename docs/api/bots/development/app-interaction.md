# Взаимодействие с приложением

[Оглавление](../../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/bots/development/app-interaction)

Если сценарий сложно или неудобно реализовать в переписке, подключите к боту [мини-приложение](https://dev.vk.ru/ru/mini-apps/getting-started). Например, в мини-приложении можно оформить раздел настроек бота или организовать заполнение заявки вместо обмена сообщениями.

## <a id="Особенности работы"></a>Особенности работы

- Для обмена данными мини‑приложение должно быть [установлено в сообщество](https://dev.vk.ru/ru/mini-apps/settings/general/information#%D0%97%D0%B0%D0%BF%D1%83%D1%81%D0%BA%20%D0%BF%D1%80%D0%B8%D0%BB%D0%BE%D0%B6%D0%B5%D0%BD%D0%B8%D1%8F%20%D0%B8%D0%B7%20%D1%81%D0%BE%D0%BE%D0%B1%D1%89%D0%B5%D1%81%D1%82%D0%B2%D0%B0).
- Бот должен быть настроен на приём событий через [Callback API](../../callback/getting-started.md) или [Long Poll API](../../bots-long-poll/getting-started.md).
- Бот не может отправлять данные в мини‑приложение напрямую. Если мини-приложению нужно получать данные от бота, используйте собственный API.

## <a id="Передача данных из мини‑приложения в бота"></a>Передача данных из мини‑приложения в бота

Данные из мини-приложения можно передать при помощи события [`VKWebAppSendPayload`](https://dev.vk.ru/ru/bridge/VKWebAppSendPayload) библиотеки VK Bridge.

После вызова метода бот получит событие [`message_new`](../../community-events/json-schema.md#message_new). Данные из мини-приложения придут в виде JSON-строки в поле `payload`.

## <a id="Запуск мини‑приложения из бота"></a>Запуск мини‑приложения из бота

Чтобы при запуске мини‑приложения пользователь сразу попадал в нужный раздел, передавайте параметр [`hash`](keyboard/key-types.md#open_app).

Подробнее о навигации и работе с экранами мини-приложения — в разделе [Библиотека `vk-mini-apps-router`](https://dev.vk.ru/ru/libraries/router).

## <a id="Материалы по теме"></a>Материалы по теме

- [Клавиатура бота](keyboard.md)
- [Библиотека `vk-mini-apps-router`](https://dev.vk.ru/ru/libraries/router)
- [Событие `VKWebAppSendPayload`](https://dev.vk.ru/ru/bridge/VKWebAppSendPayload)
