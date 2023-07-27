<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberOwner
{
    /**
     * The member's status in the chat, always “creator”
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
     * True, if the user's presence in the chat is hidden
     *
     * @var bool
     */
    public ?bool $is_anonymous;
    /**
     * Optional. Custom title for this user
     *
     * @var string|null
     */
    public string|null $custom_title;
}
