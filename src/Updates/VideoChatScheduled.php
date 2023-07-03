<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class VideoChatScheduled
{
    /**
     * Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
     *
     * @var int
     */
    public int $start_date;
}
