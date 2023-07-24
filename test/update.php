<?php
use Yhyasyrian\TelegramEasi\Helpers\ConfigObject;
use Yhyasyrian\TelegramEasi\Updates\Update;
use Yhyasyrian\TelegramEasi\Updates\User;

// use \Yhyasyrian\TelegramEasi\Updates\Message;
require_once __DIR__.'/../src/Updates/Update.php';
require_once __DIR__.'/../src/Helpers/ConfigObject.php';
$update  = json_decode('{
    "update_id": 926023860,
    "message": {
        "message_id": 28789,
        "from": {
            "id": 809064751,
            "is_bot": false,
            "first_name": "ᯓ ˹𝚈𝙷𝚈𝙰",
            "last_name": "𝚂𝚈𝚁𝙸𝙰𝙽˼ ༆",
            "username": "KKYKKN",
            "language_code": "ar",
            "is_premium": true
        },
        "chat": {
            "id": 809064751,
            "first_name": "ᯓ ˹𝚈𝙷𝚈𝙰",
            "last_name": "𝚂𝚈𝚁𝙸𝙰𝙽˼ ༆",
            "username": "KKYKKN",
            "type": "private"
        },
        "date": 1689537815,
        "text": "update"
    }
}',1);
try {
    $ConfigObject = new ConfigObject(Update::class,$update);
    /**
     * @var Update
     */
    $update = $ConfigObject->getResult();
} catch (\Throwable $th) {
   print_r($th);
}