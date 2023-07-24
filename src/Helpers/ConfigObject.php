<?php

namespace Yhyasyrian\TelegramEasi\Helpers;

require_once __DIR__ . '/RequireFiles.php';
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
            "message" => "Message"
        ],
        "Chat" => [
            "photo" => "ChatPhoto",
            "pinned_message" => "Message",
            "permissions" => "ChatPermissions",
            "location" => "ChatLocation"
        ],
        "ChatJoinRequest" => [
            "invite_link" => "ChatInviteLink"
        ],
        "ChatMemberUpdated" => [
            "invite_link" => "ChatInviteLink"
        ],
        "ChosenInlineResult" => [
            "location" => "Location"
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
            "location" => "Location"
        ],
        "Location" => [
            "horizontal_accuracy" => "float"
        ],
        "Message" => [
            "from" => "User",
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
            "reply_markup" => "InlineKeyboardMarkup"
        ],
        "MessageEntity" => [
            "user" => "User"
        ],
        "OrderInfo" => [
            "shipping_address" => "ShippingAddress"
        ],
        "PreCheckoutQuery" => [
            "order_info" => "OrderInfo"
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
    public function __construct(string $name, array $array)
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
    private function configData(array $array, object $object): mixed
    {
        $this->nameClass = $this->getNameClass($object::class);
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (isset($this->types[$this->nameClass][$key])) {
                    $class = $this->types[$this->nameClass][$key];
                } else {
                    $class = $key;
                }
                $name = '\\Yhyasyrian\\TelegramEasi\\Updates\\' . $class;
                $object->{$key} = $this->configData($value, new $name());
            } else {
                $object->{$key} = $value;
            }
        }
        return $object;
    }
    /**
     * Return update
     * 
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }
}
