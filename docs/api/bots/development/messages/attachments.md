# Вложения в сообщениях

[Оглавление](../../../../README.md) · [Оригинал VK](https://dev.vk.ru/ru/api/bots/development/messages/attachments)

## <a id="Параметр attachment"></a>Параметр `attachment`

Метод [`messages.send`](../../../../method/messages.send.md) принимает параметр `attachment`. Чтобы отправить картинку, аудиозапись или любое другое вложение, укажите его тип и идентификатор в формате: `идентификатор_владельца` + `_` + `идентификатор_объекта`. Например: `photo-123456_654231`.

Вы можете использовать публичные объекты, которые уже были загружены ВКонтакте, например, прислать фотографию со стены своего сообщества или видеозапись из поиска или загрузить новое вложение.

## <a id="Загрузка фотографии"></a>Загрузка фотографии

Есть несколько способов загрузки изображений.

Чтобы отправить одно и то же изображение сразу многим собеседникам, например для рассылки, используйте один из следующих способов:

- Предварительно загрузите изображение в публичный альбом того же сообщества и используйте в `attachment` идентификатор этой фотографии.
- Загрузите изображение с помощью [`photos.getMessagesUploadServer`](../../../../method/photos.getMessagesUploadServer.md) без указания `peer_id`, а затем следуйте [инструкции](../../../upload/photo-in-message.md). Изображение будет загружено в скрытый альбом группы.

Чтобы загрузить и отправить изображение определенному пользователю, используйте метод с идентификатором получателя, а затем следуйте [инструкции](../../../upload/photo-in-message.md).

**Обратите внимание:**

- После загрузки `owner_id` фотографии будет равен переданному `peer_id`. Это правильное поведение. Для таких загрузок нет лимита: вы можете загружать подобным способом фотографии для неограниченного числа пользователей.
- Каждый раз при указании в `attachment` фотографии не из сообщества, изображение загружается повторно от имени сообщества. Для таких загрузок существует лимит — стоит рассчитывать не более чем на 7 тысяч загрузок в сутки.

### <a id="Пример на PHP"></a>Пример на PHP

```php
function vkApi_photosGetMessagesUploadServer($peer_id) {
  return _vkApi_call('photos.getMessagesUploadServer', array(
    'peer_id' => $peer_id,
  ));
}

function vkApi_photosSaveMessagesPhoto($photo, $server, $hash) {
  return _vkApi_call('photos.saveMessagesPhoto', array(
    'photo'  => $photo,
    'server' => $server,
    'hash'   => $hash,
  ));
}

function vkApi_upload($url, $file_name) {
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, array('file' => new CURLfile($file_name)));
  $json = curl_exec($curl);
  curl_close($curl);
  return json_decode($json, true);
}

// Загрузка фотографии в сообщение от бота
function uploadPhoto($user_id, $file_name) {
  $upload_server_response = vkApi_photosGetMessagesUploadServer($user_id);
  $upload_response = vkApi_upload($upload_server_response['upload_url'], $file_name);
  $save_response = vkApi_photosSaveMessagesPhoto($upload_response['photo'], $upload_response['server'], $upload_response['hash']);
  return array_pop($save_response);
}

$photo = uploadPhoto(494075, 'cats.jpg');
```

Пример функции `_vkApi_call`описан в разделе [Отправка сообщений](../messages.md#%D0%9F%D1%80%D0%B8%D0%BC%D0%B5%D1%80%20%D0%BD%D0%B0%20PHP).

## <a id="Загрузка документа"></a>Загрузка документа

Чтобы загрузить новый документ для отправки, используйте метод [`docs.getMessagesUploadServer`](../../../../method/docs.getMessagesUploadServer.md) с идентификатором получателя в параметре `peer_id`, а затем следуйте [инструкции](https://dev.vk.ru/ru/api/upload/document-in-profile).

Обратите внимание, что после загрузки `owner_id` документа будет равен переданному `peer_id`. Это нужно, чтобы ваш бот мог загружать новые документы для неограниченного числа пользователей.

### <a id="Пример на PHP"></a>Пример на PHP

```php
function vkApi_docsGetMessagesUploadServer($peer_id, $type) {
  return _vkApi_call('docs.getMessagesUploadServer', array(
    'peer_id' => $peer_id,
    'type'    => $type,
  ));
}

function vkApi_docsSave($file, $title) {
  return _vkApi_call('docs.save', array(
    'file'  => $file,
    'title' => $title,
  ));
}

// Загрузка голосового сообщения от бота
function uploadVoiceMessage($user_id, $file_name) {
  $upload_server_response = vkApi_docsGetMessagesUploadServer($user_id, 'audio_message');
  $upload_response = vkApi_upload($upload_server_response['upload_url'], $file_name);
  $save_response = vkApi_docsSave($upload_response['file'], 'Voice message');
  return array_pop($save_response);
}

$voice_message = uploadVoiceMessage(494075, 'voice_msg.ogg');
```

Пример функции `_vkApi_call`описан в разделе [Отправка сообщений](../messages.md#%D0%9F%D1%80%D0%B8%D0%BC%D0%B5%D1%80%20%D0%BD%D0%B0%20PHP).

## <a id="Материалы по теме"></a>Материалы по теме

- [Быстрый старт](../../getting-started.md)
- [Отправка сообщений](../messages.md)
- [Управление сообщениями](management.md)
- [Пользовательский контент и шаблоны](user-content.md)
- [Клавиатура](../keyboard.md)
