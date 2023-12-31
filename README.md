# telegram-easi
Telegram Easy It is a simple library that can you with its create telegram bots with PHP
it is easy recover any update from telegram with information without save name the key and send or edit any message
Index A sequential list of methods:
* [Install library](#install)
* [Events](#events)
    * [Example](#example-bot)
* [Metohd](#methods)
# Install
You can install library with `composer` You can install a library using Composer which is the best way to download SyDb by adding the following line to `composer.json` file:
```json
{
    "require": {
        "yhyasyrian/telegram-easi": "^1.0"
    }
}
```
Or run:
```bash 
composer require yhyasyrian/telegram-easi
```
# Events
The Events in update telegram is multiple for that you can getting with class `GetUpdate` and use `$GetUpdate->startBot(object|callable|string $callable)` and the `$callable` you can use:
```php
function (\Yhyasyrian\TelegramEasi\Updates\Update $Update, \Yhyasyrian\TelegramEasi\Method\GetUpdate $Api) {
    // Any Code
}
```
Or can use:
```php
class Events extends \Yhyasyrian\TelegramEasi\Method\GetUpdate {
    public function isNewMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        // $Update = $Update->message
    }
    public function isEditMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        // $Update = $Update->edited_message
    }
    public function isNewChannelMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        // $Update = $Update->channel_post
    }
    public function isEditChannelMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        // $Update = $Update->edited_channel_post
    }
    public function isCallBack (\Yhyasyrian\TelegramEasi\Updates\CallbackQuery $Update) {
        // $Update = $Update->callback_query;
    }
    public function isAny (\Yhyasyrian\TelegramEasi\Updates\Update $Update) {
        // $Update = $Update
    }
    public function getError(\Throwable $th) {
        print_r($th); // print error
    }
}
```
## Example Bot
You can use the code for any bot:
```php
<?php
require_once __DIR__.'/vendor/autoload.php';
const Token = ''; // Token your bot
class Bot extends \Yhyasyrian\TelegramEasi\Method\GetUpdate {
    public function isNewMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        if ($Update->text == '/start') {
            $this->sendMessage(chat_id:$Update->chat->id,text:"Welecome to telegram-easi"); // Metohd telegram for send message
        }
    }
    public function isEditMessage (\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        $this->isNewMessage($Update);
    }
}
$Bot = new Bot(request:file_get_contents::class,token:Token);
$Bot->startBot($Bot); // Start the bot
```
# Methods
I used all methods that Telegram was supported [here](https://core.telegram.org/bots/api)
```php
call(array $data = [], string $metohd): Bot // For request API telegram
getUpdates(int|null $offset = 0, int|null $limit = 0, int|null $timeout = 0, ?string $allowed_updates = null): Bot
setWebhook(string $url, string|null $certificate = '', string|null $ip_address = '', int|null $max_connections = 0, ?string $allowed_updates = null, bool|null $drop_pending_updates = false, string|null $secret_token = ''): Bot
deleteWebhook(bool|null $drop_pending_updates = false): Bot
getWebhookInfo(): Bot
MessageId(int $message_id): Bot
PollOption(string $text, int $voter_count): Bot
UserProfilePhotos(int $total_count, ?string $photos = null): Bot
ReplyKeyboardMarkup(?string $keyboard = null, bool|null $is_persistent = false, bool|null $resize_keyboard = false, bool|null $one_time_keyboard = false, string|null $input_field_placeholder = '', bool|null $selective = false): Bot
KeyboardButton(string $text, array|string|null $request_user, array|string|null $request_chat, array|string|null $request_poll, string|null $web_app, bool|null $request_contact = false, bool|null $request_location = false): Bot
ChatAdministratorRights(?bool $is_anonymous, ?bool $can_manage_chat, ?bool $can_delete_messages, ?bool $can_manage_video_chats, ?bool $can_restrict_members, ?bool $can_promote_members, ?bool $can_change_info, ?bool $can_invite_users, bool|null $can_post_messages = false, bool|null $can_edit_messages = false, bool|null $can_pin_messages = false, bool|null $can_manage_topics = false): Bot
ForumTopic(int $message_thread_id, string $name, int $icon_color, string|null $icon_custom_emoji_id = ''): Bot 
BotCommand(string $command, string $description): Bot
BotCommandScope(string $type): Bot
BotCommandScopeAllPrivateChats(string $type): Bot
BotCommandScopeAllGroupChats(string $type): Bot
BotCommandScopeAllChatAdministrators(string $type): Bot
BotCommandScopeChat(string $type, int|string $chat_id): Bot
BotCommandScopeChatAdministrators(string $type, int|string $chat_id): Bot
BotCommandScopeChatMember(string $type, int|string $chat_id, int $user_id): Bot
BotName(string $name): Bot
BotDescription(string $description): Bot
BotShortDescription(string $short_description): Bot
MenuButtonWebApp(string $type, string $text, string $web_app): Bot
MenuButtonDefault(string $type): Bot
ResponseParameters(int|null $migrate_to_chat_id = 0, int|null $retry_after = 0): Bot
InputMediaVideo(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $width = 0, int|null $height = 0, int|null $duration = 0, bool|null $supports_streaming = false, bool|null $has_spoiler = false): Bot
InputMediaAnimation(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $width = 0, int|null $height = 0, int|null $duration = 0, bool|null $has_spoiler = false): Bot
InputMediaAudio(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, string|null $performer = '', string|null $title = ''): Bot
InputMediaDocument(string $type, string $media, string|null $thumbnail, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_content_type_detection = false): Bot
sendMessage(int|string $chat_id, string $text, int|null $message_thread_id = 0, string|null $parse_mode = '', ?string $entities = null, bool|null $disable_web_page_preview = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
copyMessage(int|string $chat_id, int|string $from_chat_id, int $message_id, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendPhoto(int|string $chat_id, string $photo, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendAudio(int|string $chat_id, string $audio, string|null $thumbnail, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, string|null $performer = '', string|null $title = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendDocument(int|string $chat_id, string $document, string|null $thumbnail, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $disable_content_type_detection = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendVideo(int|string $chat_id, string $video, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $width = 0, int|null $height = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $supports_streaming = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendAnimation(int|string $chat_id, string $animation, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $width = 0, int|null $height = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, bool|null $has_spoiler = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendVoice(int|string $chat_id, string $voice, int|null $message_thread_id = 0, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $duration = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendVideoNote(int|string $chat_id, string $video_note, string|null $thumbnail, int|null $message_thread_id = 0, int|null $duration = 0, int|null $length = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendMediaGroup(int|string $chat_id, int|null $message_thread_id = 0, ?string $media = null, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false): Bot
sendLocation(int|string $chat_id, float $latitude, float $longitude, float|null $horizontal_accuracy, int|null $message_thread_id = 0, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendVenue(int|string $chat_id, float $latitude, float $longitude, string $title, string $address, int|null $message_thread_id = 0, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendContact(int|string $chat_id, string $phone_number, string $first_name, int|null $message_thread_id = 0, string|null $last_name = '', string|null $vcard = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendPoll(int|string $chat_id, string $question, int|null $message_thread_id = 0, ?string $options = null, bool|null $is_anonymous = false, string|null $type = '', bool|null $allows_multiple_answers = false, int|null $correct_option_id = 0, string|null $explanation = '', string|null $explanation_parse_mode = '', ?string $explanation_entities = null, int|null $open_period = 0, int|null $close_date = 0, bool|null $is_closed = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendDice(int|string $chat_id, int|null $message_thread_id = 0, string|null $emoji = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
sendChatAction(int|string $chat_id, string $action, int|null $message_thread_id = 0): Bot
getUserProfilePhotos(int $user_id, int|null $offset = 0, int|null $limit = 0): Bot
getFile(string $file_id): Bot
banChatMember(int|string $chat_id, int $user_id, int|null $until_date = 0, bool|null $revoke_messages = false): Bot
unbanChatMember(int|string $chat_id, int $user_id, bool|null $only_if_banned = false): Bot
restrictChatMember(int|string $chat_id, int $user_id, string|array $permissions, bool|null $use_independent_chat_permissions = false, int|null $until_date = 0): Bot
promoteChatMember(int|string $chat_id, int $user_id, bool|null $is_anonymous = false, bool|null $can_manage_chat = false, bool|null $can_post_messages = false, bool|null $can_edit_messages = false, bool|null $can_delete_messages = false, bool|null $can_manage_video_chats = false, bool|null $can_restrict_members = false, bool|null $can_promote_members = false, bool|null $can_change_info = false, bool|null $can_invite_users = false, bool|null $can_pin_messages = false, bool|null $can_manage_topics = false): Bot
setChatAdministratorCustomTitle(int|string $chat_id, int $user_id, string $custom_title): Bot
banChatSenderChat(int|string $chat_id, int $sender_chat_id): Bot
unbanChatSenderChat(int|string $chat_id, int $sender_chat_id): Bot
setChatPermissions(int|string $chat_id, string|array $permissions, bool|null $use_independent_chat_permissions = false): Bot
exportChatInviteLink(int|string $chat_id): Bot
createChatInviteLink(int|string $chat_id, string|null $name = '', int|null $expire_date = 0, int|null $member_limit = 0, bool|null $creates_join_request = false): Bot
editChatInviteLink(int|string $chat_id, string $invite_link, string|null $name = '', int|null $expire_date = 0, int|null $member_limit = 0, bool|null $creates_join_request = false): Bot
revokeChatInviteLink(int|string $chat_id, string $invite_link): Bot
approveChatJoinRequest(int|string $chat_id, int $user_id): Bot
declineChatJoinRequest(int|string $chat_id, int $user_id): Bot
setChatPhoto(int|string $chat_id, string $photo): Bot
deleteChatPhoto(int|string $chat_id): Bot
setChatTitle(int|string $chat_id, string $title): Bot
setChatDescription(int|string $chat_id, string|null $description = ''): Bot
pinChatMessage(int|string $chat_id, int $message_id, bool|null $disable_notification = false): Bot
unpinChatMessage(int|string $chat_id, int|null $message_id = 0): Bot
unpinAllChatMessages(int|string $chat_id): Bot
leaveChat(int|string $chat_id): Bot
getChat(int|string $chat_id): Bot
getChatAdministrators(int|string $chat_id): Bot
getChatMemberCount(int|string $chat_id): Bot
getChatMember(int|string $chat_id, int $user_id): Bot
setChatStickerSet(int|string $chat_id, string $sticker_set_name): Bot
deleteChatStickerSet(int|string $chat_id): Bot
getForumTopicIconStickers(int|string $chat_id, string $name, int|null $icon_color = 0, string|null $icon_custom_emoji_id = ''): Bot
editForumTopic(int|string $chat_id, int $message_thread_id, string|null $name = '', string|null $icon_custom_emoji_id = ''): Bot
closeForumTopic(int|string $chat_id, int $message_thread_id): Bot
reopenForumTopic(int|string $chat_id, int $message_thread_id): Bot
deleteForumTopic(int|string $chat_id, int $message_thread_id): Bot
unpinAllForumTopicMessages(int|string $chat_id, int $message_thread_id): Bot
editGeneralForumTopic(int|string $chat_id, string $name): Bot
closeGeneralForumTopic(int|string $chat_id): Bot
reopenGeneralForumTopic(int|string $chat_id): Bot
hideGeneralForumTopic(int|string $chat_id): Bot
unhideGeneralForumTopic(int|string $chat_id): Bot
answerCallbackQuery(string|array|null $scope, ?string $commands = null, string|null $language_code = ''): Bot  
deleteMyCommands(string|array|null $scope, string|null $language_code = ''): Bot
getMyCommands(string|array|null $scope, string|null $language_code = ''): Bot
setMyName(string|null $name = '', string|null $language_code = ''): Bot
getMyName(string|null $language_code = ''): Bot
setMyDescription(string|null $description = '', string|null $language_code = ''): Bot
getMyDescription(string|null $language_code = ''): Bot
setMyShortDescription(string|null $short_description = '', string|null $language_code = ''): Bot
getMyShortDescription(string|null $language_code = ''): Bot
setChatMenuButton(string|array|null $menu_button, int|null $chat_id = 0): Bot
getChatMenuButton(int|null $chat_id = 0): Bot
setMyDefaultAdministratorRights(string|array|null $rights, bool|null $for_channels = false): Bot
getMyDefaultAdministratorRights(bool|null $for_channels = false): Bot
editMessageCaption(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, array|string|null $reply_markup = ''): Bot
editMessageMedia(int|string|null $chat_id, string|array $media, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
editMessageLiveLocation(int|string|null $chat_id, float $latitude, float $longitude, float|null $horizontal_accuracy, int|null $message_id = 0, string|null $inline_message_id = '', int|null $heading = 0, int|null $proximity_alert_radius = 0, array|string|null $reply_markup = ''): Bot
stopMessageLiveLocation(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
editMessageReplyMarkup(int|string|null $chat_id, int|null $message_id = 0, string|null $inline_message_id = '', array|string|null $reply_markup = ''): Bot
stopPoll(int|string $chat_id, int $message_id, array|string|null $reply_markup = ''): Bot
deleteMessage(int|string $chat_id, int $message_id): Bot
StickerSet(string $name, string $title, string $sticker_type, ?bool $is_animated, ?bool $is_video, string|array|null $thumbnail, ?string $stickers = null): Bot
sendSticker(int|string $chat_id, string $sticker, int|null $message_thread_id = 0, string|null $emoji = '', bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
getStickerSet(string $name): Bot
getCustomEmojiStickers(?string $custom_emoji_ids = null): Bot
uploadStickerFile(int $user_id, string $sticker, string $sticker_format): Bot
createNewStickerSet(int $user_id, string $name, string $title, string $sticker_format, ?string $stickers = null, string|null $sticker_type = '', bool|null $needs_repainting = false): Bot
addStickerToSet(int $user_id, string $name, string|array $sticker): Bot
setStickerPositionInSet(string $sticker, int $position): Bot
deleteStickerFromSet(string $sticker): Bot
setStickerEmojiList(string $sticker, ?string $emoji_list = null): Bot
setStickerKeywords(string $sticker, ?string $keywords = null): Bot
setStickerMaskPosition(string $sticker, string|array|null $mask_position): Bot
setStickerSetTitle(string $name, string $title): Bot
setStickerSetThumbnail(string $name, int $user_id, string|null $thumbnail): Bot
setCustomEmojiStickerSetThumbnail(string $name, string|null $custom_emoji_id = ''): Bot
deleteStickerSet(string $name): Bot
answerInlineQuery(string $inline_query_id, string|array|null $button, ?string $results = null, int|null $cache_time = 0, bool|null $is_personal = false, string|null $next_offset = ''): Bot
InlineQueryResultsButton(string $text, string|null $web_app, string|null $start_parameter = ''): Bot
InlineQueryResult(string $type, string $id, string $title, string|array $input_message_content, array|string|null $reply_markup, string|null $url = '', bool|null $hide_url = false, string|null $description = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
InlineQueryResultPhoto(string $type, string $id, string $photo_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $photo_width = 0, int|null $photo_height = 0, string|null $title = '', string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultGif(string $type, string $id, string $gif_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $gif_width = 0, int|null $gif_height = 0, int|null $gif_duration = 0, string|null $thumbnail_mime_type = '', string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultMpeg4Gif(string $type, string $id, string $mpeg4_url, string $thumbnail_url, array|string|null $reply_markup, string|array|null $input_message_content, int|null $mpeg4_width = 0, int|null $mpeg4_height = 0, int|null $mpeg4_duration = 0, string|null $thumbnail_mime_type = '', string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultVideo(string $type, string $id, string $audio_url, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, string|null $performer = '', int|null $audio_duration = 0): Bot
InlineQueryResultVoice(string $type, string $id, string $voice_url, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, int|null $voice_duration = 0): Bot
InlineQueryResultDocument(string $type, string $id, string $title, string $document_url, string $mime_type, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null, string|null $description = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
InlineQueryResultLocation(string $type, string $id, float $latitude, float $longitude, string $title, float|null $horizontal_accuracy, array|string|null $reply_markup, string|array|null $input_message_content, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0, string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
InlineQueryResultVenue(string $type, string $id, Float $latitude, Float $longitude, string $title, string $address, array|string|null $reply_markup, string|array|null $input_message_content, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
InlineQueryResultContact(string $type, string $id, string $phone_number, string $first_name, array|string|null $reply_markup, string|array|null $input_message_content, string|null $last_name = '', string|null $vcard = '', string|null $thumbnail_url = '', int|null $thumbnail_width = 0, int|null $thumbnail_height = 0): Bot
InlineQueryResultGame(string $type, string $id, string $game_short_name, array|string|null $reply_markup = ''): Bot
InlineQueryResultCachedPhoto(string $type, string $id, string $photo_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedGif(string $type, string $id, string $gif_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedMpeg4Gif(string $type, string $id, string $mpeg4_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $title = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedSticker(string $type, string $id, string $sticker_file_id, array|string|null $reply_markup, string|array|null $input_message_content): Bot
InlineQueryResultCachedDocument(string $type, string $id, string $title, string $document_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedVideo(string $type, string $id, string $video_file_id, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $description = '', string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedVoice(string $type, string $id, string $voice_file_id, string $title, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InlineQueryResultCachedAudio(string $type, string $id, string $audio_file_id, array|string|null $reply_markup, string|array|null $input_message_content, string|null $caption = '', string|null $parse_mode = '', ?string $caption_entities = null): Bot
InputMessageContent(string $message_text, string|null $parse_mode = '', ?string $entities = null, bool|null $disable_web_page_preview = false): Bot
InputLocationMessageContent(Float $latitude, Float $longitude, float|null $horizontal_accuracy, int|null $live_period = 0, int|null $heading = 0, int|null $proximity_alert_radius = 0): Bot
InputVenueMessageContent(Float $latitude, Float $longitude, string $title, string $address, string|null $foursquare_id = '', string|null $foursquare_type = '', string|null $google_place_id = '', string|null $google_place_type = ''): Bot
InputContactMessageContent(string $phone_number, string $first_name, string|null $last_name = '', string|null $vcard = ''): Bot
InputInvoiceMessageContent(string $title, string $description, string $payload, string $provider_token, string $currency, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false): Bot
answerWebAppQuery(string $web_app_query_id, string|array $result): Bot
SentWebAppMessage(string|null $inline_message_id = ''): Bot
sendInvoice(int|string $chat_id, string $title, string $description, string $payload, string $provider_token, string $currency, int|null $message_thread_id = 0, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $start_parameter = '', string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
createInvoiceLink(string $title, string $description, string $payload, string $provider_token, string $currency, ?string $prices = null, int|null $max_tip_amount = 0, ?string $suggested_tip_amounts = null, string|null $provider_data = '', string|null $photo_url = '', int|null $photo_size = 0, int|null $photo_width = 0, int|null $photo_height = 0, bool|null $need_name = false, bool|null $need_phone_number = false, bool|null $need_email = false, bool|null $need_shipping_address = false, bool|null $send_phone_number_to_provider = false, bool|null $send_email_to_provider = false, bool|null $is_flexible = false): Bot
answerShippingQuery(string $shipping_query_id, ?bool $ok, ?string $shipping_options = null, string|null $error_message = ''): Bot
answerPreCheckoutQuery(string $pre_checkout_query_id, ?bool $ok, string|null $error_message = ''): Bot
LabeledPrice(string $label, int $amount): Bot
ShippingOption(string $id, string $title, ?string $prices = null): Bot
setPassportDataErrors(int $user_id, ?string $errors = null): Bot
PassportElementError(string $source, string $type, string $field_name, string $data_hash, string $message): Bot
PassportElementErrorFrontSide(string $source, string $type, string $file_hash, string $message): Bot
PassportElementErrorReverseSide(string $source, string $type, string $file_hash, string $message): Bot
PassportElementErrorSelfie(string $source, string $type, string $file_hash, string $message): Bot
PassportElementErrorFile(string $source, string $type, string $file_hash, string $message): Bot
PassportElementErrorFiles(string $source, string $type, string $message, ?string $file_hashes = null): Bot     
PassportElementErrorTranslationFile(string $source, string $type, string $file_hash, string $message): Bot     
PassportElementErrorTranslationFiles(string $source, string $type, string $message, ?string $file_hashes = null): Bot
PassportElementErrorUnspecified(string $source, string $type, string $element_hash, string $message): Bot      
sendGame(int $chat_id, string $game_short_name, int|null $message_thread_id = 0, bool|null $disable_notification = false, bool|null $protect_content = false, int|null $reply_to_message_id = 0, bool|null $allow_sending_without_reply = false, array|string|null $reply_markup = ''): Bot
getGameHighScores(int $position, string|array $user, int $score): Bot
getMe(): Bot
logOut(): Bot
close(): Bot
```