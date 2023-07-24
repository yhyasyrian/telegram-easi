<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberLeft extends ChatMemberRestricted
{
    /**
     * The member's status in the chat, always “left”
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
}
