<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberBanned extends ChatMemberLeft
{
    /**
     * The member's status in the chat, always “kicked”
     *
     * @var string
     */
    public string $status;
    /**
     * Information about the user
     *
     * @var User
     */
    public User $user;
    /**
     * Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
     *
     * @var int
     */
    public int $until_date;
}
