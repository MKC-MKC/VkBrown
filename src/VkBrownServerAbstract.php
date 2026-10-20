<?php

declare(strict_types=1);

namespace Haikiri\VkBrown;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Haikiri\VkBrown\Api\ApiContractInterface;
use Haikiri\VkBrown\Api\VersionRegistry;
use Haikiri\VkBrown\Enums\ApiVersion;
use Haikiri\VkBrown\Exceptions\VkMainException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Methods\Documents;
use Haikiri\VkBrown\Methods\Groups;
use Haikiri\VkBrown\Methods\Messages;
use Haikiri\VkBrown\Methods\Photos;
use Haikiri\VkBrown\Methods\Uploads;
use Haikiri\VkBrown\Methods\Users;
use Haikiri\VkBrown\Methods\Wall;
use Haikiri\VkBrown\Objects\Group;
use Haikiri\VkBrown\Objects\Update;
use Haikiri\VkBrown\Services\ApiRequestService;
use Haikiri\VkBrown\Services\CallbackService;
use Haikiri\VkBrown\Services\HttpTransport;
use Haikiri\VkBrown\Services\LongPollService;
use Haikiri\VkBrown\Services\MessageService;
use Haikiri\VkBrown\Services\UpdateHydrator;
use InvalidArgumentException;
use RuntimeException;

abstract class VkBrownServerAbstract
{

	use Groups;
	use Messages;
	use Users;
	use Photos;
	use Documents;
	use Wall;
	use Uploads;

	protected readonly ApiRequestService $api;
	protected readonly ApiContractInterface $contract;
	protected readonly HttpTransport $transport;
	protected readonly MessageService $messageService;
	private readonly CallbackService $callback;
	private readonly int $groupId;
	private ?LongPollService $longPoll = null;

	public function __construct(
		private readonly string  $token,
		int|string               $groupId,
		private readonly ?string $confirmation = null,
		ApiVersion|string        $version = ApiVersion::V5_199,
		private readonly string  $url = "https://api.vk.ru",
		private readonly ?string $proxy = null,
		bool                     $debug = false,
		?ClientInterface         $client = null,
		?string                  $secret = null,
	)
	{
		$id = filter_var($groupId, FILTER_VALIDATE_INT);
		if ($id === false || $id <= 0) {
			throw new InvalidArgumentException("Необходим положительный ID сообщества.");
		}

		$this->groupId = $id;
		$this->contract = VersionRegistry::get($version);
		$this->transport = new HttpTransport($client ?? new Client());
		$this->api = new ApiRequestService($token, $this->contract, $this->transport, $url, $proxy, $debug);
		$this->messageService = new MessageService($this->api);
		$this->callback = new CallbackService($this->groupId, $confirmation, $secret);
	}

	/**
	 * Выполняем поддерживаемый API-метод выбранной версии с исходными именами параметров VK.
	 * Специализированные методы фасада дополнительно создают модели результатов.
	 * @param string $method Имя метода, например groups.getById.
	 * @param array<string, mixed> $params Параметры API без access_token.
	 * @param array<string, string> $headers Дополнительные HTTP-заголовки.
	 * @return Response Проверенный ответ API.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	abstract public function sendRequest(string $method, array $params = [], array $headers = []): Response;

	/**
	 * Получаем ключ сообщества, заданный при создании сервера.
	 * SDK передаёт его только API-серверу в заголовке Authorization, не в URL или отладочном выводе.
	 * @return string Ключ доступа сообщества.
	 * @see https://dev.vk.ru/ru/api/access-token/community-token
	 */
	public function getToken(): string
	{
		return $this->token;
	}

	/**
	 * Получаем положительный идентификатор сообщества бота.
	 * Для owner_id на стене используйте отрицательное значение этого идентификатора.
	 * @return int Идентификатор настроенного сообщества.
	 */
	public function getGroupId(): int
	{
		return $this->groupId;
	}

	/**
	 * Получаем базовый адрес API, указанный при создании сервера.
	 * Адрес Long Poll и адрес загрузки файлов выдаёт сам VK; они не заменяют базовый адрес API.
	 * @return string Базовый адрес, по умолчанию https://api.vk.ru.
	 * @see https://dev.vk.ru/ru/api/api-requests
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * Получаем точную версию контракта сервера.
	 * Эта же версия передаётся в параметре v API-запросов и проверяется во входящих событиях.
	 * @return string Номер версии, например 5.199.
	 * @see https://dev.vk.ru/ru/reference/versions
	 */
	public function getVersion(): string
	{
		return $this->contract->getVersion();
	}

