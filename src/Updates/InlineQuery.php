<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class InlineQuery
{
    /**
     * Unique identifier for this query
     *
     * @var string
     */
    public string $id;
    /**
     * Sender
     *
     * @var User
     */
    public User $from;
    /**
     * Text of the query (up to 256 characters)
     *
     * @var string
     */
    public string $query;
    /**
     * Offset of the results to be returned, can be controlled by the bot
     *
     * @var string
     */
    public string $offset;
    /**
     * Optional. Type of the chat from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat
     *
     * @var string|null
     */
    public string|null $chat_type;
    /**
     * Optional. Sender location, only for bots that request user location
     *
     * @var Location|null
     */
    public Location|null $location;
}
