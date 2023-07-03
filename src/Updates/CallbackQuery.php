<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class CallbackQuery
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
     * Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
     *
     * @var Message|null
     */
    public Message|null $message;
    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
     *
     * @var string|null
     */
    public string|null $inline_message_id;
    /**
     * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
     *
     * @var string
     */
    public string $chat_instance;
    /**
     * Optional. Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
     *
     * @var string|null
     */
    public string|null $data;
    /**
     * Optional. Short name of a Game to be returned, serves as the unique identifier for the game
     *
     * @var string|null
     */
    public string|null $game_short_name;
}
