<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Route;

class GroupsRoute extends AbstractRoute
{

	/**
	 * Метод добавляет адрес сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function addAddress(array $params = []): mixed
	{
		return $this->request("groups.addAddress", $params);
	}

	/**
	 * Метод добавляет callback-сервер.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function addCallbackServer(array $params = []): mixed
	{
		return $this->request("groups.addCallbackServer", $params);
	}

	/**
	 * Метод удаляет адрес сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteAddress(array $params = []): mixed
	{
		return $this->request("groups.deleteAddress", $params);
	}

	/**
	 * Метод удаляет callback-сервер.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function deleteCallbackServer(array $params = []): mixed
	{
		return $this->request("groups.deleteCallbackServer", $params);
	}

	/**
	 * Метод отключает online-статус сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function disableOnline(array $params = []): mixed
	{
		return $this->request("groups.disableOnline", $params);
	}

	/**
	 * Метод редактирует настройки сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function edit(array $params = []): mixed
	{
		return $this->request("groups.edit", $params);
	}

	/**
	 * Метод редактирует адрес сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function editAddress(array $params = []): mixed
	{
		return $this->request("groups.editAddress", $params);
	}

	/**
	 * Метод редактирует callback-сервер.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function editCallbackServer(array $params = []): mixed
	{
		return $this->request("groups.editCallbackServer", $params);
	}

	/**
	 * Метод включает online-статус сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function enableOnline(array $params = []): mixed
	{
		return $this->request("groups.enableOnline", $params);
	}

	/**
	 * Метод возвращает чёрный список сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getBanned(array $params = []): mixed
	{
		return $this->request("groups.getBanned", $params, ["fields"]);
	}

	/**
	 * Метод возвращает сообщества по идентификаторам.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getById(array $params = []): mixed
	{
		return $this->request("groups.getById", $params, ["group_ids", "fields"]);
	}

	/**
	 * Метод возвращает код подтверждения callback API.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getCallbackConfirmationCode(array $params = []): mixed
	{
		return $this->request("groups.getCallbackConfirmationCode", $params);
	}

	/**
	 * Метод возвращает callback-сервера сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getCallbackServers(array $params = []): mixed
	{
		return $this->request("groups.getCallbackServers", $params, ["server_ids"]);
	}

	/**
	 * Метод возвращает настройки callback API.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getCallbackSettings(array $params = []): mixed
	{
		return $this->request("groups.getCallbackSettings", $params);
	}

	/**
	 * Метод возвращает Long Poll сервер сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getLongPollServer(array $params = []): mixed
	{
		return $this->request("groups.getLongPollServer", $params);
	}

	/**
	 * Метод возвращает настройки Long Poll.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getLongPollSettings(array $params = []): mixed
	{
		return $this->request("groups.getLongPollSettings", $params);
	}

	/**
	 * Метод возвращает участников сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getMembers(array $params = []): mixed
	{
		return $this->request("groups.getMembers", $params, ["fields"]);
	}

	/**
	 * Метод возвращает online-статус сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getOnlineStatus(array $params = []): mixed
	{
		return $this->request("groups.getOnlineStatus", $params);
	}

	/**
	 * Метод возвращает список тегов пользователей.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function getTagList(array $params = []): mixed
	{
		return $this->request("groups.getTagList", $params);
	}

	/**
	 * Метод возвращает права текущего group token.
	 *
	 * @return mixed
	 */
	public function getTokenPermissions(): mixed
	{
		return $this->request("groups.getTokenPermissions");
	}

	/**
	 * Метод проверяет членство пользователя в сообществе.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function isMember(array $params = []): mixed
	{
		return $this->request("groups.isMember", $params, ["user_ids"]);
	}

	/**
	 * Метод обновляет настройки callback API.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function setCallbackSettings(array $params = []): mixed
	{
		return $this->request("groups.setCallbackSettings", $params);
	}

	/**
	 * Метод обновляет настройки Long Poll.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function setLongPollSettings(array $params = []): mixed
	{
		return $this->request("groups.setLongPollSettings", $params);
	}

	/**
	 * Метод обновляет общие настройки сообщества.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function setSettings(array $params = []): mixed
	{
		return $this->request("groups.setSettings", $params);
	}

	/**
	 * Метод сохраняет заметку по пользователю.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function setUserNote(array $params = []): mixed
	{
		return $this->request("groups.setUserNote", $params);
	}

	/**
	 * Метод создаёт тег пользователя.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function tagAdd(array $params = []): mixed
	{
		return $this->request("groups.tagAdd", $params);
	}

	/**
	 * Метод привязывает пользователя к тегу.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function tagBind(array $params = []): mixed
	{
		return $this->request("groups.tagBind", $params);
	}

	/**
	 * Метод удаляет тег пользователя.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function tagDelete(array $params = []): mixed
	{
		return $this->request("groups.tagDelete", $params);
	}

	/**
	 * Метод переименовывает тег пользователя.
	 *
	 * @param array $params
	 * @return mixed
	 */
	public function tagUpdate(array $params = []): mixed
	{
		return $this->request("groups.tagUpdate", $params);
	}

}
