<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class MessageAutoDeleteTimerChanged
{
    /**
     * New auto-delete time for messages in the chat; in seconds
     *
     * @var int
     */
    public int $message_auto_delete_time;
}
