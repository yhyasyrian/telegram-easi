<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberMember extends ChatMemberAdministrator
{
    /**
     * The member's status in the chat, always “member”
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
