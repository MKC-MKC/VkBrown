<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Services;

use Haikiri\VkBrown\Enums\UpdateEnum;
use Haikiri\VkBrown\Objects\Update;
use RuntimeException;

final readonly class CallbackService
{

	public function __construct(private int $groupId, private ?string $confirmation, private ?string $secret)
	{
	}

	/**
	 * Проверяем адресата и секрет Callback-запроса до выполнения команд бота.
	 * `group_id` должен совпасть с сообществом сервера. Если настроен secret, используем точное
	 * сравнение с постоянным временем и не принимаем запрос без этого поля.
	 * @param Update $update Полный конверт входящего Callback-события, включая confirmation.
	 * @return void
	 * @throws RuntimeException Запрос относится к другой группе или не прошёл проверку секрета.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function validate(Update $update): void
	{
		if ($update->getGroupId() !== $this->groupId) {
			throw new RuntimeException("Callback-запрос относится к другому сообществу.");
		}

		if ($this->secret !== null && ($update->getSecret() === null || !hash_equals($this->secret, $update->getSecret()))) {
			throw new RuntimeException("Callback-запрос не прошёл проверку secret.");
		}
	}

	/**
	 * Формируем текст HTTP-ответа, требуемый Callback API после проверки входящего запроса.
	 * Для confirmation возвращаем настроенную строку подтверждения, для остальных событий - ok.
	 * Не выводим ответ сами и не подтверждаем доставку до решения вызывающего приложения.
	 * @param Update $update Проверяемый конверт Callback-события.
	 * @return string Код подтверждения или точная строка ok.
	 * @throws RuntimeException Не пройдена проверка запроса или отсутствует строка подтверждения.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function answer(Update $update): string
	{
		$this->validate($update);
		if ($update->getType() !== UpdateEnum::CONFIRMATION) return "ok";

		if ($this->confirmation === null || $this->confirmation === "") {
			throw new RuntimeException("Не настроена строка подтверждения Callback API.");
		}

		return $this->confirmation;
	}

}
