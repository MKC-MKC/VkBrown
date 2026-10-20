<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Api;

interface ApiContractInterface
{
	/**
	 * Получаем точный номер версии, определяющий параметры методов и формат объектов.
	 * Номер передаётся в обязательном параметре v каждого API-запроса.
	 * @return string Версия VK API, например 5.199.
	 * @see https://dev.vk.ru/ru/reference/versions
	 */
	public function getVersion(): string;

	/**
	 * Получаем правила передачи параметров метода выбранной версии.
	 * Контракт различает списки через запятую и сложные параметры в формате JSON-строки.
	 * @param string $method Полное имя метода, например messages.send.
	 * @return array<string, array<string, mixed>> Описания параметров по именам VK.
	 */
	public function getParameters(string $method): array;

}
