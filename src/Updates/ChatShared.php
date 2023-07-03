<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatShared
{
    /**
     * Identifier of the request
     *
     * @var int
     */
    public int $request_id;
    /**
     * Identifier of the shared user. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier. The bot may not have access to the user and could be unable to use this identifier, unless the user is already known to the bot by some other means.
     *
     * @var int
     */
    public int $user_id;
}
