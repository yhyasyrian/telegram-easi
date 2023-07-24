<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class PollAnswer
{
    /**
     * Unique poll identifier
     *
     * @var string
     */
    public string $poll_id;
    /**
     * The user, who changed the answer to the poll
     *
     * @var User
     */
    public User $user;
    /**
     * 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     *
     * @var array<Integer>
     */
    public ?array $option_ids;
}
