<?php
require __DIR__.'/../vendor/autoload.php';
class Events extends \Yhyasyrian\TelegramEasi\Method\GetUpdate {
    public function isNewMessage(\Yhyasyrian\TelegramEasi\Updates\Message $Update) {
        throw new Exception("Error Processing Request", 1);
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
        print_r($th);
    }
}
$class = new Events(token:'1913366661:AAHSCDpWsZWUOyfPq0iMuBq3fcGvBj2eXTI',request :file_get_contents::class);
$class->startBot($class);