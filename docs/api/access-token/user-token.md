# Ключ доступа пользователя

[Оглавление](../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/access-token/user-token)

Ключ доступа (токен) пользователя используется для вызова методов VK API от имени определённого пользователя. Он определяет, какие [права доступа](user-token.md#%D0%9F%D1%80%D0%B0%D0%B2%D0%B0%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0) пользователь предоставил приложению.



Способ получения ключа доступа зависит от типа приложения, из которого выполняется запрос к VK API:

| Способ получения | Для каких приложений | Где использовать |
| --- | --- | --- |
| [Событие `VKWebAppGetAuthToken`](user-token.md#%D0%A1%D0%BE%D0%B1%D1%8B%D1%82%D0%B8%D0%B5%20VK%20Bridge) | Игра или мини-приложение | Клиентская часть игры или мини-приложения |
| [Сервис авторизации VK ID](user-token.md#%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81%20%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8%20VK%20ID) | Любое приложение или сайт (Standalone-приложение) | Клиентская или серверная часть приложения |

## <a id="Особенности работы"></a>Особенности работы

- Срок действия ключа доступа пользователя — 1 час.
- Ключ доступа, полученный через [событие `VKWebAppGetAuthToken`](user-token.md#%D0%A1%D0%BE%D0%B1%D1%8B%D1%82%D0%B8%D0%B5%20VK%20Bridge), предназначен для вызовов API из клиентской части игры или мини‑приложения.
- Для серверных запросов от имени пользователя используйте ключ, полученный через [сервис авторизации VK ID](user-token.md#%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81%20%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8%20VK%20ID).

## <a id="Права доступа"></a>Права доступа

- Права доступа определяют, с какими разделами данных VK может работать ключ доступа. Например, для получения номера телефона пользователя нужен ключ с правами `phone`. Подробнее — в разделе [Права доступа и приватность](https://dev.vk.ru/ru/api/privacy#%D0%9F%D1%80%D0%B0%D0%B2%D0%B0%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%B4%D0%BB%D1%8F%20%D0%BA%D0%BB%D1%8E%D1%87%D0%B0%20%D0%B4%D0%BE%D1%81%D1%82%D1%83%D0%BF%D0%B0%20%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D1%82%D0%B5%D0%BB%D1%8F).
- При получении ключа доступа через [сервис авторизации VK ID](user-token.md#%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81%20%D0%B0%D0%B2%D1%82%D0%BE%D1%80%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D0%B8%20VK%20ID) базовые права доступны сразу после создания приложения. Для получения расширенных прав требуется подтверждение профиля бизнеса.



  > Часть расширенных прав, например доступ к отдельным пользовательским данным VK ID, может предоставляться после индивидуального согласования. Для запроса таких прав напишите на [devsupport@corp.vk.com](mailto:devsupport@corp.vk.com).

## <a id="Получить ключ"></a>Получить ключ

### <a id="Событие VK Bridge"></a>Событие VK Bridge

Если вы запрашиваете ключ доступа пользователя для мини-приложения или игры VK, используйте событие `VKWebAppGetAuthToken` библиотеки VK Bridge.

Подробнее — в документации события [`VKWebAppGetAuthToken`](https://dev.vk.ru/ru/bridge/VKWebAppGetAuthToken).

### <a id="Сервис авторизации VK ID"></a>Сервис авторизации VK ID

Если вы запрашиваете ключ доступа пользователя для работы вашего сервиса или сайта, используйте [сервис авторизации VK ID](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2F).

Вы можете получить ключ одним из способов:

- **C помощью библиотеки VK ID SDK**



  Шаги получения ключа зависят от типа вашего приложения: [Web](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fweb%2Finstall), [Android](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fandroid%2Finstall), [iOS](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fios%2Finstall).



  — или —
- **Без SDK, используя HTTP-запрос**



  Шаги получения ключа зависят от типа вашего приложения: [Web](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fweb%2Fauth-without-sdk), [Android](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fandroid%2Fauth-without-sdk), [iOS](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fios%2Fauth-without-sdk).

> Мы рекомендуем использовать SDK-библиотеку. Она включает готовый код для отрисовки формы ввода имени пользователя и пароля, а также даёт возможность использовать вход по [One Tap](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fintro%2Fmain%23Vhod-po-One-Tap).
>
>
>
> Если не используете SDK, форму ввода понадобится реализовать самостоятельно, а вход по One Tap будет недоступен. При создании формы необходимо соблюдать [требования VK к дизайну кнопки](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fguidelines%2Fdesign-rules).

При запросе ключа доступа учитывайте права, включённые в настройках приложения в VK ID:

- Базовые — имя, фамилия, фото профиля, пол, дата рождения, почта.
- Расширенные — номер телефона.


Базовые права доступны сразу после создания приложения в сервисе авторизации VK ID. Для получения расширенных прав требуется подтверждение профиля бизнеса. Подробнее о создании приложения и настройке доступов — в [документации VK ID](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fcreate-application).

## <a id="Отозвать ключ доступа пользователя"></a>Отозвать ключ доступа пользователя

Если вы создавали ключ доступа пользователя в сервисе авторизации VK ID, вы можете отозвать выданные разрешения. Подробнее — в [документации VK ID](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fapi-description%23Otzyv-razreshenij-dostupov-polzovatelya-dlya-prilozheniya).

## <a id="Материалы по теме"></a>Материалы по теме

- [Справочник методов API VK ID](https://vk.ru/away.php?to=https%3A%2F%2Fid.vk.com%2Fabout%2Fbusiness%2Fgo%2Fdocs%2Fru%2Fvkid%2Flatest%2Fvk-id%2Fconnection%2Fapi-description)