	/**
	 * Получаем настроенную строку подтверждения Callback API.
	 * Для проверки входящего запроса и формирования ответа используйте getCallbackResponse().
	 * @return string|null Строка подтверждения; не запрашивается у VK автоматически.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function getConfirmation(): ?string
	{
		return $this->confirmation;
	}

	/**
	 * Получаем информацию о собственном сообществе бота тем же ключом доступа.
	 * Это удобный вызов groups.getById для настроенного groupId, а не users.get без user_ids.
	 * @param array|string|null $fields Дополнительные поля сообщества, например ["photo_200", "members_count"].
	 * @return Group Объект собственного сообщества.
	 * @throws VkResponseException Ответ не содержит ровно одно запрошенное сообщество.
	 * @see https://dev.vk.ru/ru/method/groups.getById
	 */
	public function getMe(array|string|null $fields = null): Group
	{
		$groups = $this->getGroupsById(groupIds: [$this->getGroupId()], fields: $fields)->getGroups();
		if (count($groups) !== 1 || $groups[0]->getId() !== $this->getGroupId()) {
			throw new VkResponseException("VK не вернул запрошенное сообщество бота.");
		}

		return $groups[0];
	}

	/**
	 * Проверяем принадлежность Callback-запроса группе и настроенную секретную строку.
	 * Выполняйте проверку до запуска команд бота и записи события в очередь.
	 * @param Update $update Полный конверт события VK.
	 * @return void
	 * @throws RuntimeException Неверная группа или secret.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function validateCallback(Update $update): void
	{
		$this->callback->validate($update);
	}

	/**
	 * Формируем ответ на проверенный Callback-запрос без самостоятельного HTTP-вывода.
	 * Возвращаем confirmation для подтверждения сервера или ok для обычного события.
	 * @param Update $update Полный входящий конверт VK.
	 * @return string Тело ответа Callback API.
	 * @throws RuntimeException Запрос не прошёл проверку либо отсутствует строка подтверждения.
	 * @see https://dev.vk.ru/ru/api/callback/getting-started
	 */
	public function getCallbackResponse(Update $update): string
	{
		return $this->callback->answer($update);
	}

	/**
	 * Получаем одну порцию событий Bots Long Poll с сохранением ключа сессии и нового ts.
	 * Метод не меняет подписки сообщества. Для этого вызывается setGroupLongPollSettings().
	 * @param int|string|null $offset Сохранённый ts для начала или продолжения сессии.
	 * @param int $timeout Параметр wait: от 0 до 90 секунд, по умолчанию 25.
	 * @return list<Update> Полные события с type, event_id, group_id, v и object.
	 * @throws VkMainException Ошибка соединения, события или протокола Long Poll.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function getUpdates(int|string|null $offset = null, int $timeout = 25): array
	{
		$this->longPoll ??= new LongPollService(
			api: $this->api,
			transport: $this->transport,
			hydrator: new UpdateHydrator($this->contract),
			groupId: $this->groupId,
		);

		return $this->longPoll->poll($offset, $timeout);
	}

	/**
	 * Получаем текущую позицию чтения Bots Long Poll для сохранения между запусками приложения.
	 * Значение обновляется только после успешного разбора порции событий или обработки failed по протоколу.
	 * @return string|null Последний ts либо null до первого запроса Long Poll.
	 * @see https://dev.vk.ru/ru/api/bots-long-poll/getting-started
	 */
	public function getLongPollTimestamp(): ?string
	{
		return $this->longPoll?->getTimestamp();
	}

	/**
	 * Задаём время ожидания обычного запроса API или загрузки файла.
	 * Long Poll использует wait + 10 секунд. Значение 0 отключает ограничение обычных запросов.
	 * @param float $seconds Тайм-аут в секундах.
	 * @return void
	 */
	public function setTimeout(float $seconds): void
	{
		$this->api->setTimeout($seconds);
	}

	/**
	 * Задаём время установления соединения для всех запросов SDK.
	 * Настройка не ограничивает время ожидания событий Long Poll после подключения.
	 * @param float $seconds Тайм-аут соединения в секундах; 0 отключает ограничение.
	 * @return void
	 */
	public function setConnectTimeout(float $seconds): void
	{
		$this->api->setConnectTimeout($seconds);
	}

}
