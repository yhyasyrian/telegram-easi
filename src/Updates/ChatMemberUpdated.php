<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberUpdated
{
    /**
     * Chat the user belongs to
     *
     * @var Chat
     */
    public Chat $chat;
    /**
     * Performer of the action, which resulted in the change
     *
     * @var User
     */
    public User $from;
    /**
     * Date the change was done in Unix time
     *
     * @var int
     */
    public int $date;
    /**
     * Previous information about the chat member
     *
     * @var ChatMember
     */
    public ChatMember $old_chat_member;
    /**
     * New information about the chat member
     *
     * @var ChatMember
     */
    public ChatMember $new_chat_member;
    /**
     * Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     *
     * @var ChatInviteLink|null
     */
    public ChatInviteLink|null $invite_link;
    /**
     * Optional. True, if the user joined the chat via a chat folder invite link
     *
     * @var bool|null
     */
    public bool|null $via_chat_folder_invite_link;
}
