<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Methods;

use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Objects\User;
use Haikiri\VkBrown\Services\ResponseHydrator;

trait Users
{

	/**
	 * Метод позволяет получить информацию о пользователях.
	 *
	 * Вызов выполняется с ключом сообщества. Неуказанные параметры сохраняют значения по умолчанию VK.
	 * При работе с ключом сообщества укажите user_ids. Для информации о самом боте используйте getMe(). Поля
	 * photo_* доступны тем же ключом, если VK разрешил их чтение.
	 * @param array|string|null $userIds Перечисленные через запятую идентификаторы пользователей или их короткие
	 * имена ( screen_name ). По умолчанию - идентификатор текущего пользователя.
	 * @param array|string|null $fields Список дополнительных полей профилей, которые необходимо вернуть. См.
	 * подробное описание . Доступные значения: • activities , • about , • blacklisted , • blacklisted_by_me , •
	 * books , • bdate , • can_be_invited_group , • can_post , • can_see_all_posts , • can_see_audio , •
	 * can_send_friend_request , • can_write_private_message , • career , • common_count , • connections , •
	 * contacts , • city , • crop_photo , • domain , • education , • exports , • followers_count , • friend_status
	 * , • has_photo , • has_mobile , • home_town , • photo_100 , • photo_200 , • photo_200_orig , • photo_400_orig
	 * , • photo_50 , • sex , • site , • schools , • screen_name , • status , • verified , • games , • interests ,
	 * • is_favorite , • is_friend , • is_hidden_from_feed , • last_seen , • maiden_name , • military , • movies ,
	 * • music , • nickname , • occupation , • online , • personal , • photo_id , • photo_max , • photo_max_orig ,
	 * • quotes , • relation , • relatives , • timezone , • tv , • universities , • is_verified .
	 * @param string|null $nameCase Падеж для склонения имени и фамилии пользователя. Возможные значения: •
	 * именительный - nom , • родительный - gen , • дательный - dat , • винительный - acc , • творительный - ins ,
	 * • предложный - abl . По умолчанию nom .
	 * @param int|string|null $fromGroupId Параметр устарел и больше не используется.
	 * @return list<User> Результат выполнения метода VK.
	 * @throws VkMainException Ошибка запроса или нарушение формата ответа.
	 * @see https://dev.vk.ru/ru/method/users.get
	 */
	public function getUsers(
		array|string|null $userIds = null,
		array|string|null $fields = null,
		string|null       $nameCase = null,
		int|string|null   $fromGroupId = null,
	): array
	{
		$params = [
			"user_ids" => $userIds,
			"fields" => $fields,
			"name_case" => $nameCase,
			"from_group_id" => $fromGroupId,
		];

		$response = $this->sendRequest("users.get", $params);
		return ResponseHydrator::models($response, User::class);
	}

}
