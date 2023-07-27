<?php

namespace Yhyasyrian\TelegramEasi\Helpers;

use Exception;

class ConfigObject
{
    /**
     * Result object
     * 
     * @var mixed
     */
    private mixed $result;
    /**
     * Types class for result
     * 
     * @var array<string[]>
     */
    private array $types = [
        "Animation" => [
            "thumbnail" => "PhotoSize"
        ],
        "Audio" => [
            "thumbnail" => "PhotoSize"
        ],
        "CallbackQuery" => [
            "message" => "Message",
            "from" => "User"
        ],
        "Chat" => [
            "photo" => "ChatPhoto",
            "pinned_message" => "Message",
            "permissions" => "ChatPermissions",
            "location" => "ChatLocation"
        ],
        "ChatInviteLink" => [
            "creator" => "User"
        ],
        "ChatJoinRequest" => [
            "invite_link" => "ChatInviteLink",
            "chat" => "Chat",
            "from" => "User"
        ],
        "ChatLocation" => [
            "location" => "Location"
        ],
        "ChatMemberAdministrator" => [
            "user" => "User"
        ],
        "ChatMemberBanned" => [
            "user" => "User"
        ],
        "ChatMemberLeft" => [
            "user" => "User"
        ],
        "ChatMemberMember" => [
            "user" => "User"
        ],
        "ChatMemberOwner" => [
            "user" => "User"
        ],
        "ChatMemberRestricted" => [
            "user" => "User"
        ],
        "ChatMemberUpdated" => [
            "invite_link" => "ChatInviteLink",
            "chat" => "Chat",
            "from" => "User",
            "old_chat_member" => "ChatMember",
            "new_chat_member" => "ChatMember"
        ],
        "ChosenInlineResult" => [
            "location" => "Location",
            "from" => "User"
        ],
        "Document" => [
            "thumbnail" => "PhotoSize"
        ],
        "EncryptedPassportElement" => [
            "front_side" => "PassportFile",
            "reverse_side" => "PassportFile",
            "selfie" => "PassportFile"
        ],
        "Game" => [
            "animation" => "Animation"
        ],
        "InlineKeyboardButton" => [
            "web_app" => "WebAppInfo",
            "login_url" => "LoginUrl",
            "switch_inline_query_chosen_chat" => "SwitchInlineQueryChosenChat",
            "callback_game" => "CallbackGame"
        ],
        "InlineQuery" => [
            "location" => "Location",
            "from" => "User"
        ],
        "Location" => [
            "horizontal_accuracy" => "float",
            "longitude" => "Float",
            "latitude" => "Float"
        ],
        "MaskPosition" => [
            "x_shift" => "float",
            "y_shift" => "float",
            "scale" => "float"
        ],
        "Message" => [
            "from" => "User",
            "new_chat_participant" => "User",
            "left_chat_participant" => "User",
            "new_chat_member" => "User",
            "sender_chat" => "Chat",
            "forward_from" => "User",
            "forward_from_chat" => "Chat",
            "reply_to_message" => "Message",
            "via_bot" => "User",
            "animation" => "Animation",
            "audio" => "Audio",
            "document" => "Document",
            "sticker" => "Sticker",
            "video" => "Video",
            "video_note" => "VideoNote",
            "voice" => "Voice",
            "contact" => "Contact",
            "dice" => "Dice",
            "game" => "Game",
            "poll" => "Poll",
            "venue" => "Venue",
            "location" => "Location",
            "left_chat_member" => "User",
            "message_auto_delete_timer_changed" => "MessageAutoDeleteTimerChanged",
            "pinned_message" => "Message",
            "invoice" => "Invoice",
            "successful_payment" => "SuccessfulPayment",
            "user_shared" => "UserShared",
            "chat_shared" => "ChatShared",
            "write_access_allowed" => "WriteAccessAllowed",
            "passport_data" => "PassportData",
            "proximity_alert_triggered" => "ProximityAlertTriggered",
            "forum_topic_created" => "ForumTopicCreated",
            "forum_topic_edited" => "ForumTopicEdited",
            "forum_topic_closed" => "ForumTopicClosed",
            "forum_topic_reopened" => "ForumTopicReopened",
            "general_forum_topic_hidden" => "GeneralForumTopicHidden",
            "general_forum_topic_unhidden" => "GeneralForumTopicUnhidden",
            "video_chat_scheduled" => "VideoChatScheduled",
            "video_chat_started" => "VideoChatStarted",
            "video_chat_ended" => "VideoChatEnded",
            "video_chat_participants_invited" => "VideoChatParticipantsInvited",
            "web_app_data" => "WebAppData",
            "reply_markup" => "InlineKeyboardMarkup",
            "chat" => "Chat"
        ],
        "MessageEntity" => [
            "user" => "User"
        ],
        "OrderInfo" => [
            "shipping_address" => "ShippingAddress"
        ],
        "PassportData" => [
            "credentials" => "EncryptedCredentials"
        ],
        "PollAnswer" => [
            "user" => "User"
        ],
        "PreCheckoutQuery" => [
            "order_info" => "OrderInfo",
            "from" => "User"
        ],
        "ProximityAlertTriggered" => [
            "traveler" => "User",
            "watcher" => "User"
        ],
        "ShippingQuery" => [
            "from" => "User",
            "shipping_address" => "ShippingAddress"
        ],
        "Sticker" => [
            "thumbnail" => "PhotoSize",
            "premium_animation" => "File",
            "mask_position" => "MaskPosition"
        ],
        "SuccessfulPayment" => [
            "order_info" => "OrderInfo"
        ],
        "Update" => [
            "message" => "Message",
            "edited_message" => "Message",
            "channel_post" => "Message",
            "edited_channel_post" => "Message",
            "inline_query" => "InlineQuery",
            "chosen_inline_result" => "ChosenInlineResult",
            "callback_query" => "CallbackQuery",
            "shipping_query" => "ShippingQuery",
            "pre_checkout_query" => "PreCheckoutQuery",
            "poll" => "Poll",
            "poll_answer" => "PollAnswer",
            "my_chat_member" => "ChatMemberUpdated",
            "chat_member" => "ChatMemberUpdated",
            "chat_join_request" => "ChatJoinRequest"
        ],
        "Venue" => [
            "location" => "Location"
        ],
        "Video" => [
            "thumbnail" => "PhotoSize"
        ],
        "VideoNote" => [
            "thumbnail" => "PhotoSize"
        ]
    ];
    /**
     * Get name class
     * 
     * @var string
     */
    private string $nameClass;
    /**
     * Start config object
     */
    public function __construct(string $name, array|\stdClass $array)
    {
        $this->result = $this->configData($array, new $name());
    }
    /**
     * Get name class
     * 
     * @return string
     */
    private function getNameClass(string $class): string
    {
        return str_replace('Yhyasyrian\\TelegramEasi\\Updates\\', '', $class);
    }
    /**
     * Config data with this function
     * 
     * @return mixed
     */
    private function configData(array|\stdClass $array, object $object): mixed
    {
        if (is_a($array, \stdClass::class)) {
            $array = json_decode(json_encode($array), true);
        }
        $this->nameClass = $this->getNameClass($object::class);
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (isset($this->types[$this->nameClass][$key])) {
                    $class = $this->types[$this->nameClass][$key];
                } else if (isset($this->types[$this->getNameClass($object::class)][$key])) {
                    $class = $this->types[$this->getNameClass($object::class)][$key];
                } else {
                    if ($key == 'entities') {
                        $object->{$key} = $this->configEntities($value);
                        continue;
                    } else if (isset($value[0])) {
                        $object->{$key} = $this->configArray($value, $object::class);
                        continue;
                    } else {
                        $class = $key;
                    }
                }
                $name = '\\Yhyasyrian\\TelegramEasi\\Updates\\' . $class;
                if ((isset($value[0]) and is_array($value[0])) or $key == 'reply_markup') {
                    $object->{$key} = $this->configArray($value, $name);
                } else {
                    try {
                        $object->{$key} = $this->configData($value, new $name());
                    } catch (\Throwable $th) {
                        throw new Exception($th->getMessage() . " The Class isn't found");
                    }
                }
            } else {
                $object->{$key} = $value;
            }
        }
        return $object;
    }
    /**
     * Config entities array
     * 
     * @return \YhyaSyrian\TelegramEasi\Updates\MessageEntity[]
     */
    private function configEntities(array $array): array
    {
        $MessageEntity = [];
        require_once __DIR__ . '/../Updates/MessageEntity.php';
        foreach ($array as $key => $value) {
            $MessageEntity[] = $this->configData($value, (new \YhyaSyrian\TelegramEasi\Updates\MessageEntity));
        }
        return $MessageEntity;
    }
    /**
     * Config array else
     * 
     * @return array<array>
     */
    private function configArray(array $array, string $name): array
    {
        $MessageEntity = [];
        foreach ($array as $key => $value) {
            $MessageEntity[] = $this->configData($value, (new $name()));
        }
        return $MessageEntity;
    }
    /**
     * Return Result
     * 
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }
    /**
     * Return update
     * 
     * @return \YhyaSyrian\TelegramEasi\Updates\Update
     */
    public function getUpdate(): \YhyaSyrian\TelegramEasi\Updates\Update
    {
        return $this->result;
    }
}
