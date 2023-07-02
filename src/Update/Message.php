<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Message
{
    /**
     * Unique message identifier inside this chat
     *
     * @var int
     */
    public int $message_id;
    /**
     * Optional. Unique identifier of a message thread to which the message belongs; for supergroups only
     *
     * @var int|null
     */
    public int|null $message_thread_id;
    /**
     * Optional. Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     *
     * @var User|null
     */
    public User|null $from;
    /**
     * Optional. Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     *
     * @var Chat|null
     */
    public Chat|null $sender_chat;
    /**
     * Date the message was sent in Unix time
     *
     * @var int
     */
    public int $date;
    /**
     * Conversation the message belongs to
     *
     * @var Chat
     */
    public Chat $chat;
    /**
     * Optional. For forwarded messages, sender of the original message
     *
     * @var User|null
     */
    public User|null $forward_from;
    /**
     * Optional. For messages forwarded from channels or from anonymous administrators, information about the original sender chat
     *
     * @var Chat|null
     */
    public Chat|null $forward_from_chat;
    /**
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     *
     * @var int|null
     */
    public int|null $forward_from_message_id;
    /**
     * Optional. For forwarded messages that were originally sent in channels or by an anonymous chat administrator, signature of the message sender if present
     *
     * @var string|null
     */
    public string|null $forward_signature;
    /**
     * Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     *
     * @var string|null
     */
    public string|null $forward_sender_name;
    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     *
     * @var int|null
     */
    public int|null $forward_date;
    /**
     * Optional. True, if the message is sent to a forum topic
     *
     * @var bool|null
     */
    public bool|null $is_topic_message;
    /**
     * Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
     *
     * @var bool|null
     */
    public bool|null $is_automatic_forward;
    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     *
     * @var Message|null
     */
    public Message|null $reply_to_message;
    /**
     * Optional. Bot through which the message was sent
     *
     * @var User|null
     */
    public User|null $via_bot;
    /**
     * Optional. Date the message was last edited in Unix time
     *
     * @var int|null
     */
    public int|null $edit_date;
    /**
     * Optional. True, if the message can't be forwarded
     *
     * @var bool|null
     */
    public bool|null $has_protected_content;
    /**
     * Optional. The unique identifier of a media message group this message belongs to
     *
     * @var string|null
     */
    public string|null $media_group_id;
    /**
     * Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
     *
     * @var string|null
     */
    public string|null $author_signature;
    /**
     * Optional. For text messages, the actual UTF-8 text of the message
     *
     * @var string|null
     */
    public string|null $text;
    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     *
     * @var array<MessageEntity>|null
     */
    public ?array $entities;
    /**
     * Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
     *
     * @var Animation|null
     */
    public Animation|null $animation;
    /**
     * Optional. Message is an audio file, information about the file
     *
     * @var Audio|null
     */
    public Audio|null $audio;
    /**
     * Optional. Message is a general file, information about the file
     *
     * @var Document|null
     */
    public Document|null $document;
    /**
     * Optional. Message is a photo, available sizes of the photo
     *
     * @var array<PhotoSize>|null
     */
    public ?array $photo;
    /**
     * Optional. Message is a sticker, information about the sticker
     *
     * @var Sticker|null
     */
    public Sticker|null $sticker;
    /**
     * Optional. Message is a video, information about the video
     *
     * @var Video|null
     */
    public Video|null $video;
    /**
     * Optional. Message is a video note, information about the video message
     *
     * @var VideoNote|null
     */
    public VideoNote|null $video_note;
    /**
     * Optional. Message is a voice message, information about the file
     *
     * @var Voice|null
     */
    public Voice|null $voice;
    /**
     * Optional. Caption for the animation, audio, document, photo, video or voice
     *
     * @var string|null
     */
    public string|null $caption;
    /**
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     *
     * @var array<MessageEntity>|null
     */
    public ?array $caption_entities;
    /**
     * Optional. True, if the message media is covered by a spoiler animation
     *
     * @var bool|null
     */
    public bool|null $has_media_spoiler;
    /**
     * Optional. Message is a shared contact, information about the contact
     *
     * @var Contact|null
     */
    public Contact|null $contact;
    /**
     * Optional. Message is a dice with random value
     *
     * @var Dice|null
     */
    public Dice|null $dice;
    /**
     * Optional. Message is a game, information about the game. More about games 
     *
     * @var Game|null
     */
    public Game|null $game;
    /**
     * Optional. Message is a native poll, information about the poll
     *
     * @var Poll|null
     */
    public Poll|null $poll;
    /**
     * Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
     *
     * @var Venue|null
     */
    public Venue|null $venue;
    /**
     * Optional. Message is a shared location, information about the location
     *
     * @var Location|null
     */
    public Location|null $location;
    /**
     * Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
     *
     * @var array<User>|null
     */
    public ?array $new_chat_members;
    /**
     * Optional. A member was removed from the group, information about them (this member may be the bot itself)
     *
     * @var User|null
     */
    public User|null $left_chat_member;
    /**
     * Optional. A chat title was changed to this value
     *
     * @var string|null
     */
    public string|null $new_chat_title;
    /**
     * Optional. A chat photo was change to this value
     *
     * @var array<PhotoSize>|null
     */
    public ?array $new_chat_photo;
    /**
     * Optional. Service message: the chat photo was deleted
     *
     * @var bool|null
     */
    public bool|null $delete_chat_photo;
    /**
     * Optional. Service message: the group has been created
     *
     * @var bool|null
     */
    public bool|null $group_chat_created;
    /**
     * Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
     *
     * @var bool|null
     */
    public bool|null $supergroup_chat_created;
    /**
     * Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
     *
     * @var bool|null
     */
    public bool|null $channel_chat_created;
    /**
     * Optional. Service message: auto-delete timer settings changed in the chat
     *
     * @var MessageAutoDeleteTimerChanged|null
     */
    public MessageAutoDeleteTimerChanged|null $message_auto_delete_timer_changed;
    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     *
     * @var int|null
     */
    public int|null $migrate_to_chat_id;
    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     *
     * @var int|null
     */
    public int|null $migrate_from_chat_id;
    /**
     * Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     *
     * @var Message|null
     */
    public Message|null $pinned_message;
    /**
     * Optional. Message is an invoice for a payment, information about the invoice. More about payments 
     *
     * @var Invoice|null
     */
    public Invoice|null $invoice;
    /**
     * Optional. Message is a service message about a successful payment, information about the payment. More about payments 
     *
     * @var SuccessfulPayment|null
     */
    public SuccessfulPayment|null $successful_payment;
    /**
     * Optional. Service message: a user was shared with the bot
     *
     * @var UserShared|null
     */
    public UserShared|null $user_shared;
    /**
     * Optional. Service message: a chat was shared with the bot
     *
     * @var ChatShared|null
     */
    public ChatShared|null $chat_shared;
    /**
     * Optional. The domain name of the website on which the user has logged in. More about Telegram Login 
     *
     * @var string|null
     */
    public string|null $connected_website;
    /**
     * Optional. Service message: the user allowed the bot added to the attachment menu to write messages
     *
     * @var WriteAccessAllowed|null
     */
    public WriteAccessAllowed|null $write_access_allowed;
    /**
     * Optional. Telegram Passport data
     *
     * @var PassportData|null
     */
    public PassportData|null $passport_data;
    /**
     * Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location.
     *
     * @var ProximityAlertTriggered|null
     */
    public ProximityAlertTriggered|null $proximity_alert_triggered;
    /**
     * Optional. Service message: forum topic created
     *
     * @var ForumTopicCreated|null
     */
    public ForumTopicCreated|null $forum_topic_created;
    /**
     * Optional. Service message: forum topic edited
     *
     * @var ForumTopicEdited|null
     */
    public ForumTopicEdited|null $forum_topic_edited;
    /**
     * Optional. Service message: forum topic closed
     *
     * @var ForumTopicClosed|null
     */
    public ForumTopicClosed|null $forum_topic_closed;
    /**
     * Optional. Service message: forum topic reopened
     *
     * @var ForumTopicReopened|null
     */
    public ForumTopicReopened|null $forum_topic_reopened;
    /**
     * Optional. Service message: the 'General' forum topic hidden
     *
     * @var GeneralForumTopicHidden|null
     */
    public GeneralForumTopicHidden|null $general_forum_topic_hidden;
    /**
     * Optional. Service message: the 'General' forum topic unhidden
     *
     * @var GeneralForumTopicUnhidden|null
     */
    public GeneralForumTopicUnhidden|null $general_forum_topic_unhidden;
    /**
     * Optional. Service message: video chat scheduled
     *
     * @var VideoChatScheduled|null
     */
    public VideoChatScheduled|null $video_chat_scheduled;
    /**
     * Optional. Service message: video chat started
     *
     * @var VideoChatStarted|null
     */
    public VideoChatStarted|null $video_chat_started;
    /**
     * Optional. Service message: video chat ended
     *
     * @var VideoChatEnded|null
     */
    public VideoChatEnded|null $video_chat_ended;
    /**
     * Optional. Service message: new participants invited to a video chat
     *
     * @var VideoChatParticipantsInvited|null
     */
    public VideoChatParticipantsInvited|null $video_chat_participants_invited;
    /**
     * Optional. Service message: data sent by a Web App
     *
     * @var WebAppData|null
     */
    public WebAppData|null $web_app_data;
    /**
     * Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     *
     * @var InlineKeyboardMarkup|null
     */
    public InlineKeyboardMarkup|null $reply_markup;
}
