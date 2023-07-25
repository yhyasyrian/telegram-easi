<?php

namespace Yhyasyrian\TelegramEasi\Method;

class Api
{
    /**
     * Function send request to API Telegram
     * 
     * @var callable file_get_contents
     */
    public $request = file_get_contents::class;
    /**
     * Set Token Bot
     * 
     * @var string
     */
    public string $token;
    /**
     * Set send request to API Telegram and use that
     * 
     * @param callable|string $request Function send request to API Telegram
     * @param string $token Set Token Bot
     */
    public function __construct(callable|string $request = file_get_contents::class, string $token)
    {
        $this->request = $request;
        $this->token = $token;
    }
    /**
     * Call To API Telegram
     * 
     * @param array $data data send to API Telegram
     * @param string $metohd name method
     * @return Bot
     */
    public function call(array $data = [], string $metohd): Bot
    {
        $call = $this->request;
        $return = $call('https://api.telegram.org/bot' . $this->token . '/' . $metohd . '?' . http_build_query($data));
        if (is_string($return)) {
            $return = json_decode($return);
        }
        return (new Bot($return));
    }
    /**
     * Use this method to receive incoming updates using long polling (<a href="https://en.wikipedia.org/wiki/Push_technology#Long_polling">wiki</a>). Returns an Array of <a href="#update">Update</a> objects.
     * @param int|null $offset OptionalIdentifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will be forgotten.
     * @param int|null $limit OptionalLimits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @param int|null $timeout OptionalTimeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only.
     * @param string|null $allowed_updates OptionalA JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted updates may be received for a short period of time.
     * @return Bot
     */
    public function getUpdates(int|null $offset = 0, int|null $limit = 0, int|null $timeout = 0, ?string $allowed_updates = null): Bot
    {
        return $this->call(['offset' => $offset, 'limit' => $limit, 'timeout' => $timeout, 'allowed_updates' => $allowed_updates,], __FUNCTION__);
    }
    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized <a href="#update">Update</a>. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns <em>True</em> on success.</p><p>If you&#39;d like to make sure that the webhook was set by you, you can specify secret data in the parameter <em>secret_token</em>. If specified, the request will contain a header “X-Telegram-Bot-Api-Secret-Token” with the secret token as content.
     * @param string $url YesHTTPS URL to send updates to. Use an empty string to remove webhook integration
     * @param string|null $certificate OptionalUpload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
     * @param string|null $ip_address OptionalThe fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
     * @param int|null $max_connections OptionalThe maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
     * @param string|null $allowed_updates OptionalA JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
     * @param bool|null $drop_pending_updates OptionalPass True to drop all pending updates
     * @param string|null $secret_token OptionalA secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook set by you.
     * @return Bot
     */
    public function setWebhook(string $url, string|null $certificate = '', string|null $ip_address = '', int|null $max_connections = 0, ?string $allowed_updates = null, bool|null $drop_pending_updates = false, string|null $secret_token = ''): Bot
    {
        return $this->call(['url' => $url, 'certificate' => $certificate, 'ip_address' => $ip_address, 'max_connections' => $max_connections, 'allowed_updates' => $allowed_updates, 'drop_pending_updates' => $drop_pending_updates, 'secret_token' => $secret_token,], __FUNCTION__);
    }
    /**
     * Use this method to remove webhook integration if you decide to switch back to <a href="#getupdates">getUpdates</a>. Returns <em>True</em> on success.
     * @param bool|null $drop_pending_updates OptionalPass True to drop all pending updates
     * @return Bot
     */
    public function deleteWebhook(bool|null $drop_pending_updates = false): Bot
    {
        return $this->call(['drop_pending_updates' => $drop_pending_updates,], __FUNCTION__);
    }
    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a <a href="#webhookinfo">WebhookInfo</a> object. If the bot is using <a href="#getupdates">getUpdates</a>, will return an object with the <em>url</em> field empty.</p><h4><a class="anchor" name="webhookinfo" href="#webhookinfo"><i class="anchor-icon"></i></a>WebhookInfo</h4><p>Describes the current status of a webhook.
     * @param string $url Webhook URL, may be empty if webhook is not set up
     * @param bool $has_custom_certificate True, if a custom certificate was provided for webhook certificate checks
     * @param int $pending_update_count Number of updates awaiting delivery
     * @param string|null $ip_address Optional. Currently used webhook IP address
     * @param int|null $last_error_date Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
     * @param string|null $last_error_message Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
     * @param int|null $last_synchronization_error_date Optional. Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
     * @param int|null $max_connections Optional. The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     * @param string|null $allowed_updates Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member
     * @return Bot
     */
    public function getWebhookInfo(string $url, bool $has_custom_certificate, int $pending_update_count, string|null $ip_address = '', int|null $last_error_date = 0, string|null $last_error_message = '', int|null $last_synchronization_error_date = 0, int|null $max_connections = 0, ?string $allowed_updates = null): Bot
    {
        return $this->call(['url' => $url, 'has_custom_certificate' => $has_custom_certificate, 'pending_update_count' => $pending_update_count, 'ip_address' => $ip_address, 'last_error_date' => $last_error_date, 'last_error_message' => $last_error_message, 'last_synchronization_error_date' => $last_synchronization_error_date, 'max_connections' => $max_connections, 'allowed_updates' => $allowed_updates,], __FUNCTION__);
    }
    /**
     * This object represents a unique message identifier.
     * @param int $message_id Unique message identifier
     * @return Bot
     */
    public function MessageId(int $message_id): Bot
    {
        return $this->call(['message_id' => $message_id,], __FUNCTION__);
    }
    /**
     * This object contains information about one answer option in a poll.
     * @param string $text Option text, 1-100 characters
     * @param int $voter_count Number of users that voted for this option
     * @return Bot
     */
    public function PollOption(string $text, int $voter_count): Bot
    {
        return $this->call(['text' => $text, 'voter_count' => $voter_count,], __FUNCTION__);
    }
    /**
     * This object represent a user&#39;s profile pictures.
     * @param int $total_count Total number of profile pictures the target user has
     * @param string $photos Requested profile pictures (in up to 4 sizes each)
     * @return Bot
     */
    public function UserProfilePhotos(int $total_count, ?string $photos = null): Bot
    {
        return $this->call(['total_count' => $total_count, 'photos' => $photos,], __FUNCTION__);
    }
    /**
     * This object represents a <a href="/bots/features#keyboards">custom keyboard</a> with reply options (see <a href="/bots/features#keyboards">Introduction to bots</a> for details and examples).
     * @param string $keyboard Array of button rows, each represented by an Array of KeyboardButton objects
     * @param bool|null $is_persistent Optional. Requests clients to always show the keyboard when the regular keyboard is hidden. Defaults to false, in which case the custom keyboard can be hidden and opened with a keyboard icon.
     * @param bool|null $resize_keyboard Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     * @param bool|null $one_time_keyboard Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available, but clients will automatically display the usual letter-keyboard in the chat - the user can press a special button in the input field to see the custom keyboard again. Defaults to false.
     * @param string|null $input_field_placeholder Optional. The placeholder to be shown in the input field when the keyboard is active; 1-64 characters
     * @param bool|null $selective Optional. Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.Example: A user requests to change the bot's language, bot replies to the request with a keyboard to select the new language. Other users in the group don't see the keyboard.
     * @return Bot
     */
    public function ReplyKeyboardMarkup(?string $keyboard = null, bool|null $is_persistent = false, bool|null $resize_keyboard = false, bool|null $one_time_keyboard = false, string|null $input_field_placeholder = '', bool|null $selective = false): Bot
    {
        return $this->call(['keyboard' => $keyboard, 'is_persistent' => $is_persistent, 'resize_keyboard' => $resize_keyboard, 'one_time_keyboard' => $one_time_keyboard, 'input_field_placeholder' => $input_field_placeholder, 'selective' => $selective,], __FUNCTION__);
    }
    /**
     * This object represents one button of the reply keyboard. For simple text buttons, <em>String</em> can be used instead of this object to specify the button text. The optional fields <em>web_app</em>, <em>request_user</em>, <em>request_chat</em>, <em>request_contact</em>, <em>request_location</em>, and <em>request_poll</em> are mutually exclusive.
     * @param string $text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     * @param array|string|null $request_user Optional. If specified, pressing the button will open a list of suitable users. Tapping on any user will send their identifier to the bot in a “user_shared” service message. Available in private chats only.
     * @param array|string|null $request_chat Optional. If specified, pressing the button will open a list of suitable chats. Tapping on a chat will send its identifier to the bot in a “chat_shared” service message. Available in private chats only.
     * @param bool|null $request_contact Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
     * @param bool|null $request_location Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only.
     * @param array|string|null $request_poll Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
     * @param string|null $web_app Optional. If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a “web_app_data” service message. Available in private chats only.
     * @return Bot
     */
    public function KeyboardButton(string $text, array|string|null $request_user, array|string|null $request_chat, array|string|null $request_poll, string|null $web_app, bool|null $request_contact = false, bool|null $request_location = false): Bot
    {
        return $this->call(['text' => $text, 'request_user' => $request_user, 'request_chat' => $request_chat, 'request_contact' => $request_contact, 'request_location' => $request_location, 'request_poll' => $request_poll, 'web_app' => $web_app,], __FUNCTION__);
    }
    /**
     * Represents the rights of an administrator in a chat.
     * @param bool $is_anonymous True, if the user's presence in the chat is hidden
     * @param bool $can_manage_chat True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @param bool $can_delete_messages True, if the administrator can delete messages of other users
     * @param bool $can_manage_video_chats True, if the administrator can manage video chats
     * @param bool $can_restrict_members True, if the administrator can restrict, ban or unban chat members
     * @param bool $can_promote_members True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     * @param bool $can_change_info True, if the user is allowed to change the chat title, photo and other settings
     * @param bool $can_invite_users True, if the user is allowed to invite new users to the chat
     * @param bool|null $can_post_messages Optional. True, if the administrator can post in the channel; channels only
     * @param bool|null $can_edit_messages Optional. True, if the administrator can edit messages of other users and can pin messages; channels only
     * @param bool|null $can_pin_messages Optional. True, if the user is allowed to pin messages; groups and supergroups only
     * @param bool|null $can_manage_topics Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     * @return Bot
     */
    public function ChatAdministratorRights(bool $is_anonymous, bool $can_manage_chat, bool $can_delete_messages, bool $can_manage_video_chats, bool $can_restrict_members, bool $can_promote_members, bool $can_change_info, bool $can_invite_users, bool|null $can_post_messages = false, bool|null $can_edit_messages = false, bool|null $can_pin_messages = false, bool|null $can_manage_topics = false): Bot
    {
        return $this->call(['is_anonymous' => $is_anonymous, 'can_manage_chat' => $can_manage_chat, 'can_delete_messages' => $can_delete_messages, 'can_manage_video_chats' => $can_manage_video_chats, 'can_restrict_members' => $can_restrict_members, 'can_promote_members' => $can_promote_members, 'can_change_info' => $can_change_info, 'can_invite_users' => $can_invite_users, 'can_post_messages' => $can_post_messages, 'can_edit_messages' => $can_edit_messages, 'can_pin_messages' => $can_pin_messages, 'can_manage_topics' => $can_manage_topics,], __FUNCTION__);
    }
    /**
     * This object represents a forum topic.
     * @param int $message_thread_id Unique identifier of the forum topic
     * @param string $name Name of the topic
     * @param int $icon_color Color of the topic icon in RGB format
     * @param string|null $icon_custom_emoji_id Optional. Unique identifier of the custom emoji shown as the topic icon
     * @return Bot
     */
    public function ForumTopic(int $message_thread_id, string $name, int $icon_color, string|null $icon_custom_emoji_id = ''): Bot
    {
        return $this->call(['message_thread_id' => $message_thread_id, 'name' => $name, 'icon_color' => $icon_color, 'icon_custom_emoji_id' => $icon_custom_emoji_id,], __FUNCTION__);
    }
    /**
     * This object represents a bot command.
     * @param string $command Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     * @param string $description Description of the command; 1-256 characters.
     * @return Bot
     */
    public function BotCommand(string $command, string $description): Bot
    {
        return $this->call(['command' => $command, 'description' => $description,], __FUNCTION__);
    }
    /**
     * This object represents the scope to which bot commands are applied. Currently, the following 7 scopes are supported:</p><ul><li><a href="#botcommandscopedefault">BotCommandScopeDefault</a></li><li><a href="#botcommandscopeallprivatechats">BotCommandScopeAllPrivateChats</a></li><li><a href="#botcommandscopeallgroupchats">BotCommandScopeAllGroupChats</a></li><li><a href="#botcommandscopeallchatadministrators">BotCommandScopeAllChatAdministrators</a></li><li><a href="#botcommandscopechat">BotCommandScopeChat</a></li><li><a href="#botcommandscopechatadministrators">BotCommandScopeChatAdministrators</a></li><li><a href="#botcommandscopechatmember">BotCommandScopeChatMember</a></li></ul><h4><a class="anchor" name="determining-list-of-commands" href="#determining-list-of-commands"><i class="anchor-icon"></i></a>Determining list of commands</h4><p>The following algorithm is used to determine the list of commands for a particular user viewing the bot menu. The first list of commands which is set is returned:</p><p><strong>Commands in the chat with the bot</strong></p><ul><li>botCommandScopeChat + language_code</li><li>botCommandScopeChat</li><li>botCommandScopeAllPrivateChats + language_code</li><li>botCommandScopeAllPrivateChats</li><li>botCommandScopeDefault + language_code</li><li>botCommandScopeDefault</li></ul><p><strong>Commands in group and supergroup chats</strong></p><ul><li>botCommandScopeChatMember + language_code</li><li>botCommandScopeChatMember</li><li>botCommandScopeChatAdministrators + language_code (administrators only)</li><li>botCommandScopeChatAdministrators (administrators only)</li><li>botCommandScopeChat + language_code</li><li>botCommandScopeChat</li><li>botCommandScopeAllChatAdministrators + language_code (administrators only)</li><li>botCommandScopeAllChatAdministrators (administrators only)</li><li>botCommandScopeAllGroupChats + language_code</li><li>botCommandScopeAllGroupChats</li><li>botCommandScopeDefault + language_code</li><li>botCommandScopeDefault</li></ul><h4><a class="anchor" name="botcommandscopedefault" href="#botcommandscopedefault"><i class="anchor-icon"></i></a>BotCommandScopeDefault</h4><p>Represents the default <a href="#botcommandscope">scope</a> of bot commands. Default commands are used if no commands with a <a href="#determining-list-of-commands">narrower scope</a> are specified for the user.
     * @param string $type Scope type, must be default
     * @return Bot
     */
    public function BotCommandScope(string $type): Bot
    {
        return $this->call(['type' => $type,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering all private chats.
     * @param string $type Scope type, must be all_private_chats
     * @return Bot
     */
    public function BotCommandScopeAllPrivateChats(string $type): Bot
    {
        return $this->call(['type' => $type,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering all group and supergroup chats.
     * @param string $type Scope type, must be all_group_chats
     * @return Bot
     */
    public function BotCommandScopeAllGroupChats(string $type): Bot
    {
        return $this->call(['type' => $type,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering all group and supergroup chat administrators.
     * @param string $type Scope type, must be all_chat_administrators
     * @return Bot
     */
    public function BotCommandScopeAllChatAdministrators(string $type): Bot
    {
        return $this->call(['type' => $type,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering a specific chat.
     * @param string $type Scope type, must be chat
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function BotCommandScopeChat(string $type, int|string $chat_id): Bot
    {
        return $this->call(['type' => $type, 'chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering all administrators of a specific group or supergroup chat.
     * @param string $type Scope type, must be chat_administrators
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function BotCommandScopeChatAdministrators(string $type, int|string $chat_id): Bot
    {
        return $this->call(['type' => $type, 'chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#botcommandscope">scope</a> of bot commands, covering a specific member of a group or supergroup chat.
     * @param string $type Scope type, must be chat_member
     * @param int|string $chat_id Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $user_id Unique identifier of the target user
     * @return Bot
     */
    public function BotCommandScopeChatMember(string $type, int|string $chat_id, int $user_id): Bot
    {
        return $this->call(['type' => $type, 'chat_id' => $chat_id, 'user_id' => $user_id,], __FUNCTION__);
    }
    /**
     * This object represents the bot&#39;s name.
     * @param string $name The bot's name
     * @return Bot
     */
    public function BotName(string $name): Bot
    {
        return $this->call(['name' => $name,], __FUNCTION__);
    }
    /**
     * This object represents the bot&#39;s description.
     * @param string $description The bot's description
     * @return Bot
     */
    public function BotDescription(string $description): Bot
    {
        return $this->call(['description' => $description,], __FUNCTION__);
    }
    /**
     * This object represents the bot&#39;s short description.
     * @param string $short_description The bot's short description
     * @return Bot
     */
    public function BotShortDescription(string $short_description): Bot
    {
        return $this->call(['short_description' => $short_description,], __FUNCTION__);
    }
    /**
     * Represents a menu button, which launches a <a href="/bots/webapps">Web App</a>.
     * @param string $type Type of the button, must be web_app
     * @param string $text Text on the button
     * @param string $web_app Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery.
     * @return Bot
     */
    public function MenuButtonWebApp(string $type, string $text, string $web_app): Bot
    {
        return $this->call(['type' => $type, 'text' => $text, 'web_app' => $web_app,], __FUNCTION__);
    }
    /**
     * Describes that no specific value for the menu button was set.
     * @param string $type Type of the button, must be default
     * @return Bot
     */
    public function MenuButtonDefault(string $type): Bot
    {
        return $this->call(['type' => $type,], __FUNCTION__);
    }
    /**
     * Describes why a request was unsuccessful.
     * @param int|null $migrate_to_chat_id Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param int|null $retry_after Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
     * @return Bot
     */
    public function ResponseParameters(int|null $migrate_to_chat_id = 0, int|null $retry_after = 0): Bot
    {
        return $this->call(['migrate_to_chat_id' => $migrate_to_chat_id, 'retry_after' => $retry_after,], __FUNCTION__);
    }
    /**
     * Represents a video to be sent.
     * @param string $type Type of the result, must be video
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files 
     * @param string|null $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the video caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $width Optional. Video width
     * @param int|null $height Optional. Video height
     * @param int|null $duration Optional. Video duration in seconds
     * @param bool|null $supports_streaming Optional. Pass True if the uploaded video is suitable for streaming
     * @param bool|null $has_spoiler Optional. Pass True if the video needs to be covered with a spoiler animation
     * @return Bot
     */
    public function InputMediaVideo(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $width = 0, int|null $height = 0, int|null $duration = 0, bool|null $supports_streaming = false, bool|null $has_spoiler = false): Bot
    {
        return $this->call(['type' => $type, 'media' => $media, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'width' => $width, 'height' => $height, 'duration' => $duration, 'supports_streaming' => $supports_streaming, 'has_spoiler' => $has_spoiler,], __FUNCTION__);
    }
    /**
     * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
     * @param string $type Type of the result, must be animation
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files 
     * @param string|null $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption Optional. Caption of the animation to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the animation caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $width Optional. Animation width
     * @param int|null $height Optional. Animation height
     * @param int|null $duration Optional. Animation duration in seconds
     * @param bool|null $has_spoiler Optional. Pass True if the animation needs to be covered with a spoiler animation
     * @return Bot
     */
    public function InputMediaAnimation(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $width = 0, int|null $height = 0, int|null $duration = 0, bool|null $has_spoiler = false): Bot
    {
        return $this->call(['type' => $type, 'media' => $media, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'width' => $width, 'height' => $height, 'duration' => $duration, 'has_spoiler' => $has_spoiler,], __FUNCTION__);
    }
    /**
     * Represents an audio file to be treated as music to be sent.
     * @param string $type Type of the result, must be audio
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files 
     * @param string|null $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption Optional. Caption of the audio to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $duration Optional. Duration of the audio in seconds
     * @param string|null $performer Optional. Performer of the audio
     * @param string|null $title Optional. Title of the audio
     * @return Bot
     */
    public function InputMediaAudio(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, string|null $performer = '', string|null $title = ''): Bot
    {
        return $this->call(['type' => $type, 'media' => $media, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'duration' => $duration, 'performer' => $performer, 'title' => $title,], __FUNCTION__);
    }
    /**
     * Represents a general file to be sent.
     * @param string $type Type of the result, must be document
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More information on Sending Files 
     * @param string|null $thumbnail Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $disable_content_type_detection Optional. Disables automatic server-side content type detection for files uploaded using multipart/form-data. Always True, if the document is sent as part of an album.
     * @return Bot
     */
    public function InputMediaDocument(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_content_type_detection = false): Bot
    {
        return $this->call(['type' => $type, 'media' => $media, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_content_type_detection' => $disable_content_type_detection,], __FUNCTION__);
    }
    /**
     * This object represents the contents of a file to be uploaded. Must be posted using multipart/form-data in the usual way that files are uploaded via the browser.</p><h4><a class="anchor" name="sending-files" href="#sending-files"><i class="anchor-icon"></i></a>Sending files</h4><p>There are three ways to send files (photos, stickers, audio, media, etc.):</p><ol><li>If the file is already stored somewhere on the Telegram servers, you don&#39;t need to reupload it: each file object has a <strong>file_id</strong> field, simply pass this <strong>file_id</strong> as a parameter instead of uploading. There are <strong>no limits</strong> for files sent this way.</li><li>Provide Telegram with an HTTP URL for the file to be sent. Telegram will download and send the file. 5 MB max size for photos and 20 MB max for other types of content.</li><li>Post the file using multipart/form-data in the usual way that files are uploaded via the browser. 10 MB max size for photos, 50 MB for other files.</li></ol><p><strong>Sending by file_id</strong></p><ul><li>It is not possible to change the file type when resending by <strong>file_id</strong>. I.e. a <a href="#video">video</a> can&#39;t be <a href="#sendphoto">sent as a photo</a>, a <a href="#photosize">photo</a> can&#39;t be <a href="#senddocument">sent as a document</a>, etc.</li><li>It is not possible to resend thumbnails.</li><li>Resending a photo by <strong>file_id</strong> will send all of its <a href="#photosize">sizes</a>.</li><li><strong>file_id</strong> is unique for each individual bot and <strong>can&#39;t</strong> be transferred from one bot to another.</li><li><strong>file_id</strong> uniquely identifies a file, but a file can have different valid <strong>file_id</strong>s even for the same bot.</li></ul><p><strong>Sending by URL</strong></p><ul><li>When sending by URL the target file must have the correct MIME type (e.g., audio/mpeg for <a href="#sendaudio">sendAudio</a>, etc.).</li><li>In <a href="#senddocument">sendDocument</a>, sending by URL will currently only work for <strong>GIF</strong>, <strong>PDF</strong> and <strong>ZIP</strong> files.</li><li>To use <a href="#sendvoice">sendVoice</a>, the file must have the type audio/ogg and be no more than 1MB in size. 1-20MB voice notes will be sent as files.</li><li>Other configurations may work but we can&#39;t guarantee that they will.</li></ul><h4><a class="anchor" name="inline-mode-objects" href="#inline-mode-objects"><i class="anchor-icon"></i></a>Inline mode objects</h4><p>Objects and methods used in the inline mode are described in the <a href="#inline-mode">Inline mode section</a>.</p><h3><a class="anchor" name="available-methods" href="#available-methods"><i class="anchor-icon"></i></a>Available methods</h3><blockquote><p>All methods in the Bot API are case-insensitive. We support <strong>GET</strong> and <strong>POST</strong> HTTP methods. Use either <a href="https://en.wikipedia.org/wiki/Query_string">URL query string</a> or <em>application/json</em> or <em>application/x-www-form-urlencoded</em> or <em>multipart/form-data</em> for passing parameters in Bot API requests.<br>On successful call, a JSON-object containing the result will be returned.</p></blockquote><h4><a class="anchor" name="getme" href="#getme"><i class="anchor-icon"></i></a>getMe</h4><p>A simple method for testing your bot&#39;s authentication token. Requires no parameters. Returns basic information about the bot in form of a <a href="#user">User</a> object.</p><h4><a class="anchor" name="logout" href="#logout"><i class="anchor-icon"></i></a>logOut</h4><p>Use this method to log out from the cloud Bot API server before launching the bot locally. You <strong>must</strong> log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns <em>True</em> on success. Requires no parameters.</p><h4><a class="anchor" name="close" href="#close"><i class="anchor-icon"></i></a>close</h4><p>Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn&#39;t launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns <em>True</em> on success. Requires no parameters.</p><h4><a class="anchor" name="sendmessage" href="#sendmessage"><i class="anchor-icon"></i></a>sendMessage</h4><p>Use this method to send text messages. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $text YesText of the message to be sent, 1-4096 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the message text. See formatting options for more details.
     * @param string|null $entities OptionalA JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $disable_web_page_preview OptionalDisables link previews for links in this message
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendMessage(int|string $chat_id, string $text, int|null $message_thread_id = 0, string|null $parse_mode = '', ?string $entities = null, bool|null $disable_web_page_preview = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'text' => $text, 'parse_mode' => $parse_mode, 'entities' => $entities, 'disable_web_page_preview' => $disable_web_page_preview, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to copy messages of any kind. Service messages and invoice messages can&#39;t be copied. A quiz <a href="#poll">poll</a> can be copied only if the value of the field <em>correct_option_id</em> is known to the bot. The method is analogous to the method <a href="#forwardmessage">forwardMessage</a>, but the copied message doesn&#39;t have a link to the original message. Returns the <a href="#messageid">MessageId</a> of the sent message on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param int|string $from_chat_id YesUnique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param int $message_id YesMessage identifier in the chat specified in from_chat_id
     * @param string|null $caption OptionalNew caption for media, 0-1024 characters after entities parsing. If not specified, the original caption is kept
     * @param string|null $parse_mode OptionalMode for parsing entities in the new caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the new caption, which can be specified instead of parse_mode
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function copyMessage(int|string $chat_id, int|string $from_chat_id, int $message_id, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'from_chat_id' => $from_chat_id, 'message_id' => $message_id, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send photos. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $photo YesPhoto to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data. The photo must be at most 10 MB in size. The photo's width and height must not exceed 10000 in total. Width and height ratio must be at most 20. More information on Sending Files 
     * @param string|null $caption OptionalPhoto caption (may also be used when resending photos by file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the photo caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $has_spoiler OptionalPass True if the photo needs to be covered with a spoiler animation
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendPhoto(int|string $chat_id, string $photo, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'photo' => $photo, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'has_spoiler' => $has_spoiler, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent <a href="#message">Message</a> is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.</p><p>For sending voice messages, use the <a href="#sendvoice">sendVoice</a> method instead.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $audio YesAudio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data. More information on Sending Files 
     * @param string|null $caption OptionalAudio caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the audio caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $duration OptionalDuration of the audio in seconds
     * @param string|null $performer OptionalPerformer
     * @param string|null $title OptionalTrack name
     * @param string|null $thumbnail OptionalThumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendAudio(int|string $chat_id, string $audio, string|null $thumbnail, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, string|null $performer = '', string|null $title = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'audio' => $audio, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'duration' => $duration, 'performer' => $performer, 'title' => $title, 'thumbnail' => $thumbnail, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send general files. On success, the sent <a href="#message">Message</a> is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $document YesFile to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More information on Sending Files 
     * @param string|null $thumbnail OptionalThumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption OptionalDocument caption (may also be used when resending documents by file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the document caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $disable_content_type_detection OptionalDisables automatic server-side content type detection for files uploaded using multipart/form-data
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendDocument(int|string $chat_id, string $document, string|null $thumbnail, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_content_type_detection = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'document' => $document, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'disable_content_type_detection' => $disable_content_type_detection, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send video files, Telegram clients support MPEG4 videos (other formats may be sent as <a href="#document">Document</a>). On success, the sent <a href="#message">Message</a> is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $video YesVideo to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data. More information on Sending Files 
     * @param int|null $duration OptionalDuration of sent video in seconds
     * @param int|null $width OptionalVideo width
     * @param int|null $height OptionalVideo height
     * @param string|null $thumbnail OptionalThumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption OptionalVideo caption (may also be used when resending videos by file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the video caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $has_spoiler OptionalPass True if the video needs to be covered with a spoiler animation
     * @param bool|null $supports_streaming OptionalPass True if the uploaded video is suitable for streaming
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendVideo(int|string $chat_id, string $video, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $width = 0, int|null $height = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $supports_streaming = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'video' => $video, 'duration' => $duration, 'width' => $width, 'height' => $height, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'has_spoiler' => $has_spoiler, 'supports_streaming' => $supports_streaming, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent <a href="#message">Message</a> is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $animation YesAnimation to send. Pass a file_id as String to send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new animation using multipart/form-data. More information on Sending Files 
     * @param int|null $duration OptionalDuration of sent animation in seconds
     * @param int|null $width OptionalAnimation width
     * @param int|null $height OptionalAnimation height
     * @param string|null $thumbnail OptionalThumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param string|null $caption OptionalAnimation caption (may also be used when resending animation by file_id), 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the animation caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param bool|null $has_spoiler OptionalPass True if the animation needs to be covered with a spoiler animation
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendAnimation(int|string $chat_id, string $animation, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $width = 0, int|null $height = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'animation' => $animation, 'duration' => $duration, 'width' => $width, 'height' => $height, 'thumbnail' => $thumbnail, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'has_spoiler' => $has_spoiler, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as <a href="#audio">Audio</a> or <a href="#document">Document</a>). On success, the sent <a href="#message">Message</a> is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $voice YesAudio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More information on Sending Files 
     * @param string|null $caption OptionalVoice message caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the voice message caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $duration OptionalDuration of the voice message in seconds
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendVoice(int|string $chat_id, string $voice, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'voice' => $voice, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'duration' => $duration, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * As of <a href="https://telegram.org/blog/video-messages-and-telescope">v.4.0</a>, Telegram clients support rounded square MPEG4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $video_note YesVideo note to send. Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More information on Sending Files . Sending video notes by a URL is currently unsupported
     * @param int|null $duration OptionalDuration of sent video in seconds
     * @param int|null $length OptionalVideo width and height, i.e. diameter of the video message
     * @param string|null $thumbnail OptionalThumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail's width and height should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can't be reused and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More information on Sending Files 
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendVideoNote(int|string $chat_id, string $video_note, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $length = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'video_note' => $video_note, 'duration' => $duration, 'length' => $length, 'thumbnail' => $thumbnail, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type. On success, an array of <a href="#message">Messages</a> that were sent is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $media YesA JSON-serialized array describing messages to be sent, must include 2-10 items
     * @param bool|null $disable_notification OptionalSends messages silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent messages from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the messages are a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @return Bot
     */
    public function sendMediaGroup(int|string $chat_id, int|null $message_thread_id = 0, ?string $media = null, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'media' => $media, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply,], __FUNCTION__);
    }
    /**
     * Use this method to send point on the map. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param float $latitude YesLatitude of the location
     * @param float $longitude YesLongitude of the location
     * @param float|null $horizontal_accuracy OptionalThe radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period OptionalPeriod in seconds for which the location will be updated (see Live Locations, should be between 60 and 86400.
     * @param int|null $heading OptionalFor live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius OptionalFor live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendLocation(int|string $chat_id, float $latitude, float $longitude, float|null $horizontal_accuracy, int|null $message_thread_id = 0, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'latitude' => $latitude, 'longitude' => $longitude, 'horizontal_accuracy' => $horizontal_accuracy, 'live_period' => $live_period, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send information about a venue. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param float $latitude YesLatitude of the venue
     * @param float $longitude YesLongitude of the venue
     * @param string $title YesName of the venue
     * @param string $address YesAddress of the venue
     * @param string|null $foursquare_id OptionalFoursquare identifier of the venue
     * @param string|null $foursquare_type OptionalFoursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id OptionalGoogle Places identifier of the venue
     * @param string|null $google_place_type OptionalGoogle Places type of the venue. (See supported types.)
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendVenue(int|string $chat_id, float $latitude, float $longitude, string $title, string $address, int|null $message_thread_id = 0, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address, 'foursquare_id' => $foursquare_id, 'foursquare_type' => $foursquare_type, 'google_place_id' => $google_place_id, 'google_place_type' => $google_place_type, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send phone contacts. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $phone_number YesContact's phone number
     * @param string $first_name YesContact's first name
     * @param string|null $last_name OptionalContact's last name
     * @param string|null $vcard OptionalAdditional data about the contact in the form of a vCard, 0-2048 bytes
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendContact(int|string $chat_id, string $phone_number, string $first_name, int|null $message_thread_id = 0, string|null $last_name = '', string|null $vcard = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'phone_number' => $phone_number, 'first_name' => $first_name, 'last_name' => $last_name, 'vcard' => $vcard, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send a native poll. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $question YesPoll question, 1-300 characters
     * @param string $options YesA JSON-serialized list of answer options, 2-10 strings 1-100 characters each
     * @param bool|null $is_anonymous OptionalTrue, if the poll needs to be anonymous, defaults to True
     * @param string|null $type OptionalPoll type, “quiz” or “regular”, defaults to “regular”
     * @param bool|null $allows_multiple_answers OptionalTrue, if the poll allows multiple answers, ignored for polls in quiz mode, defaults to False
     * @param int|null $correct_option_id Optional0-based identifier of the correct answer option, required for polls in quiz mode
     * @param string|null $explanation OptionalText that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after entities parsing
     * @param string|null $explanation_parse_mode OptionalMode for parsing entities in the explanation. See formatting options for more details.
     * @param string|null $explanation_entities OptionalA JSON-serialized list of special entities that appear in the poll explanation, which can be specified instead of parse_mode
     * @param int|null $open_period OptionalAmount of time in seconds the poll will be active after creation, 5-600. Can't be used together with close_date.
     * @param int|null $close_date OptionalPoint in time (Unix timestamp) when the poll will be automatically closed. Must be at least 5 and no more than 600 seconds in the future. Can't be used together with open_period.
     * @param bool|null $is_closed OptionalPass True if the poll needs to be immediately closed. This can be useful for poll preview.
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendPoll(int|string $chat_id, string $question, int|null $message_thread_id = 0, ?string $options = null, bool|null $is_anonymous = false, string|null $type = '', bool|null $allows_multiple_answers = false, int|null $correct_option_id = 0, string|null $explanation = '', string|null $explanation_parse_mode = '', ?string $explanation_entities = null, int|null $open_period = 0, int|null $close_date = 0, bool|null $is_closed = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'question' => $question, 'options' => $options, 'is_anonymous' => $is_anonymous, 'type' => $type, 'allows_multiple_answers' => $allows_multiple_answers, 'correct_option_id' => $correct_option_id, 'explanation' => $explanation, 'explanation_parse_mode' => $explanation_parse_mode, 'explanation_entities' => $explanation_entities, 'open_period' => $open_period, 'close_date' => $close_date, 'is_closed' => $is_closed, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string|null $emoji OptionalEmoji on which the dice throw animation is based. Currently, must be one of “”, “”, “”, “”, “”, or “”. Dice can have values 1-6 for “”, “” and “”, values 1-5 for “” and “”, and values 1-64 for “”. Defaults to “”
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendDice(int|string $chat_id, int|null $message_thread_id = 0, string|null $emoji = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'emoji' => $emoji, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method when you need to tell the user that something is happening on the bot&#39;s side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns <em>True</em> on success.</p><blockquote><p>Example: The <a href="https://t.me/imagebot">ImageBot</a> needs some time to process a request and upload the image. Instead of sending a text message along the lines of “Retrieving image, please wait…”, the bot may use <a href="#sendchataction">sendChatAction</a> with <em>action</em> = <em>upload_photo</em>. The user will see a “sending photo” status for the bot.</p></blockquote><p>We only recommend using this method when a response from the bot will take a <strong>noticeable</strong> amount of time to arrive.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread; supergroups only
     * @param string $action YesType of action to broadcast. Choose one, depending on what the user is about to receive: typing for text messages, upload_photo for photos, record_video or upload_video for videos, record_voice or upload_voice for voice notes, upload_document for general files, choose_sticker for stickers, find_location for location data, record_video_note or upload_video_note for video notes.
     * @return Bot
     */
    public function sendChatAction(int|string $chat_id, string $action, int|null $message_thread_id = 0): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'action' => $action,], __FUNCTION__);
    }
    /**
     * Use this method to get a list of profile pictures for a user. Returns a <a href="#userprofilephotos">UserProfilePhotos</a> object.
     * @param int $user_id YesUnique identifier of the target user
     * @param int|null $offset OptionalSequential number of the first photo to be returned. By default, all photos are returned.
     * @param int|null $limit OptionalLimits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @return Bot
     */
    public function getUserProfilePhotos(int $user_id, int|null $offset = 0, int|null $limit = 0): Bot
    {
        return $this->call(['user_id' => $user_id, 'offset' => $offset, 'limit' => $limit,], __FUNCTION__);
    }
    /**
     * Use this method to get basic information about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a <a href="#file">File</a> object is returned. The file can then be downloaded via the link <code>https://api.telegram.org/file/bot&lt;token&gt;/&lt;file_path&gt;</code>, where <code>&lt;file_path&gt;</code> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling <a href="#getfile">getFile</a> again.
     * @param string $file_id YesFile identifier to get information about
     * @return Bot
     */
    public function getFile(string $file_id): Bot
    {
        return $this->call(['file_id' => $file_id,], __FUNCTION__);
    }
    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless <a href="#unbanchatmember">unbanned</a> first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @param int|null $until_date OptionalDate when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
     * @param bool|null $revoke_messages OptionalPass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
     * @return Bot
     */
    public function banChatMember(int|string $chat_id, int $user_id, int|null $until_date = 0, bool|null $revoke_messages = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id, 'until_date' => $until_date, 'revoke_messages' => $revoke_messages,], __FUNCTION__);
    }
    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will <strong>not</strong> return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be <strong>removed</strong> from the chat. If you don&#39;t want this, use the parameter <em>only_if_banned</em>. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @param bool|null $only_if_banned OptionalDo nothing if the user is not banned
     * @return Bot
     */
    public function unbanChatMember(int|string $chat_id, int $user_id, bool|null $only_if_banned = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id, 'only_if_banned' => $only_if_banned,], __FUNCTION__);
    }
    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass <em>True</em> for all permissions to lift restrictions from a user. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $user_id YesUnique identifier of the target user
     * @param string|array $permissions YesA JSON-serialized object for new user permissions
     * @param bool|null $use_independent_chat_permissions OptionalPass True if chat permissions are set independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos, can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply the can_send_messages permission.
     * @param int|null $until_date OptionalDate when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
     * @return Bot
     */
    public function restrictChatMember(int|string $chat_id, int $user_id, string|array $permissions, bool|null $use_independent_chat_permissions = false, int|null $until_date = 0): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id, 'permissions' => $permissions, 'use_independent_chat_permissions' => $use_independent_chat_permissions, 'until_date' => $until_date,], __FUNCTION__);
    }
    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass <em>False</em> for all boolean parameters to demote a user. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @param bool|null $is_anonymous OptionalPass True if the administrator's presence in the chat is hidden
     * @param bool|null $can_manage_chat OptionalPass True if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @param bool|null $can_post_messages OptionalPass True if the administrator can create channel posts, channels only
     * @param bool|null $can_edit_messages OptionalPass True if the administrator can edit messages of other users and can pin messages, channels only
     * @param bool|null $can_delete_messages OptionalPass True if the administrator can delete messages of other users
     * @param bool|null $can_manage_video_chats OptionalPass True if the administrator can manage video chats
     * @param bool|null $can_restrict_members OptionalPass True if the administrator can restrict, ban or unban chat members
     * @param bool|null $can_promote_members OptionalPass True if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by him)
     * @param bool|null $can_change_info OptionalPass True if the administrator can change chat title, photo and other settings
     * @param bool|null $can_invite_users OptionalPass True if the administrator can invite new users to the chat
     * @param bool|null $can_pin_messages OptionalPass True if the administrator can pin messages, supergroups only
     * @param bool|null $can_manage_topics OptionalPass True if the user is allowed to create, rename, close, and reopen forum topics, supergroups only
     * @return Bot
     */
    public function promoteChatMember(int|string $chat_id, int $user_id, bool|null $is_anonymous = false, bool|null $can_manage_chat = false, bool|null $can_post_messages = false, bool|null $can_edit_messages = false, bool|null $can_delete_messages = false, bool|null $can_manage_video_chats = false, bool|null $can_restrict_members = false, bool|null $can_promote_members = false, bool|null $can_change_info = false, bool|null $can_invite_users = false, bool|null $can_pin_messages = false, bool|null $can_manage_topics = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id, 'is_anonymous' => $is_anonymous, 'can_manage_chat' => $can_manage_chat, 'can_post_messages' => $can_post_messages, 'can_edit_messages' => $can_edit_messages, 'can_delete_messages' => $can_delete_messages, 'can_manage_video_chats' => $can_manage_video_chats, 'can_restrict_members' => $can_restrict_members, 'can_promote_members' => $can_promote_members, 'can_change_info' => $can_change_info, 'can_invite_users' => $can_invite_users, 'can_pin_messages' => $can_pin_messages, 'can_manage_topics' => $can_manage_topics,], __FUNCTION__);
    }
    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $user_id YesUnique identifier of the target user
     * @param string $custom_title YesNew custom title for the administrator; 0-16 characters, emoji are not allowed
     * @return Bot
     */
    public function setChatAdministratorCustomTitle(int|string $chat_id, int $user_id, string $custom_title): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id, 'custom_title' => $custom_title,], __FUNCTION__);
    }
    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is <a href="#unbanchatsenderchat">unbanned</a>, the owner of the banned chat won&#39;t be able to send messages on behalf of <strong>any of their channels</strong>. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $sender_chat_id YesUnique identifier of the target sender chat
     * @return Bot
     */
    public function banChatSenderChat(int|string $chat_id, int $sender_chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $sender_chat_id YesUnique identifier of the target sender chat
     * @return Bot
     */
    public function unbanChatSenderChat(int|string $chat_id, int $sender_chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'sender_chat_id' => $sender_chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the <em>can_restrict_members</em> administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param string|array $permissions YesA JSON-serialized object for new default chat permissions
     * @param bool|null $use_independent_chat_permissions OptionalPass True if chat permissions are set independently. Otherwise, the can_send_other_messages and can_add_web_page_previews permissions will imply the can_send_messages, can_send_audios, can_send_documents, can_send_photos, can_send_videos, can_send_video_notes, and can_send_voice_notes permissions; the can_send_polls permission will imply the can_send_messages permission.
     * @return Bot
     */
    public function setChatPermissions(int|string $chat_id, string|array $permissions, bool|null $use_independent_chat_permissions = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'permissions' => $permissions, 'use_independent_chat_permissions' => $use_independent_chat_permissions,], __FUNCTION__);
    }
    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the new invite link as <em>String</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return Bot
     */
    public function exportChatInviteLink(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method <a href="#revokechatinvitelink">revokeChatInviteLink</a>. Returns the new invite link as <a href="#chatinvitelink">ChatInviteLink</a> object.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string|null $name OptionalInvite link name; 0-32 characters
     * @param int|null $expire_date OptionalPoint in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit OptionalThe maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request OptionalTrue, if users joining the chat via the link need to be approved by chat administrators. If True, member_limit can't be specified
     * @return Bot
     */
    public function createChatInviteLink(int|string $chat_id, string|null $name = '', int|null $expire_date = 0, int|null $member_limit = 0, bool|null $creates_join_request = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'name' => $name, 'expire_date' => $expire_date, 'member_limit' => $member_limit, 'creates_join_request' => $creates_join_request,], __FUNCTION__);
    }
    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a <a href="#chatinvitelink">ChatInviteLink</a> object.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $invite_link YesThe invite link to edit
     * @param string|null $name OptionalInvite link name; 0-32 characters
     * @param int|null $expire_date OptionalPoint in time (Unix timestamp) when the link will expire
     * @param int|null $member_limit OptionalThe maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
     * @param bool|null $creates_join_request OptionalTrue, if users joining the chat via the link need to be approved by chat administrators. If True, member_limit can't be specified
     * @return Bot
     */
    public function editChatInviteLink(int|string $chat_id, string $invite_link, string|null $name = '', int|null $expire_date = 0, int|null $member_limit = 0, bool|null $creates_join_request = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'invite_link' => $invite_link, 'name' => $name, 'expire_date' => $expire_date, 'member_limit' => $member_limit, 'creates_join_request' => $creates_join_request,], __FUNCTION__);
    }
    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as <a href="#chatinvitelink">ChatInviteLink</a> object.
     * @param int|string $chat_id YesUnique identifier of the target chat or username of the target channel (in the format @channelusername)
     * @param string $invite_link YesThe invite link to revoke
     * @return Bot
     */
    public function revokeChatInviteLink(int|string $chat_id, string $invite_link): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'invite_link' => $invite_link,], __FUNCTION__);
    }
    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the <em>can_invite_users</em> administrator right. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @return Bot
     */
    public function approveChatJoinRequest(int|string $chat_id, int $user_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id,], __FUNCTION__);
    }
    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the <em>can_invite_users</em> administrator right. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @return Bot
     */
    public function declineChatJoinRequest(int|string $chat_id, int $user_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id,], __FUNCTION__);
    }
    /**
     * Use this method to set a new profile photo for the chat. Photos can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $photo YesNew chat photo, uploaded using multipart/form-data
     * @return Bot
     */
    public function setChatPhoto(int|string $chat_id, string $photo): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'photo' => $photo,], __FUNCTION__);
    }
    /**
     * Use this method to delete a chat photo. Photos can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return Bot
     */
    public function deleteChatPhoto(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to change the title of a chat. Titles can&#39;t be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $title YesNew chat title, 1-128 characters
     * @return Bot
     */
    public function setChatTitle(int|string $chat_id, string $title): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'title' => $title,], __FUNCTION__);
    }
    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string|null $description OptionalNew chat description, 0-255 characters
     * @return Bot
     */
    public function setChatDescription(int|string $chat_id, string|null $description = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'description' => $description,], __FUNCTION__);
    }
    /**
     * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id YesIdentifier of a message to pin
     * @param bool|null $disable_notification OptionalPass True if it is not necessary to send a notification to all chat members about the new pinned message. Notifications are always disabled in channels and private chats.
     * @return Bot
     */
    public function pinChatMessage(int|string $chat_id, int $message_id, bool|null $disable_notification = false): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'disable_notification' => $disable_notification,], __FUNCTION__);
    }
    /**
     * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalIdentifier of a message to unpin. If not specified, the most recent pinned message (by sending date) will be unpinned.
     * @return Bot
     */
    public function unpinChatMessage(int|string $chat_id, int|null $message_id = 0): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id,], __FUNCTION__);
    }
    /**
     * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the &#39;can_pin_messages&#39; administrator right in a supergroup or &#39;can_edit_messages&#39; administrator right in a channel. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return Bot
     */
    public function unpinAllChatMessages(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return Bot
     */
    public function leaveChat(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a <a href="#chat">Chat</a> object on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return Bot
     */
    public function getChat(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to get a list of administrators in a chat, which aren&#39;t bots. Returns an Array of <a href="#chatmember">ChatMember</a> objects.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return Bot
     */
    public function getChatAdministrators(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to get the number of members in a chat. Returns <em>Int</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return Bot
     */
    public function getChatMemberCount(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to get information about a member of a chat. The method is only guaranteed to work for other users if the bot is an administrator in the chat. Returns a <a href="#chatmember">ChatMember</a> object on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param int $user_id YesUnique identifier of the target user
     * @return Bot
     */
    public function getChatMember(int|string $chat_id, int $user_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'user_id' => $user_id,], __FUNCTION__);
    }
    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em> optionally returned in <a href="#getchat">getChat</a> requests to check if the bot can use this method. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param string $sticker_set_name YesName of the sticker set to be set as the group sticker set
     * @return Bot
     */
    public function setChatStickerSet(int|string $chat_id, string $sticker_set_name): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'sticker_set_name' => $sticker_set_name,], __FUNCTION__);
    }
    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field <em>can_set_sticker_set</em> optionally returned in <a href="#getchat">getChat</a> requests to check if the bot can use this method. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function deleteChatStickerSet(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user. Requires no parameters. Returns an Array of <a href="#sticker">Sticker</a> objects.</p><h4><a class="anchor" name="createforumtopic" href="#createforumtopic"><i class="anchor-icon"></i></a>createForumTopic</h4><p>Use this method to create a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns information about the created topic as a <a href="#forumtopic">ForumTopic</a> object.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param string $name YesTopic name, 1-128 characters
     * @param int|null $icon_color OptionalColor of the topic icon in RGB format. Currently, must be one of 7322096 (0x6FB9F0), 16766590 (0xFFD67E), 13338331 (0xCB86DB), 9367192 (0x8EEE98), 16749490 (0xFF93B2), or 16478047 (0xFB6F5F)
     * @param string|null $icon_custom_emoji_id OptionalUnique identifier of the custom emoji shown as the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers.
     * @return Bot
     */
    public function getForumTopicIconStickers(int|string $chat_id, string $name, int|null $icon_color = 0, string|null $icon_custom_emoji_id = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'name' => $name, 'icon_color' => $icon_color, 'icon_custom_emoji_id' => $icon_custom_emoji_id,], __FUNCTION__);
    }
    /**
     * Use this method to edit name and icon of a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $message_thread_id YesUnique identifier for the target message thread of the forum topic
     * @param string|null $name OptionalNew topic name, 0-128 characters. If not specified or empty, the current name of the topic will be kept
     * @param string|null $icon_custom_emoji_id OptionalNew unique identifier of the custom emoji shown as the topic icon. Use getForumTopicIconStickers to get all allowed custom emoji identifiers. Pass an empty string to remove the icon. If not specified, the current icon will be kept
     * @return Bot
     */
    public function editForumTopic(int|string $chat_id, int $message_thread_id, string|null $name = '', string|null $icon_custom_emoji_id = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'name' => $name, 'icon_custom_emoji_id' => $icon_custom_emoji_id,], __FUNCTION__);
    }
    /**
     * Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $message_thread_id YesUnique identifier for the target message thread of the forum topic
     * @return Bot
     */
    public function closeForumTopic(int|string $chat_id, int $message_thread_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id,], __FUNCTION__);
    }
    /**
     * Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights, unless it is the creator of the topic. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $message_thread_id YesUnique identifier for the target message thread of the forum topic
     * @return Bot
     */
    public function reopenForumTopic(int|string $chat_id, int $message_thread_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id,], __FUNCTION__);
    }
    /**
     * Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_delete_messages</em> administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $message_thread_id YesUnique identifier for the target message thread of the forum topic
     * @return Bot
     */
    public function deleteForumTopic(int|string $chat_id, int $message_thread_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id,], __FUNCTION__);
    }
    /**
     * Use this method to clear the list of pinned messages in a forum topic. The bot must be an administrator in the chat for this to work and must have the <em>can_pin_messages</em> administrator right in the supergroup. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $message_thread_id YesUnique identifier for the target message thread of the forum topic
     * @return Bot
     */
    public function unpinAllForumTopicMessages(int|string $chat_id, int $message_thread_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id,], __FUNCTION__);
    }
    /**
     * Use this method to edit the name of the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param string $name YesNew topic name, 1-128 characters
     * @return Bot
     */
    public function editGeneralForumTopic(int|string $chat_id, string $name): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'name' => $name,], __FUNCTION__);
    }
    /**
     * Use this method to close an open &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function closeGeneralForumTopic(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to reopen a closed &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. The topic will be automatically unhidden if it was hidden. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function reopenGeneralForumTopic(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to hide the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. The topic will be automatically closed if it was open. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function hideGeneralForumTopic(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to unhide the &#39;General&#39; topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the <em>can_manage_topics</em> administrator rights. Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return Bot
     */
    public function unhideGeneralForumTopic(int|string $chat_id): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to send answers to callback queries sent from <a href="/bots/features#inline-keyboards">inline keyboards</a>. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, <em>True</em> is returned.</p><blockquote><p>Alternatively, the user can be redirected to the specified Game URL. For this option to work, you must first create a game for your bot via <a href="https://t.me/botfather">@BotFather</a> and accept the terms. Otherwise, you may use links like <code>t.me/your_bot?start=XXXX</code> that open your bot with a parameter.</p></blockquote><table class="table"><thead><tr><th>Parameter</th><th>Type</th><th>Required</th><th>Description</th></tr></thead><tbody><tr><td>callback_query_id</td><td>String</td><td>Yes</td><td>Unique identifier for the query to be answered</td></tr><tr><td>text</td><td>String</td><td>Optional</td><td>Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters</td></tr><tr><td>show_alert</td><td>Boolean</td><td>Optional</td><td>If <em>True</em>, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to <em>false</em>.</td></tr><tr><td>url</td><td>String</td><td>Optional</td><td>URL that will be opened by the user&#39;s client. If you have created a <a href="#game">Game</a> and accepted the conditions via <a href="https://t.me/botfather">@BotFather</a>, specify the URL that opens your game - note that this will only work if the query comes from a <a href="#inlinekeyboardbutton"><em>callback_game</em></a> button.<br><br>Otherwise, you may use links like <code>t.me/your_bot?start=XXXX</code> that open your bot with a parameter.</td></tr><tr><td>cache_time</td><td>Integer</td><td>Optional</td><td>The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.</td></tr></tbody></table><h4><a class="anchor" name="setmycommands" href="#setmycommands"><i class="anchor-icon"></i></a>setMyCommands</h4><p>Use this method to change the list of the bot&#39;s commands. See <a href="/bots/features#commands">this manual</a> for more details about bot commands. Returns <em>True</em> on success.
     * @param string $commands YesA JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
     * @param string|array|null $scope OptionalA JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
     * @return Bot
     */
    public function answerCallbackQuery(string|array|null $scope, ?string $commands = null, string|null $language_code = ''): Bot
    {
        return $this->call(['commands' => $commands, 'scope' => $scope, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to delete the list of the bot&#39;s commands for the given scope and user language. After deletion, <a href="#determining-list-of-commands">higher level commands</a> will be shown to affected users. Returns <em>True</em> on success.
     * @param string|array|null $scope OptionalA JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
     * @return Bot
     */
    public function deleteMyCommands(string|array|null $scope, string|null $language_code = ''): Bot
    {
        return $this->call(['scope' => $scope, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to get the current list of the bot&#39;s commands for the given scope and user language. Returns an Array of <a href="#botcommand">BotCommand</a> objects. If commands aren&#39;t set, an empty list is returned.
     * @param string|array|null $scope OptionalA JSON-serialized object, describing scope of users. Defaults to BotCommandScopeDefault.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code or an empty string
     * @return Bot
     */
    public function getMyCommands(string|array|null $scope, string|null $language_code = ''): Bot
    {
        return $this->call(['scope' => $scope, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to change the bot&#39;s name. Returns <em>True</em> on success.
     * @param string|null $name OptionalNew bot name; 0-64 characters. Pass an empty string to remove the dedicated name for the given language.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code. If empty, the name will be shown to all users for whose language there is no dedicated name.
     * @return Bot
     */
    public function setMyName(string|null $name = '', string|null $language_code = ''): Bot
    {
        return $this->call(['name' => $name, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to get the current bot name for the given user language. Returns <a href="#botname">BotName</a> on success.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code or an empty string
     * @return Bot
     */
    public function getMyName(string|null $language_code = ''): Bot
    {
        return $this->call(['language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to change the bot&#39;s description, which is shown in the chat with the bot if the chat is empty. Returns <em>True</em> on success.
     * @param string|null $description OptionalNew bot description; 0-512 characters. Pass an empty string to remove the dedicated description for the given language.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code. If empty, the description will be applied to all users for whose language there is no dedicated description.
     * @return Bot
     */
    public function setMyDescription(string|null $description = '', string|null $language_code = ''): Bot
    {
        return $this->call(['description' => $description, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to get the current bot description for the given user language. Returns <a href="#botdescription">BotDescription</a> on success.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code or an empty string
     * @return Bot
     */
    public function getMyDescription(string|null $language_code = ''): Bot
    {
        return $this->call(['language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to change the bot&#39;s short description, which is shown on the bot&#39;s profile page and is sent together with the link when users share the bot. Returns <em>True</em> on success.
     * @param string|null $short_description OptionalNew short description for the bot; 0-120 characters. Pass an empty string to remove the dedicated short description for the given language.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code. If empty, the short description will be applied to all users for whose language there is no dedicated short description.
     * @return Bot
     */
    public function setMyShortDescription(string|null $short_description = '', string|null $language_code = ''): Bot
    {
        return $this->call(['short_description' => $short_description, 'language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to get the current bot short description for the given user language. Returns <a href="#botshortdescription">BotShortDescription</a> on success.
     * @param string|null $language_code OptionalA two-letter ISO 639-1 language code or an empty string
     * @return Bot
     */
    public function getMyShortDescription(string|null $language_code = ''): Bot
    {
        return $this->call(['language_code' => $language_code,], __FUNCTION__);
    }
    /**
     * Use this method to change the bot&#39;s menu button in a private chat, or the default menu button. Returns <em>True</em> on success.
     * @param int|null $chat_id OptionalUnique identifier for the target private chat. If not specified, default bot's menu button will be changed
     * @param string|array|null $menu_button OptionalA JSON-serialized object for the bot's new menu button. Defaults to MenuButtonDefault
     * @return Bot
     */
    public function setChatMenuButton(string|array|null $menu_button, int|null $chat_id = 0): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'menu_button' => $menu_button,], __FUNCTION__);
    }
    /**
     * Use this method to get the current value of the bot&#39;s menu button in a private chat, or the default menu button. Returns <a href="#menubutton">MenuButton</a> on success.
     * @param int|null $chat_id OptionalUnique identifier for the target private chat. If not specified, default bot's menu button will be returned
     * @return Bot
     */
    public function getChatMenuButton(int|null $chat_id = 0): Bot
    {
        return $this->call(['chat_id' => $chat_id,], __FUNCTION__);
    }
    /**
     * Use this method to change the default administrator rights requested by the bot when it&#39;s added as an administrator to groups or channels. These rights will be suggested to users, but they are free to modify the list before adding the bot. Returns <em>True</em> on success.
     * @param string|array|null $rights OptionalA JSON-serialized object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
     * @param bool|null $for_channels OptionalPass True to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
     * @return Bot
     */
    public function setMyDefaultAdministratorRights(string|array|null $rights, bool|null $for_channels = false): Bot
    {
        return $this->call(['rights' => $rights, 'for_channels' => $for_channels,], __FUNCTION__);
    }
    /**
     * Use this method to get the current default administrator rights of the bot. Returns <a href="#chatadministratorrights">ChatAdministratorRights</a> on success.
     * @param bool|null $for_channels OptionalPass True to get default administrator rights of the bot in channels. Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
     * @return Bot
     */
    public function getMyDefaultAdministratorRights(bool|null $for_channels = false): Bot
    {
        return $this->call(['for_channels' => $for_channels,], __FUNCTION__);
    }
    /**
     * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned.
     * @param int|string|null $chat_id OptionalRequired if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalRequired if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id OptionalRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param string|null $caption OptionalNew caption of the message, 0-1024 characters after entities parsing
     * @param string|null $parse_mode OptionalMode for parsing entities in the message caption. See formatting options for more details.
     * @param string|null $caption_entities OptionalA JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for an inline keyboard.
     * @return Bot
     */
    public function editMessageCaption(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can&#39;t be uploaded; use a previously uploaded file via its file_id or specify a URL. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned.
     * @param int|string|null $chat_id OptionalRequired if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalRequired if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id OptionalRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param string|array$media YesA JSON-serialized object for a new media content of the message
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for a new inline keyboard.
     * @return Bot
     */
    public function editMessageMedia(int|string|null $chat_id, string|array $media, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'media' => $media, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to edit live location messages. A location can be edited until its <em>live_period</em> expires or editing is explicitly disabled by a call to <a href="#stopmessagelivelocation">stopMessageLiveLocation</a>. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned.
     * @param int|string|null $chat_id OptionalRequired if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalRequired if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id OptionalRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param float $latitude YesLatitude of new location
     * @param float $longitude YesLongitude of new location
     * @param float|null $horizontal_accuracy OptionalThe radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $heading OptionalDirection in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius OptionalThe maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for a new inline keyboard.
     * @return Bot
     */
    public function editMessageLiveLocation(int|string|null $chat_id, float $latitude, float $longitude, float|null $horizontal_accuracy, int|null $message_id = 0, string|null $inline_message_id = '', int|null $heading = 0, int|null $proximity_alert_radius = 0, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'latitude' => $latitude, 'longitude' => $longitude, 'horizontal_accuracy' => $horizontal_accuracy, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to stop updating a live location message before <em>live_period</em> expires. On success, if the message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned.
     * @param int|string|null $chat_id OptionalRequired if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalRequired if inline_message_id is not specified. Identifier of the message with live location to stop
     * @param string|null $inline_message_id OptionalRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for a new inline keyboard.
     * @return Bot
     */
    public function stopMessageLiveLocation(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to edit only the reply markup of messages. On success, if the edited message is not an inline message, the edited <a href="#message">Message</a> is returned, otherwise <em>True</em> is returned.
     * @param int|string|null $chat_id OptionalRequired if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_id OptionalRequired if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inline_message_id OptionalRequired if chat_id and message_id are not specified. Identifier of the inline message
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for an inline keyboard.
     * @return Bot
     */
    public function editMessageReplyMarkup(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'inline_message_id' => $inline_message_id, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped <a href="#poll">Poll</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id YesIdentifier of the original message with the poll
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for a new message inline keyboard.
     * @return Bot
     */
    public function stopPoll(int|string $chat_id, int $message_id, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to delete a message, including service messages, with the following limitations:<br>- A message can only be deleted if it was sent less than 48 hours ago.<br>- Service messages about a supergroup, channel, or forum topic creation can&#39;t be deleted.<br>- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.<br>- Bots can delete outgoing messages in private chats, groups, and supergroups.<br>- Bots can delete incoming messages in private chats.<br>- Bots granted <em>can_post_messages</em> permissions can delete outgoing messages in channels.<br>- If the bot is an administrator of a group, it can delete any message there.<br>- If the bot has <em>can_delete_messages</em> permission in a supergroup or a channel, it can delete any message there.<br>Returns <em>True</em> on success.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $message_id YesIdentifier of the message to delete
     * @return Bot
     */
    public function deleteMessage(int|string $chat_id, int $message_id): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_id' => $message_id,], __FUNCTION__);
    }
    /**
     * This object represents a sticker set.
     * @param string $name Sticker set name
     * @param string $title Sticker set title
     * @param string $sticker_type Type of stickers in the set, currently one of “regular”, “mask”, “custom_emoji”
     * @param bool $is_animated True, if the sticker set contains animated stickers
     * @param bool $is_video True, if the sticker set contains video stickers
     * @param string $stickers List of all set stickers
     * @param string|array|null $thumbnail Optional. Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     * @return Bot
     */
    public function StickerSet(string $name, string $title, string $sticker_type, bool $is_animated, bool $is_video, string|array|null $thumbnail, ?string $stickers = null): Bot
    {
        return $this->call(['name' => $name, 'title' => $title, 'sticker_type' => $sticker_type, 'is_animated' => $is_animated, 'is_video' => $is_video, 'stickers' => $stickers, 'thumbnail' => $thumbnail,], __FUNCTION__);
    }
    /**
     * Use this method to send static .WEBP, <a href="https://telegram.org/blog/animated-stickers">animated</a> .TGS, or <a href="https://telegram.org/blog/video-stickers-better-reactions">video</a> .WEBM stickers. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $sticker YesSticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .WEBP sticker from the Internet, or upload a new .WEBP or .TGS sticker using multipart/form-data. More information on Sending Files . Video stickers can only be sent by a file_id. Animated stickers can't be sent via an HTTP URL.
     * @param string|null $emoji OptionalEmoji associated with the sticker; only for just uploaded stickers
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalAdditional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return Bot
     */
    public function sendSticker(int|string $chat_id, string $sticker, int|null $message_thread_id = 0, string|null $emoji = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'sticker' => $sticker, 'emoji' => $emoji, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to get a sticker set. On success, a <a href="#stickerset">StickerSet</a> object is returned.
     * @param string $name YesName of the sticker set
     * @return Bot
     */
    public function getStickerSet(string $name): Bot
    {
        return $this->call(['name' => $name,], __FUNCTION__);
    }
    /**
     * Use this method to get information about custom emoji stickers by their identifiers. Returns an Array of <a href="#sticker">Sticker</a> objects.
     * @param string $custom_emoji_ids YesList of custom emoji identifiers. At most 200 custom emoji identifiers can be specified.
     * @return Bot
     */
    public function getCustomEmojiStickers(?string $custom_emoji_ids = null): Bot
    {
        return $this->call(['custom_emoji_ids' => $custom_emoji_ids,], __FUNCTION__);
    }
    /**
     * Use this method to upload a file with a sticker for later use in the <a href="#createnewstickerset">createNewStickerSet</a> and <a href="#addstickertoset">addStickerToSet</a> methods (the file can be used multiple times). Returns the uploaded <a href="#file">File</a> on success.
     * @param int $user_id YesUser identifier of sticker file owner
     * @param string $sticker YesA file with the sticker in .WEBP, .PNG, .TGS, or .WEBM format. See https://core.telegram.org/stickers for technical requirements. More information on Sending Files 
     * @param string $sticker_format YesFormat of the sticker, must be one of “static”, “animated”, “video”
     * @return Bot
     */
    public function uploadStickerFile(int $user_id, string $sticker, string $sticker_format): Bot
    {
        return $this->call(['user_id' => $user_id, 'sticker' => $sticker, 'sticker_format' => $sticker_format,], __FUNCTION__);
    }
    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. Returns <em>True</em> on success.
     * @param int $user_id YesUser identifier of created sticker set owner
     * @param string $name YesShort name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only English letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in "_by_<bot_username>". <bot_username> is case insensitive. 1-64 characters.
     * @param string $title YesSticker set title, 1-64 characters
     * @param string $stickers YesA JSON-serialized list of 1-50 initial stickers to be added to the sticker set
     * @param string $sticker_format YesFormat of stickers in the set, must be one of “static”, “animated”, “video”
     * @param string|null $sticker_type OptionalType of stickers in the set, pass “regular”, “mask”, or “custom_emoji”. By default, a regular sticker set is created.
     * @param bool|null $needs_repainting OptionalPass True if stickers in the sticker set must be repainted to the color of text when used in messages, the accent color if used as emoji status, white on chat photos, or another appropriate color based on context; for custom emoji sticker sets only
     * @return Bot
     */
    public function createNewStickerSet(int $user_id, string $name, string $title, string $sticker_format, ?string $stickers = null, string|null $sticker_type = '', bool|null $needs_repainting = false): Bot
    {
        return $this->call(['user_id' => $user_id, 'name' => $name, 'title' => $title, 'stickers' => $stickers, 'sticker_format' => $sticker_format, 'sticker_type' => $sticker_type, 'needs_repainting' => $needs_repainting,], __FUNCTION__);
    }
    /**
     * Use this method to add a new sticker to a set created by the bot. The format of the added sticker must match the format of the other stickers in the set. Emoji sticker sets can have up to 200 stickers. Animated and video sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns <em>True</em> on success.
     * @param int $user_id YesUser identifier of sticker set owner
     * @param string $name YesSticker set name
     * @param string|array $sticker YesA JSON-serialized object with information about the added sticker. If exactly the same sticker had already been added to the set, then the set isn't changed.
     * @return Bot
     */
    public function addStickerToSet(int $user_id, string $name, string|array $sticker): Bot
    {
        return $this->call(['user_id' => $user_id, 'name' => $name, 'sticker' => $sticker,], __FUNCTION__);
    }
    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns <em>True</em> on success.
     * @param string $sticker YesFile identifier of the sticker
     * @param int $position YesNew sticker position in the set, zero-based
     * @return Bot
     */
    public function setStickerPositionInSet(string $sticker, int $position): Bot
    {
        return $this->call(['sticker' => $sticker, 'position' => $position,], __FUNCTION__);
    }
    /**
     * Use this method to delete a sticker from a set created by the bot. Returns <em>True</em> on success.
     * @param string $sticker YesFile identifier of the sticker
     * @return Bot
     */
    public function deleteStickerFromSet(string $sticker): Bot
    {
        return $this->call(['sticker' => $sticker,], __FUNCTION__);
    }
    /**
     * Use this method to change the list of emoji assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     * @param string $sticker YesFile identifier of the sticker
     * @param string $emoji_list YesA JSON-serialized list of 1-20 emoji associated with the sticker
     * @return Bot
     */
    public function setStickerEmojiList(string $sticker, ?string $emoji_list = null): Bot
    {
        return $this->call(['sticker' => $sticker, 'emoji_list' => $emoji_list,], __FUNCTION__);
    }
    /**
     * Use this method to change search keywords assigned to a regular or custom emoji sticker. The sticker must belong to a sticker set created by the bot. Returns <em>True</em> on success.
     * @param string $sticker YesFile identifier of the sticker
     * @param string|null $keywords OptionalA JSON-serialized list of 0-20 search keywords for the sticker with total length of up to 64 characters
     * @return Bot
     */
    public function setStickerKeywords(string $sticker, ?string $keywords = null): Bot
    {
        return $this->call(['sticker' => $sticker, 'keywords' => $keywords,], __FUNCTION__);
    }
    /**
     * Use this method to change the <a href="#maskposition">mask position</a> of a mask sticker. The sticker must belong to a sticker set that was created by the bot. Returns <em>True</em> on success.
     * @param string $sticker YesFile identifier of the sticker
     * @param string|array|null $mask_position OptionalA JSON-serialized object with the position where the mask should be placed on faces. Omit the parameter to remove the mask position.
     * @return Bot
     */
    public function setStickerMaskPosition(string $sticker, string|array|null $mask_position): Bot
    {
        return $this->call(['sticker' => $sticker, 'mask_position' => $mask_position,], __FUNCTION__);
    }
    /**
     * Use this method to set the title of a created sticker set. Returns <em>True</em> on success.
     * @param string $name YesSticker set name
     * @param string $title YesSticker set title, 1-64 characters
     * @return Bot
     */
    public function setStickerSetTitle(string $name, string $title): Bot
    {
        return $this->call(['name' => $name, 'title' => $title,], __FUNCTION__);
    }
    /**
     * Use this method to set the thumbnail of a regular or mask sticker set. The format of the thumbnail file must match the format of the stickers in the set. Returns <em>True</em> on success.
     * @param string $name YesSticker set name
     * @param int $user_id YesUser identifier of the sticker set owner
     * @param string|null $thumbnail OptionalA .WEBP or .PNG image with the thumbnail, must be up to 128 kilobytes in size and have a width and height of exactly 100px, or a .TGS animation with a thumbnail up to 32 kilobytes in size (see https://core.telegram.org/stickers#animated-sticker-requirements for animated sticker technical requirements), or a WEBM video with the thumbnail up to 32 kilobytes in size; see https://core.telegram.org/stickers#video-sticker-requirements for video sticker technical requirements. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More information on Sending Files . Animated and video sticker set thumbnails can't be uploaded via HTTP URL. If omitted, then the thumbnail is dropped and the first sticker is used as the thumbnail.
     * @return Bot
     */
    public function setStickerSetThumbnail(string $name, int $user_id, string|null $thumbnail): Bot
    {
        return $this->call(['name' => $name, 'user_id' => $user_id, 'thumbnail' => $thumbnail,], __FUNCTION__);
    }
    /**
     * Use this method to set the thumbnail of a custom emoji sticker set. Returns <em>True</em> on success.
     * @param string $name YesSticker set name
     * @param string|null $custom_emoji_id OptionalCustom emoji identifier of a sticker from the sticker set; pass an empty string to drop the thumbnail and use the first sticker as the thumbnail.
     * @return Bot
     */
    public function setCustomEmojiStickerSetThumbnail(string $name, string|null $custom_emoji_id = ''): Bot
    {
        return $this->call(['name' => $name, 'custom_emoji_id' => $custom_emoji_id,], __FUNCTION__);
    }
    /**
     * Use this method to delete a sticker set that was created by the bot. Returns <em>True</em> on success.
     * @param string $name YesSticker set name
     * @return Bot
     */
    public function deleteStickerSet(string $name): Bot
    {
        return $this->call(['name' => $name,], __FUNCTION__);
    }
    /**
     * Use this method to send answers to an inline query. On success, <em>True</em> is returned.<br>No more than <strong>50</strong> results per query are allowed.
     * @param string $inline_query_id YesUnique identifier for the answered query
     * @param string $results YesA JSON-serialized array of results for the inline query
     * @param int|null $cache_time OptionalThe maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
     * @param bool|null $is_personal OptionalPass True if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query.
     * @param string|null $next_offset OptionalPass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don't support pagination. Offset length can't exceed 64 bytes.
     * @param string|array|null $button OptionalA JSON-serialized object describing a button to be shown above inline query results
     * @return Bot
     */
    public function answerInlineQuery(string $inline_query_id, string|array|null $button, ?string $results = null, int|null $cache_time = 0, bool|null $is_personal = false, string|null $next_offset = ''): Bot
    {
        return $this->call(['inline_query_id' => $inline_query_id, 'results' => $results, 'cache_time' => $cache_time, 'is_personal' => $is_personal, 'next_offset' => $next_offset, 'button' => $button,], __FUNCTION__);
    }
    /**
     * This object represents a button to be shown above inline query results. You <strong>must</strong> use exactly one of the optional fields.
     * @param string $text Label text on the button
     * @param string|null $web_app Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to switch back to the inline mode using the method switchInlineQuery inside the Web App.
     * @param string|null $start_parameter Optional. Deep-linking parameter for the /start message sent to the bot when a user presses the button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
     * @return Bot
     */
    public function InlineQueryResultsButton(string $text, string|null $web_app, string|null $start_parameter = ''): Bot
    {
        return $this->call(['text' => $text, 'web_app' => $web_app, 'start_parameter' => $start_parameter,], __FUNCTION__);
    }
    /**
     * This object represents one result of an inline query. Telegram clients currently support results of the following 20 types:</p><ul><li><a href="#inlinequeryresultcachedaudio">InlineQueryResultCachedAudio</a></li><li><a href="#inlinequeryresultcacheddocument">InlineQueryResultCachedDocument</a></li><li><a href="#inlinequeryresultcachedgif">InlineQueryResultCachedGif</a></li><li><a href="#inlinequeryresultcachedmpeg4gif">InlineQueryResultCachedMpeg4Gif</a></li><li><a href="#inlinequeryresultcachedphoto">InlineQueryResultCachedPhoto</a></li><li><a href="#inlinequeryresultcachedsticker">InlineQueryResultCachedSticker</a></li><li><a href="#inlinequeryresultcachedvideo">InlineQueryResultCachedVideo</a></li><li><a href="#inlinequeryresultcachedvoice">InlineQueryResultCachedVoice</a></li><li><a href="#inlinequeryresultarticle">InlineQueryResultArticle</a></li><li><a href="#inlinequeryresultaudio">InlineQueryResultAudio</a></li><li><a href="#inlinequeryresultcontact">InlineQueryResultContact</a></li><li><a href="#inlinequeryresultgame">InlineQueryResultGame</a></li><li><a href="#inlinequeryresultdocument">InlineQueryResultDocument</a></li><li><a href="#inlinequeryresultgif">InlineQueryResultGif</a></li><li><a href="#inlinequeryresultlocation">InlineQueryResultLocation</a></li><li><a href="#inlinequeryresultmpeg4gif">InlineQueryResultMpeg4Gif</a></li><li><a href="#inlinequeryresultphoto">InlineQueryResultPhoto</a></li><li><a href="#inlinequeryresultvenue">InlineQueryResultVenue</a></li><li><a href="#inlinequeryresultvideo">InlineQueryResultVideo</a></li><li><a href="#inlinequeryresultvoice">InlineQueryResultVoice</a></li></ul><p><strong>Note:</strong> All URLs passed in inline query results will be available to end users and therefore must be assumed to be <strong>public</strong>.</p><h4><a class="anchor" name="inlinequeryresultarticle" href="#inlinequeryresultarticle"><i class="anchor-icon"></i></a>InlineQueryResultArticle</h4><p>Represents a link to an article or web page.
     * @param string $type Type of the result, must be article
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $title Title of the result
     * @param string|array $input_message_content Content of the message to be sent
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|null $url Optional. URL of the result
     * @param bool|null $hide_url Optional. Pass True if you don't want the URL to be shown in the message
     * @param string|null $description Optional. Short description of the result
     * @param string|null $thumbnail_url Optional. Url of the thumbnail for the result
     * @param int|null $thumbnail_width Optional. Thumbnail width
     * @param int|null $thumbnail_height Optional. Thumbnail height
     * @return Bot
     */
    public function InlineQueryResult(string $type, string $id, string $title, string|array $input_message_content, array|string|null $reply_markup, string|null $url = '', bool|null $hide_url = false, string|null $description = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'title' => $title, 'input_message_content' => $input_message_content, 'reply_markup' => $reply_markup, 'url' => $url, 'hide_url' => $hide_url, 'description' => $description, 'thumbnail_url' => $thumbnail_url, 'thumbnail_width' => $thumbnail_width, 'thumbnail_height' => $thumbnail_height,], __FUNCTION__);
    }
    /**
     * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the photo.
     * @param string $type Type of the result, must be photo
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $photo_url A valid URL of the photo. Photo must be in JPEG format. Photo size must not exceed 5MB
     * @param string $thumbnail_url URL of the thumbnail for the photo
     * @param int|null $photo_width Optional. Width of the photo
     * @param int|null $photo_height Optional. Height of the photo
     * @param string|null $title Optional. Title for the result
     * @param string|null $description Optional. Short description of the result
     * @param string|null $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the photo
     * @return Bot
     */
    public function InlineQueryResultPhoto(string $type, string $id, string $photo_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $photo_width = 0, int|null $photo_height = 0, string|null $title = '', string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'photo_url' => $photo_url, 'thumbnail_url' => $thumbnail_url, 'photo_width' => $photo_width, 'photo_height' => $photo_height, 'title' => $title, 'description' => $description, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the animation.
     * @param string $type Type of the result, must be gif
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gif_url A valid URL for the GIF file. File size must not exceed 1MB
     * @param int|null $gif_width Optional. Width of the GIF
     * @param int|null $gif_height Optional. Height of the GIF
     * @param int|null $gif_duration Optional. Duration of the GIF in seconds
     * @param string $thumbnail_url URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @param string|null $thumbnail_mime_type Optional. MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg”
     * @param string|null $title Optional. Title for the result
     * @param string|null $caption Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the GIF animation
     * @return Bot
     */
    public function InlineQueryResultGif(string $type, string $id, string $gif_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $gif_width = 0, int|null $gif_height = 0, int|null $gif_duration = 0, string|null $thumbnail_mime_type = '', string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'gif_url' => $gif_url, 'gif_width' => $gif_width, 'gif_height' => $gif_height, 'gif_duration' => $gif_duration, 'thumbnail_url' => $thumbnail_url, 'thumbnail_mime_type' => $thumbnail_mime_type, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound). By default, this animated MPEG-4 file will be sent by the user with optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the animation.
     * @param string $type Type of the result, must be mpeg4_gif
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $mpeg4_url A valid URL for the MPEG4 file. File size must not exceed 1MB
     * @param int|null $mpeg4_width Optional. Video width
     * @param int|null $mpeg4_height Optional. Video height
     * @param int|null $mpeg4_duration Optional. Video duration in seconds
     * @param string $thumbnail_url URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @param string|null $thumbnail_mime_type Optional. MIME type of the thumbnail, must be one of “image/jpeg”, “image/gif”, or “video/mp4”. Defaults to “image/jpeg”
     * @param string|null $title Optional. Title for the result
     * @param string|null $caption Optional. Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the video animation
     * @return Bot
     */
    public function InlineQueryResultMpeg4Gif(string $type, string $id, string $mpeg4_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $mpeg4_width = 0, int|null $mpeg4_height = 0, int|null $mpeg4_duration = 0, string|null $thumbnail_mime_type = '', string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'mpeg4_url' => $mpeg4_url, 'mpeg4_width' => $mpeg4_width, 'mpeg4_height' => $mpeg4_height, 'mpeg4_duration' => $mpeg4_duration, 'thumbnail_url' => $thumbnail_url, 'thumbnail_mime_type' => $thumbnail_mime_type, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the video.</p><blockquote><p>If an InlineQueryResultVideo message contains an embedded video (e.g., YouTube), you <strong>must</strong> replace its content using <em>input_message_content</em>.</p></blockquote><table class="table"><thead><tr><th>Field</th><th>Type</th><th>Description</th></tr></thead><tbody><tr><td>type</td><td>String</td><td>Type of the result, must be <em>video</em></td></tr><tr><td>id</td><td>String</td><td>Unique identifier for this result, 1-64 bytes</td></tr><tr><td>video_url</td><td>String</td><td>A valid URL for the embedded video player or video file</td></tr><tr><td>mime_type</td><td>String</td><td>MIME type of the content of the video URL, “text/html” or “video/mp4”</td></tr><tr><td>thumbnail_url</td><td>String</td><td>URL of the thumbnail (JPEG only) for the video</td></tr><tr><td>title</td><td>String</td><td>Title for the result</td></tr><tr><td>caption</td><td>String</td><td><em>Optional</em>. Caption of the video to be sent, 0-1024 characters after entities parsing</td></tr><tr><td>parse_mode</td><td>String</td><td><em>Optional</em>. Mode for parsing entities in the video caption. See <a href="#formatting-options">formatting options</a> for more details.</td></tr><tr><td>caption_entities</td><td>Array of <a href="#messageentity">MessageEntity</a></td><td><em>Optional</em>. List of special entities that appear in the caption, which can be specified instead of <em>parse_mode</em></td></tr><tr><td>video_width</td><td>Integer</td><td><em>Optional</em>. Video width</td></tr><tr><td>video_height</td><td>Integer</td><td><em>Optional</em>. Video height</td></tr><tr><td>video_duration</td><td>Integer</td><td><em>Optional</em>. Video duration in seconds</td></tr><tr><td>description</td><td>String</td><td><em>Optional</em>. Short description of the result</td></tr><tr><td>reply_markup</td><td><a href="#inlinekeyboardmarkup">InlineKeyboardMarkup</a></td><td><em>Optional</em>. <a href="/bots/features#inline-keyboards">Inline keyboard</a> attached to the message</td></tr><tr><td>input_message_content</td><td><a href="#inputmessagecontent">InputMessageContent</a></td><td><em>Optional</em>. Content of the message to be sent instead of the video. This field is <strong>required</strong> if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).</td></tr></tbody></table><h4><a class="anchor" name="inlinequeryresultaudio" href="#inlinequeryresultaudio"><i class="anchor-icon"></i></a>InlineQueryResultAudio</h4><p>Represents a link to an MP3 audio file. By default, this audio file will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the audio.
     * @param string $type Type of the result, must be audio
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $audio_url A valid URL for the audio file
     * @param string $title Title
     * @param string|null $caption Optional. Caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param string|null $performer Optional. Performer
     * @param int|null $audio_duration Optional. Audio duration in seconds
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the audio
     * @return Bot
     */
    public function InlineQueryResultVideo(string $type, string $id, string $audio_url, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, string|null $performer = '', int|null $audio_duration = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'audio_url' => $audio_url, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'performer' => $performer, 'audio_duration' => $audio_duration, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a voice recording in an .OGG container encoded with OPUS. By default, this voice recording will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the the voice message.
     * @param string $type Type of the result, must be voice
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $voice_url A valid URL for the voice recording
     * @param string $title Recording title
     * @param string|null $caption Optional. Caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $voice_duration Optional. Recording duration in seconds
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the voice recording
     * @return Bot
     */
    public function InlineQueryResultVoice(string $type, string $id, string $voice_url, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $voice_duration = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'voice_url' => $voice_url, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'voice_duration' => $voice_duration, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the file. Currently, only <strong>.PDF</strong> and <strong>.ZIP</strong> files can be sent using this method.
     * @param string $type Type of the result, must be document
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $title Title for the result
     * @param string|null $caption Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param string $document_url A valid URL for the file
     * @param string $mime_type MIME type of the content of the file, either “application/pdf” or “application/zip”
     * @param string|null $description Optional. Short description of the result
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the file
     * @param string|null $thumbnail_url Optional. URL of the thumbnail (JPEG only) for the file
     * @param int|null $thumbnail_width Optional. Thumbnail width
     * @param int|null $thumbnail_height Optional. Thumbnail height
     * @return Bot
     */
    public function InlineQueryResultDocument(string $type, string $id, string $title, string $document_url, string $mime_type, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, string|null $description = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'document_url' => $document_url, 'mime_type' => $mime_type, 'description' => $description, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content, 'thumbnail_url' => $thumbnail_url, 'thumbnail_width' => $thumbnail_width, 'thumbnail_height' => $thumbnail_height,], __FUNCTION__);
    }
    /**
     * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the location.
     * @param string $type Type of the result, must be location
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param float $latitude Location latitude in degrees
     * @param float $longitude Location longitude in degrees
     * @param string $title Location title
     * @param float|null $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     * @param int|null $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the location
     * @param string|null $thumbnail_url Optional. Url of the thumbnail for the result
     * @param int|null $thumbnail_width Optional. Thumbnail width
     * @param int|null $thumbnail_height Optional. Thumbnail height
     * @return Bot
     */
    public function InlineQueryResultLocation(string $type, string $id, float $latitude, float $longitude, string $title, float|null $horizontal_accuracy, array|string|null $reply_markup, string|array|null $input_message_content, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0, string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'horizontal_accuracy' => $horizontal_accuracy, 'live_period' => $live_period, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content, 'thumbnail_url' => $thumbnail_url, 'thumbnail_width' => $thumbnail_width, 'thumbnail_height' => $thumbnail_height,], __FUNCTION__);
    }
    /**
     * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the venue.
     * @param string $type Type of the result, must be venue
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param Float $latitude Latitude of the venue location in degrees
     * @param Float $longitude Longitude of the venue location in degrees
     * @param string $title Title of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Optional. Foursquare identifier of the venue if known
     * @param string|null $foursquare_type Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id Optional. Google Places identifier of the venue
     * @param string|null $google_place_type Optional. Google Places type of the venue. (See supported types.)
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the venue
     * @param string|null $thumbnail_url Optional. Url of the thumbnail for the result
     * @param int|null $thumbnail_width Optional. Thumbnail width
     * @param int|null $thumbnail_height Optional. Thumbnail height
     * @return Bot
     */
    public function InlineQueryResultVenue(string $type, string $id, Float $latitude, Float $longitude, string $title, string $address, array|string|null $reply_markup, string|array|null $input_message_content, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address, 'foursquare_id' => $foursquare_id, 'foursquare_type' => $foursquare_type, 'google_place_id' => $google_place_id, 'google_place_type' => $google_place_type, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content, 'thumbnail_url' => $thumbnail_url, 'thumbnail_width' => $thumbnail_width, 'thumbnail_height' => $thumbnail_height,], __FUNCTION__);
    }
    /**
     * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the contact.
     * @param string $type Type of the result, must be contact
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Optional. Contact's last name
     * @param string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the contact
     * @param string|null $thumbnail_url Optional. Url of the thumbnail for the result
     * @param int|null $thumbnail_width Optional. Thumbnail width
     * @param int|null $thumbnail_height Optional. Thumbnail height
     * @return Bot
     */
    public function InlineQueryResultContact(string $type, string $id, string $phone_number, string $first_name, array|string|null $reply_markup, string|array|null $input_message_content, string|null $last_name = '', string|null $vcard = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'phone_number' => $phone_number, 'first_name' => $first_name, 'last_name' => $last_name, 'vcard' => $vcard, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content, 'thumbnail_url' => $thumbnail_url, 'thumbnail_width' => $thumbnail_width, 'thumbnail_height' => $thumbnail_height,], __FUNCTION__);
    }
    /**
     * Represents a <a href="#games">Game</a>.
     * @param string $type Type of the result, must be game
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $game_short_name Short name of the game
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @return Bot
     */
    public function InlineQueryResultGame(string $type, string $id, string $game_short_name, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'game_short_name' => $game_short_name, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Represents a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the photo.
     * @param string $type Type of the result, must be photo
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $photo_file_id A valid file identifier of the photo
     * @param string|null $title Optional. Title for the result
     * @param string|null $description Optional. Short description of the result
     * @param string|null $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the photo
     * @return Bot
     */
    public function InlineQueryResultCachedPhoto(string $type, string $id, string $photo_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'photo_file_id' => $photo_file_id, 'title' => $title, 'description' => $description, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to an animated GIF file stored on the Telegram servers. By default, this animated GIF file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with specified content instead of the animation.
     * @param string $type Type of the result, must be gif
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gif_file_id A valid file identifier for the GIF file
     * @param string|null $title Optional. Title for the result
     * @param string|null $caption Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the GIF animation
     * @return Bot
     */
    public function InlineQueryResultCachedGif(string $type, string $id, string $gif_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'gif_file_id' => $gif_file_id, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound) stored on the Telegram servers. By default, this animated MPEG-4 file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the animation.
     * @param string $type Type of the result, must be mpeg4_gif
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $mpeg4_file_id A valid file identifier for the MPEG4 file
     * @param string|null $title Optional. Title for the result
     * @param string|null $caption Optional. Caption of the MPEG-4 file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the video animation
     * @return Bot
     */
    public function InlineQueryResultCachedMpeg4Gif(string $type, string $id, string $mpeg4_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'mpeg4_file_id' => $mpeg4_file_id, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a sticker stored on the Telegram servers. By default, this sticker will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the sticker.
     * @param string $type Type of the result, must be sticker
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $sticker_file_id A valid file identifier of the sticker
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the sticker
     * @return Bot
     */
    public function InlineQueryResultCachedSticker(string $type, string $id, string $sticker_file_id, array|string|null $reply_markup, string|array|null $input_message_content): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'sticker_file_id' => $sticker_file_id, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a file stored on the Telegram servers. By default, this file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the file.
     * @param string $type Type of the result, must be document
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $title Title for the result
     * @param string $document_file_id A valid file identifier for the file
     * @param string|null $description Optional. Short description of the result
     * @param string|null $caption Optional. Caption of the document to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the document caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the file
     * @return Bot
     */
    public function InlineQueryResultCachedDocument(string $type, string $id, string $title, string $document_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'title' => $title, 'document_file_id' => $document_file_id, 'description' => $description, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a video file stored on the Telegram servers. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the video.
     * @param string $type Type of the result, must be video
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $video_file_id A valid file identifier for the video file
     * @param string $title Title for the result
     * @param string|null $description Optional. Short description of the result
     * @param string|null $caption Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the video caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the video
     * @return Bot
     */
    public function InlineQueryResultCachedVideo(string $type, string $id, string $video_file_id, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'video_file_id' => $video_file_id, 'title' => $title, 'description' => $description, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to a voice message stored on the Telegram servers. By default, this voice message will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the voice message.
     * @param string $type Type of the result, must be voice
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $voice_file_id A valid file identifier for the voice message
     * @param string $title Voice message title
     * @param string|null $caption Optional. Caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the voice message
     * @return Bot
     */
    public function InlineQueryResultCachedVoice(string $type, string $id, string $voice_file_id, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'voice_file_id' => $voice_file_id, 'title' => $title, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * Represents a link to an MP3 audio file stored on the Telegram servers. By default, this audio file will be sent by the user. Alternatively, you can use <em>input_message_content</em> to send a message with the specified content instead of the audio.
     * @param string $type Type of the result, must be audio
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $audio_file_id A valid file identifier for the audio file
     * @param string|null $caption Optional. Caption, 0-1024 characters after entities parsing
     * @param string|null $parse_mode Optional. Mode for parsing entities in the audio caption. See formatting options for more details.
     * @param string|null $caption_entities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param array|string|null $reply_markup Optional. Inline keyboard attached to the message
     * @param string|array|null $input_message_content Optional. Content of the message to be sent instead of the audio
     * @return Bot
     */
    public function InlineQueryResultCachedAudio(string $type, string $id, string $audio_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
    {
        return $this->call(['type' => $type, 'id' => $id, 'audio_file_id' => $audio_file_id, 'caption' => $caption, 'parse_mode' => $parse_mode, 'caption_entities' => $caption_entities, 'reply_markup' => $reply_markup, 'input_message_content' => $input_message_content,], __FUNCTION__);
    }
    /**
     * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently support the following 5 types:</p><ul><li><a href="#inputtextmessagecontent">InputTextMessageContent</a></li><li><a href="#inputlocationmessagecontent">InputLocationMessageContent</a></li><li><a href="#inputvenuemessagecontent">InputVenueMessageContent</a></li><li><a href="#inputcontactmessagecontent">InputContactMessageContent</a></li><li><a href="#inputinvoicemessagecontent">InputInvoiceMessageContent</a></li></ul><h4><a class="anchor" name="inputtextmessagecontent" href="#inputtextmessagecontent"><i class="anchor-icon"></i></a>InputTextMessageContent</h4><p>Represents the <a href="#inputmessagecontent">content</a> of a text message to be sent as the result of an inline query.
     * @param string $message_text Text of the message to be sent, 1-4096 characters
     * @param string|null $parse_mode Optional. Mode for parsing entities in the message text. See formatting options for more details.
     * @param string|null $entities Optional. List of special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $disable_web_page_preview Optional. Disables link previews for links in the sent message
     * @return Bot
     */
    public function InputMessageContent(string $message_text, string|null $parse_mode = '', ?string $entities = null, bool|null $disable_web_page_preview = false): Bot
    {
        return $this->call(['message_text' => $message_text, 'parse_mode' => $parse_mode, 'entities' => $entities, 'disable_web_page_preview' => $disable_web_page_preview,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#inputmessagecontent">content</a> of a location message to be sent as the result of an inline query.
     * @param Float $latitude Latitude of the location in degrees
     * @param Float $longitude Longitude of the location in degrees
     * @param float|null $horizontal_accuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $live_period Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     * @param int|null $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximity_alert_radius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @return Bot
     */
    public function InputLocationMessageContent(Float $latitude, Float $longitude, float|null $horizontal_accuracy, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0): Bot
    {
        return $this->call(['latitude' => $latitude, 'longitude' => $longitude, 'horizontal_accuracy' => $horizontal_accuracy, 'live_period' => $live_period, 'heading' => $heading, 'proximity_alert_radius' => $proximity_alert_radius,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#inputmessagecontent">content</a> of a venue message to be sent as the result of an inline query.
     * @param Float $latitude Latitude of the venue in degrees
     * @param Float $longitude Longitude of the venue in degrees
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquare_id Optional. Foursquare identifier of the venue, if known
     * @param string|null $foursquare_type Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     * @param string|null $google_place_id Optional. Google Places identifier of the venue
     * @param string|null $google_place_type Optional. Google Places type of the venue. (See supported types.)
     * @return Bot
     */
    public function InputVenueMessageContent(Float $latitude, Float $longitude, string $title, string $address, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = ''): Bot
    {
        return $this->call(['latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address, 'foursquare_id' => $foursquare_id, 'foursquare_type' => $foursquare_type, 'google_place_id' => $google_place_id, 'google_place_type' => $google_place_type,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#inputmessagecontent">content</a> of a contact message to be sent as the result of an inline query.
     * @param string $phone_number Contact's phone number
     * @param string $first_name Contact's first name
     * @param string|null $last_name Optional. Contact's last name
     * @param string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @return Bot
     */
    public function InputContactMessageContent(string $phone_number, string $first_name, string|null $last_name = '', string|null $vcard = ''): Bot
    {
        return $this->call(['phone_number' => $phone_number, 'first_name' => $first_name, 'last_name' => $last_name, 'vcard' => $vcard,], __FUNCTION__);
    }
    /**
     * Represents the <a href="#inputmessagecontent">content</a> of an invoice message to be sent as the result of an inline query.
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @param string $provider_token Payment provider token, obtained via @BotFather
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies
     * @param string $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $max_tip_amount Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param string|null $suggested_tip_amounts Optional. A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
     * @param string|null $provider_data Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider.
     * @param string|null $photo_url Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
     * @param int|null $photo_size Optional. Photo size in bytes
     * @param int|null $photo_width Optional. Photo width
     * @param int|null $photo_height Optional. Photo height
     * @param bool|null $need_name Optional. Pass True if you require the user's full name to complete the order
     * @param bool|null $need_phone_number Optional. Pass True if you require the user's phone number to complete the order
     * @param bool|null $need_email Optional. Pass True if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address Optional. Pass True if you require the user's shipping address to complete the order
     * @param bool|null $send_phone_number_to_provider Optional. Pass True if the user's phone number should be sent to provider
     * @param bool|null $send_email_to_provider Optional. Pass True if the user's email address should be sent to provider
     * @param bool|null $is_flexible Optional. Pass True if the final price depends on the shipping method
     * @return Bot
     */
    public function InputInvoiceMessageContent(string $title, string $description, string $payload, string $provider_token, string $currency, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false): Bot
    {
        return $this->call(['title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $provider_token, 'currency' => $currency, 'prices' => $prices, 'max_tip_amount' => $max_tip_amount, 'suggested_tip_amounts' => $suggested_tip_amounts, 'provider_data' => $provider_data, 'photo_url' => $photo_url, 'photo_size' => $photo_size, 'photo_width' => $photo_width, 'photo_height' => $photo_height, 'need_name' => $need_name, 'need_phone_number' => $need_phone_number, 'need_email' => $need_email, 'need_shipping_address' => $need_shipping_address, 'send_phone_number_to_provider' => $send_phone_number_to_provider, 'send_email_to_provider' => $send_email_to_provider, 'is_flexible' => $is_flexible,], __FUNCTION__);
    }
    /**
     * Use this method to set the result of an interaction with a <a href="/bots/webapps">Web App</a> and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a <a href="#sentwebappmessage">SentWebAppMessage</a> object is returned.
     * @param string $web_app_query_id YesUnique identifier for the query to be answered
     * @param string|array $result YesA JSON-serialized object describing the message to be sent
     * @return Bot
     */
    public function answerWebAppQuery(string $web_app_query_id, string|array $result): Bot
    {
        return $this->call(['web_app_query_id' => $web_app_query_id, 'result' => $result,], __FUNCTION__);
    }
    /**
     * Describes an inline message sent by a <a href="/bots/webapps">Web App</a> on behalf of a user.
     * @param string|null $inline_message_id Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
     * @return Bot
     */
    public function SentWebAppMessage(string|null $inline_message_id = ''): Bot
    {
        return $this->call(['inline_message_id' => $inline_message_id,], __FUNCTION__);
    }
    /**
     * Use this method to send invoices. On success, the sent <a href="#message">Message</a> is returned.
     * @param int|string $chat_id YesUnique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $title YesProduct name, 1-32 characters
     * @param string $description YesProduct description, 1-255 characters
     * @param string $payload YesBot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @param string $provider_token YesPayment provider token, obtained via @BotFather
     * @param string $currency YesThree-letter ISO 4217 currency code, see more on currencies
     * @param string $prices YesPrice breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $max_tip_amount OptionalThe maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param string|null $suggested_tip_amounts OptionalA JSON-serialized array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
     * @param string|null $start_parameter OptionalUnique deep-linking parameter. If left empty, forwarded copies of the sent message will have a Pay button, allowing multiple users to pay directly from the forwarded message, using the same invoice. If non-empty, forwarded copies of the sent message will have a URL button with a deep link to the bot (instead of a Pay button), with the value used as the start parameter
     * @param string|null $provider_data OptionalJSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
     * @param string|null $photo_url OptionalURL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
     * @param int|null $photo_size OptionalPhoto size in bytes
     * @param int|null $photo_width OptionalPhoto width
     * @param int|null $photo_height OptionalPhoto height
     * @param bool|null $need_name OptionalPass True if you require the user's full name to complete the order
     * @param bool|null $need_phone_number OptionalPass True if you require the user's phone number to complete the order
     * @param bool|null $need_email OptionalPass True if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address OptionalPass True if you require the user's shipping address to complete the order
     * @param bool|null $send_phone_number_to_provider OptionalPass True if the user's phone number should be sent to provider
     * @param bool|null $send_email_to_provider OptionalPass True if the user's email address should be sent to provider
     * @param bool|null $is_flexible OptionalPass True if the final price depends on the shipping method
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for an inline keyboard. If empty, one 'Pay total price' button will be shown. If not empty, the first button must be a Pay button.
     * @return Bot
     */
    public function sendInvoice(int|string $chat_id, string $title, string $description, string $payload, string $provider_token, string $currency, int|null $message_thread_id = 0, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $start_parameter = '', string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $provider_token, 'currency' => $currency, 'prices' => $prices, 'max_tip_amount' => $max_tip_amount, 'suggested_tip_amounts' => $suggested_tip_amounts, 'start_parameter' => $start_parameter, 'provider_data' => $provider_data, 'photo_url' => $photo_url, 'photo_size' => $photo_size, 'photo_width' => $photo_width, 'photo_height' => $photo_height, 'need_name' => $need_name, 'need_phone_number' => $need_phone_number, 'need_email' => $need_email, 'need_shipping_address' => $need_shipping_address, 'send_phone_number_to_provider' => $send_phone_number_to_provider, 'send_email_to_provider' => $send_email_to_provider, 'is_flexible' => $is_flexible, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to create a link for an invoice. Returns the created invoice link as <em>String</em> on success.
     * @param string $title YesProduct name, 1-32 characters
     * @param string $description YesProduct description, 1-255 characters
     * @param string $payload YesBot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @param string $provider_token YesPayment provider token, obtained via BotFather
     * @param string $currency YesThree-letter ISO 4217 currency code, see more on currencies
     * @param string $prices YesPrice breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $max_tip_amount OptionalThe maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param string|null $suggested_tip_amounts OptionalA JSON-serialized array of suggested amounts of tips in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
     * @param string|null $provider_data OptionalJSON-serialized data about the invoice, which will be shared with the payment provider. A detailed description of required fields should be provided by the payment provider.
     * @param string|null $photo_url OptionalURL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service.
     * @param int|null $photo_size OptionalPhoto size in bytes
     * @param int|null $photo_width OptionalPhoto width
     * @param int|null $photo_height OptionalPhoto height
     * @param bool|null $need_name OptionalPass True if you require the user's full name to complete the order
     * @param bool|null $need_phone_number OptionalPass True if you require the user's phone number to complete the order
     * @param bool|null $need_email OptionalPass True if you require the user's email address to complete the order
     * @param bool|null $need_shipping_address OptionalPass True if you require the user's shipping address to complete the order
     * @param bool|null $send_phone_number_to_provider OptionalPass True if the user's phone number should be sent to the provider
     * @param bool|null $send_email_to_provider OptionalPass True if the user's email address should be sent to the provider
     * @param bool|null $is_flexible OptionalPass True if the final price depends on the shipping method
     * @return Bot
     */
    public function createInvoiceLink(string $title, string $description, string $payload, string $provider_token, string $currency, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false): Bot
    {
        return $this->call(['title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $provider_token, 'currency' => $currency, 'prices' => $prices, 'max_tip_amount' => $max_tip_amount, 'suggested_tip_amounts' => $suggested_tip_amounts, 'provider_data' => $provider_data, 'photo_url' => $photo_url, 'photo_size' => $photo_size, 'photo_width' => $photo_width, 'photo_height' => $photo_height, 'need_name' => $need_name, 'need_phone_number' => $need_phone_number, 'need_email' => $need_email, 'need_shipping_address' => $need_shipping_address, 'send_phone_number_to_provider' => $send_phone_number_to_provider, 'send_email_to_provider' => $send_email_to_provider, 'is_flexible' => $is_flexible,], __FUNCTION__);
    }
    /**
     * If you sent an invoice requesting a shipping address and the parameter <em>is_flexible</em> was specified, the Bot API will send an <a href="#update">Update</a> with a <em>shipping_query</em> field to the bot. Use this method to reply to shipping queries. On success, <em>True</em> is returned.
     * @param string $shipping_query_id YesUnique identifier for the query to be answered
     * @param bool $ok YesPass True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
     * @param string|null $shipping_options OptionalRequired if ok is True. A JSON-serialized array of available shipping options.
     * @param string|null $error_message OptionalRequired if ok is False. Error message in human readable form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the user.
     * @return Bot
     */
    public function answerShippingQuery(string $shipping_query_id, bool $ok, ?string $shipping_options = null, string|null $error_message = ''): Bot
    {
        return $this->call(['shipping_query_id' => $shipping_query_id, 'ok' => $ok, 'shipping_options' => $shipping_options, 'error_message' => $error_message,], __FUNCTION__);
    }
    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an <a href="#update">Update</a> with the field <em>pre_checkout_query</em>. Use this method to respond to such pre-checkout queries. On success, <em>True</em> is returned. <strong>Note:</strong> The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     * @param string $pre_checkout_query_id YesUnique identifier for the query to be answered
     * @param bool $ok YesSpecify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
     * @param string|null $error_message OptionalRequired if ok is False. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!"). Telegram will display this message to the user.
     * @return Bot
     */
    public function answerPreCheckoutQuery(string $pre_checkout_query_id, bool $ok, string|null $error_message = ''): Bot
    {
        return $this->call(['pre_checkout_query_id' => $pre_checkout_query_id, 'ok' => $ok, 'error_message' => $error_message,], __FUNCTION__);
    }
    /**
     * This object represents a portion of the price for goods or services.
     * @param string $label Portion label
     * @param int $amount Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @return Bot
     */
    public function LabeledPrice(string $label, int $amount): Bot
    {
        return $this->call(['label' => $label, 'amount' => $amount,], __FUNCTION__);
    }
    /**
     * This object represents one shipping option.
     * @param string $id Shipping option identifier
     * @param string $title Option title
     * @param string $prices List of price portions
     * @return Bot
     */
    public function ShippingOption(string $id, string $title, ?string $prices = null): Bot
    {
        return $this->call(['id' => $id, 'title' => $title, 'prices' => $prices,], __FUNCTION__);
    }
    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns <em>True</em> on success.</p><p>Use this if the data submitted by the user doesn&#39;t satisfy the standards your service requires for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in the error message to make sure the user knows how to correct the issues.
     * @param int $user_id YesUser identifier
     * @param string $errors YesA JSON-serialized array describing the errors
     * @return Bot
     */
    public function setPassportDataErrors(int $user_id, ?string $errors = null): Bot
    {
        return $this->call(['user_id' => $user_id, 'errors' => $errors,], __FUNCTION__);
    }
    /**
     * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the user. It should be one of:</p><ul><li><a href="#passportelementerrordatafield">PassportElementErrorDataField</a></li><li><a href="#passportelementerrorfrontside">PassportElementErrorFrontSide</a></li><li><a href="#passportelementerrorreverseside">PassportElementErrorReverseSide</a></li><li><a href="#passportelementerrorselfie">PassportElementErrorSelfie</a></li><li><a href="#passportelementerrorfile">PassportElementErrorFile</a></li><li><a href="#passportelementerrorfiles">PassportElementErrorFiles</a></li><li><a href="#passportelementerrortranslationfile">PassportElementErrorTranslationFile</a></li><li><a href="#passportelementerrortranslationfiles">PassportElementErrorTranslationFiles</a></li><li><a href="#passportelementerrorunspecified">PassportElementErrorUnspecified</a></li></ul><h4><a class="anchor" name="passportelementerrordatafield" href="#passportelementerrordatafield"><i class="anchor-icon"></i></a>PassportElementErrorDataField</h4><p>Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when the field&#39;s value changes.
     * @param string $source Error source, must be data
     * @param string $type The section of the user's Telegram Passport which has the error, one of “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport”, “address”
     * @param string $field_name Name of the data field which has the error
     * @param string $data_hash Base64-encoded data hash
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementError(string $source, string $type, string $field_name, string $data_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'field_name' => $field_name, 'data_hash' => $data_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with the front side of a document. The error is considered resolved when the file with the front side of the document changes.
     * @param string $source Error source, must be front_side
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”
     * @param string $file_hash Base64-encoded hash of the file with the front side of the document
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorFrontSide(string $source, string $type, string $file_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hash' => $file_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with the reverse side of a document. The error is considered resolved when the file with reverse side of the document changes.
     * @param string $source Error source, must be reverse_side
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “driver_license”, “identity_card”
     * @param string $file_hash Base64-encoded hash of the file with the reverse side of the document
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorReverseSide(string $source, string $type, string $file_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hash' => $file_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with the selfie with a document. The error is considered resolved when the file with the selfie changes.
     * @param string $source Error source, must be selfie
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”
     * @param string $file_hash Base64-encoded hash of the file with the selfie
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorSelfie(string $source, string $type, string $file_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hash' => $file_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with a document scan. The error is considered resolved when the file with the document scan changes.
     * @param string $source Error source, must be file
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @param string $file_hash Base64-encoded file hash
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorFile(string $source, string $type, string $file_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hash' => $file_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with a list of scans. The error is considered resolved when the list of files containing the scans changes.
     * @param string $source Error source, must be files
     * @param string $type The section of the user's Telegram Passport which has the issue, one of “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @param string $file_hashes List of base64-encoded file hashes
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorFiles(string $source, string $type, string $message, ?string $file_hashes = null): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hashes' => $file_hashes, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with one of the files that constitute the translation of a document. The error is considered resolved when the file changes.
     * @param string $source Error source, must be translation_file
     * @param string $type Type of element of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @param string $file_hash Base64-encoded file hash
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorTranslationFile(string $source, string $type, string $file_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hash' => $file_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue with the translated version of a document. The error is considered resolved when a file with the document translation change.
     * @param string $source Error source, must be translation_files
     * @param string $type Type of element of the user's Telegram Passport which has the issue, one of “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”, “bank_statement”, “rental_agreement”, “passport_registration”, “temporary_registration”
     * @param string $file_hashes List of base64-encoded file hashes
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorTranslationFiles(string $source, string $type, string $message, ?string $file_hashes = null): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'file_hashes' => $file_hashes, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
     * @param string $source Error source, must be unspecified
     * @param string $type Type of element of the user's Telegram Passport which has the issue
     * @param string $element_hash Base64-encoded element hash
     * @param string $message Error message
     * @return Bot
     */
    public function PassportElementErrorUnspecified(string $source, string $type, string $element_hash, string $message): Bot
    {
        return $this->call(['source' => $source, 'type' => $type, 'element_hash' => $element_hash, 'message' => $message,], __FUNCTION__);
    }
    /**
     * Use this method to send a game. On success, the sent <a href="#message">Message</a> is returned.
     * @param int $chat_id YesUnique identifier for the target chat
     * @param int|null $message_thread_id OptionalUnique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @param string $game_short_name YesShort name of the game, serves as the unique identifier for the game. Set up your games via @BotFather.
     * @param bool|null $disable_notification OptionalSends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protect_content OptionalProtects the contents of the sent message from forwarding and saving
     * @param int|null $reply_to_message_id OptionalIf the message is a reply, ID of the original message
     * @param bool|null $allow_sending_without_reply OptionalPass True if the message should be sent even if the specified replied-to message is not found
     * @param array|string|null $reply_markup OptionalA JSON-serialized object for an inline keyboard. If empty, one 'Play game_title' button will be shown. If not empty, the first button must launch the game.
     * @return Bot
     */
    public function sendGame(int $chat_id, string $game_short_name, int|null $message_thread_id = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
    {
        return $this->call(['chat_id' => $chat_id, 'message_thread_id' => $message_thread_id, 'game_short_name' => $game_short_name, 'disable_notification' => $disable_notification, 'protect_content' => $protect_content, 'reply_to_message_id' => $reply_to_message_id, 'allow_sending_without_reply' => $allow_sending_without_reply, 'reply_markup' => $reply_markup,], __FUNCTION__);
    }
    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. Returns an Array of <a href="#gamehighscore">GameHighScore</a> objects.</p><blockquote><p>This method will currently return scores for the target user, plus two of their closest neighbors on each side. Will also return the top three users if the user and their neighbors are not among them. Please note that this behavior is subject to change.</p></blockquote><table class="table"><thead><tr><th>Parameter</th><th>Type</th><th>Required</th><th>Description</th></tr></thead><tbody><tr><td>user_id</td><td>Integer</td><td>Yes</td><td>Target user id</td></tr><tr><td>chat_id</td><td>Integer</td><td>Optional</td><td>Required if <em>inline_message_id</em> is not specified. Unique identifier for the target chat</td></tr><tr><td>message_id</td><td>Integer</td><td>Optional</td><td>Required if <em>inline_message_id</em> is not specified. Identifier of the sent message</td></tr><tr><td>inline_message_id</td><td>String</td><td>Optional</td><td>Required if <em>chat_id</em> and <em>message_id</em> are not specified. Identifier of the inline message</td></tr></tbody></table><h4><a class="anchor" name="gamehighscore" href="#gamehighscore"><i class="anchor-icon"></i></a>GameHighScore</h4><p>This object represents one row of the high scores table for a game.
     * @param int $position Position in high score table for the game
     * @param string|array $user User
     * @param int $score Score
     * @return Bot
     */
    public function getGameHighScores(int $position, string|array $user, int $score): Bot
    {
        return $this->call(['position' => $position, 'user' => $user, 'score' => $score,], __FUNCTION__);
    }
    /**
     * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
     * @return Bot
     */
    public function getMe(): Bot
    {
        return $this->call([],__FUNCTION__);
    }
    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
     * @return Bot
     */
    public function logOut(): Bot
    {
        return $this->call([],__FUNCTION__);
    }
    /**
     * Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
     * @return Bot
     */
    public function close(): Bot
    {
        return $this->call([],__FUNCTION__);
    }
}
