<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class VideoChatParticipantsInvited
{
    /**
     * New members that were invited to the video chat
     *
     * @var array<User>
     */
    public ?array $users;
}
