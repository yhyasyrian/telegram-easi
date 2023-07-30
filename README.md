# telegram-easi
Telegram Easy It is a simple library that can you with its create telegram bots with PHP
it is easy recover any update from telegram with information without save name the key and send or edit any message
Index A sequential list of methods:
* [Install library](#install)
* [Events](#events)
    * [Example](#example-bot)
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
}
```
## Example Bot
You can use the code for any bot:
```php
<?php
require_once __DIR__.'vendor/autoload.php';
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
$Bot = new Bot(token:Token);
$Bot->startBot($Bot); // Start the bot
```