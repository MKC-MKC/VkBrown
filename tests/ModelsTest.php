<?php

declare(strict_types=1);

namespace Haikiri\VkBrown\Tests;

use Haikiri\VkBrown\Enums\UpdateEnum;
use Haikiri\VkBrown\Exceptions\UnsupportedVersionException;
use Haikiri\VkBrown\Exceptions\VkResponseException;
use Haikiri\VkBrown\Objects\ConversationList;
use Haikiri\VkBrown\Objects\GroupList;
use Haikiri\VkBrown\Objects\LongPollSettings;
use Haikiri\VkBrown\Objects\Message;
use Haikiri\VkBrown\Objects\MessageEvent;
use Haikiri\VkBrown\Objects\User;
use Haikiri\VkBrown\VkBrownClient;

final class ModelsTest extends HttpTestCase
{

	/**
	 * Читаем обезличенный реальный ответ тестового сообщества.
	 *
	 * Фикстуры сохраняют поля и типы данных фактического ответа API 5.199.
	 * @param string $name Имя фикстуры без расширения.
	 * @return array Исходное поле response.
	 */
	private function data(string $name): array
	{
		return $this->fixture($name)["response"];
	}

	public function testRealCommunityResponsePreservesGroupsProfilesAndAvatars(): void
	{
		$data = $this->data("groups-get-by-id");
		$result = new GroupList($data);
		self::assertSame($data, $result->getAsArray());
		self::assertSame($data["groups"][0]["id"], $result->getGroups()[0]->getId());
		self::assertSame($data["groups"][0]["photo_200"], $result->getGroups()[0]->getPhoto200());
		self::assertSame([], $result->getProfiles());
	}

	public function testRealUserResponseHasAvatarAndTypedCity(): void
	{
		$data = $this->data("users-get")[0];
		$user = new User($data);
		self::assertSame($data["id"], $user->getId());
		self::assertSame($data["photo_max"], $user->getPhotoMax());
		self::assertSame($data["city"]["id"], $user->getCity()->getId());
		self::assertSame($data["city"]["title"], $user->getCity()->getTitle());
		self::assertSame($data["is_closed"], $user->isClosed());
		self::assertNull($user->getDeactivated());
	}

	public function testRealConversationRetainsLastMessageAndExtendedProfiles(): void
	{
		$data = $this->data("messages-get-conversations");
		$result = new ConversationList($data);
		self::assertSame($data["count"], $result->getCount());
		self::assertCount(count($data["items"]), $result->getItems());
		self::assertSame($data["items"][0]["conversation"]["peer"]["id"], $result->getItems()[0]->getConversation()->getPeer()->getId());
		self::assertSame($data["items"][0]["last_message"]["id"], $result->getItems()[0]->getLastMessage()->getId());
		self::assertCount(count($data["profiles"]), $result->getProfiles());
		self::assertCount(count($data["groups"]), $result->getGroups());
	}

	public function testRealLongPollSettingsKeepsApiVersionAndEventSwitches(): void
	{
		$data = $this->data("long-poll-settings");
		$settings = new LongPollSettings($data);
		self::assertTrue($settings->isEnabled());
		self::assertSame("5.199", $settings->getApiVersion());
		self::assertSame($data["events"], $settings->getEvents());
	}

	public function testAbsentOptionalFieldsDoNotTurnIntoFakeIds(): void
	{
		$message = new Message([]);
		self::assertNull($message->getConversationMessageId());
		self::assertNull($message->getDateTime());
		self::assertNull($message->getKeyboard());
		self::assertNull($message->getReplyMessage());
		self::assertNull($message->getFormatData());
	}

	public function testMessagePayloadAndFormattingUseTheirDocumentedTypes(): void
	{
		$message = new Message([
			"date" => 0, "payload" => '{"action":"help","id":0,"enabled":false}',
			"format_data" => ["version" => "1", "items" => [["type" => "bold", "offset" => 0, "length" => 2]]],
		]);
		self::assertSame(["action" => "help", "id" => 0, "enabled" => false], $message->getPayload());
		self::assertSame("help", $message->getPayloadAction());
		self::assertSame(0, $message->getDateTime()->getTimestamp());
		self::assertSame(2, $message->getFormatData()->getItems()[0]->getLength());
	}

	public function testMalformedMessagePayloadFailsExplicitly(): void
	{
		$this->expectException(VkResponseException::class);
		(new Message(["payload" => "[]"]))->getPayload();
	}

	public function testWrongIdentifierTypeIsNotSilentlyCast(): void
	{
		$this->expectException(VkResponseException::class);
		(new Message(["conversation_message_id" => "123"]))->getConversationMessageId();
	}

	public function testObjectCannotBeUsedAsListOfAttachments(): void
	{
		$this->expectException(VkResponseException::class);
		(new Message(["attachments" => ["photo" => ["id" => 1]]]))->getAttachments();
	}

	public function testCallbackEventSeparatesDeliveryIdFromButtonEventId(): void
	{
		$data = $this->decodeJson(file_get_contents(__DIR__ . "/Response/messageEvent.json"));
		$update = (new VkBrownClient())->setUpdate($data)->getUpdate();
		self::assertSame(UpdateEnum::MESSAGE_EVENT, $update->getType());
		self::assertSame($data["group_id"], $update->getGroupId());
		self::assertSame($data["event_id"], $update->getEventId());
		self::assertSame($data["object"]["event_id"], $update->getMessageEvent()->getEventId());
		self::assertSame("wonderful_action_name", $update->getMessageEvent()->getPayloadAction());
		self::assertNull($update->getActualMessage());
	}

	public function testCallbackPayloadKeepsAnyTypeDeclaredByVk(): void
	{
		$event = new MessageEvent(["payload" => "custom-value"]);
		self::assertSame("custom-value", $event->getPayload());
		self::assertNull($event->getPayloadAction());
	}

	public function testNewMessageWithZeroIdIsRoutedByType(): void
	{
		$update = (new VkBrownClient())->setUpdate([
			"type" => "message_new", "group_id" => 123, "v" => "5.199", "event_id" => "delivery-1",
			"object" => ["message" => ["id" => 0, "conversation_message_id" => 42, "text" => "Тест"], "client_info" => ["keyboard" => true]],
		])->getUpdate();
		self::assertSame(0, $update->getActualMessage()->getId());
		self::assertSame(42, $update->getActualMessage()->getConversationMessageId());
		self::assertTrue($update->getClientInfo()->isKeyboard());
		self::assertNull($update->getMessageReply());
	}

	public function testConfirmationDoesNotRequireObjectOrVersion(): void
	{
		$update = (new VkBrownClient())->setUpdate(["type" => "confirmation", "group_id" => 123])->getUpdate();
		self::assertSame(UpdateEnum::CONFIRMATION, $update->getType());
		self::assertNull($update->getApiVersion());
		self::assertNull($update->getActualMessage());
	}

	public function testObjectWithoutEnvelopeIsRejected(): void
	{
		$this->expectException(VkResponseException::class);
		(new VkBrownClient())->setUpdate(["message" => ["id" => 1]]);
	}

	public function testAnotherEventVersionIsNotAcceptedAsFive199(): void
	{
		$this->expectException(UnsupportedVersionException::class);
		(new VkBrownClient())->setUpdate(["type" => "message_new", "group_id" => 123, "v" => "5.198", "object" => []]);
	}

}
