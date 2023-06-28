<?php

namespace Yhyasyrian\TelegramEasi\Updates;

use Yhyasyrian\TelegramEasi\Helper\Arrays;

class Update {
    public int $update_id;
    function __construct(
        public ?Message $message = (new Message)
    ) {}
    public function setMessage(\stdClass|array $message) : self {
        $this->message = Arrays::addValues((new Message),$message);
        return $this;
    }
}