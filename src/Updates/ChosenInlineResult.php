<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChosenInlineResult
{
    /**
     * The unique identifier for the result that was chosen
     *
     * @var string
     */
    public string $result_id;
    /**
     * The user that chose the result
     *
     * @var User
     */
    public User $from;
    /**
     * Optional. Sender location, only for bots that require user location
     *
     * @var Location|null
     */
    public Location|null $location;
    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     *
     * @var string|null
     */
    public string|null $inline_message_id;
    /**
     * The query that was used to obtain the result
     *
     * @var string
     */
    public string $query;
}
