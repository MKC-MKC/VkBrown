<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Api\Contracts;

use Haikiri\VkBrown\Api\ApiContractInterface;
use InvalidArgumentException;
use JsonException;
use LogicException;

final readonly class V5199 implements ApiContractInterface
{
	private array $methods;

	public function __construct()
	{
		$contents = @file_get_contents(__DIR__ . "/../../../resources/api/5.199.json");
		if ($contents === false) throw new LogicException("В пакете отсутствует контракт VK API 5.199.");

		try {
			$data = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
		} catch (JsonException) {
			throw new LogicException("В пакете повреждён JSON контракта VK API 5.199.");
		}

		$this->methods = $data["methods"];
	}

	/**
	 * Получаем номер версии реализованного контракта.
	 *
	 * В 5.199 формат зависит также от параметров extended и множественных получателей.
	 * @return string Версия 5.199.
	 * @see https://dev.vk.ru/ru/reference/versions
	 */
	public function getVersion(): string
	{
		return "5.199";
	}

	/**
	 * Получаем правила передачи параметров конкретного API-метода.
	 *
	 * Неизвестный метод не отправляем как метод другой версии или другого типа авторизации.
	 * @param string $method Имя API-метода с учётом регистра, например groups.getById.
	 * @return array<string, array<string, mixed>> Параметры версии 5.199.
	 * @throws InvalidArgumentException Метод не входит в реализованный контракт бота сообщества.
	 * @see https://dev.vk.ru/ru/method
	 */
	public function getParameters(string $method): array
	{
		if (!array_key_exists($method, $this->methods)) {
			throw new InvalidArgumentException("Метод $method не поддерживается контрактом VK API 5.199.");
		}

		return $this->methods[$method]["parameters"];
	}

}
