<?php


use Yhyasyrian\TelegramEasi\Updates\Update;

// Start Require Files 

foreach (scandir(__DIR__ . '/../src/Update/') as $key => $value) {
    if (is_file(__DIR__ . '/../src/Update/' . $value)) {
        require_once __DIR__ . '/../src/Update/' . $value;
    }
}
foreach (scandir(__DIR__ . '/../src/Helper') as $key => $value) {
    if (is_file(__DIR__ . '/../src/Helper/' . $value)) {
        require_once __DIR__ . '/../src/Helper/' . $value;
    }
}

// End Require Files
$message = '{
        "message_id": 23,
        "from": {
            "id": 6033624712,
            "is_bot": false,
            "first_name": "name",
            "last_name": "last_name",
            "language_code": "ar"
        },
        "chat": {
            "id": 26,
            "first_name": "name",
            "last_name": "last_name",
            "type": "private"
        },
        "date": 1687951997,
        "text": "test"
    }';

try {
    print_r(
        (new Update())->setMessage(json_decode($message, 1))
    );
} catch (\Throwable $th) {
    print_r($th);
}
