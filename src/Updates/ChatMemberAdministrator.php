<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatMemberAdministrator extends ChatMemberOwner
{
    /**
     * The member's status in the chat, always “administrator”
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
     * True, if the bot is allowed to edit administrator privileges of that user
     *
     * @var bool
     */
    public ?bool $can_be_edited;
    /**
     * True, if the user's presence in the chat is hidden
     *
     * @var bool
     */
    public ?bool $is_anonymous;
    /**
     * True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     *
     * @var bool
     */
    public ?bool $can_manage_chat;
    /**
     * True, if the administrator can delete messages of other users
     *
     * @var bool
     */
    public ?bool $can_delete_messages;
    /**
     * True, if the administrator can manage video chats
     *
     * @var bool
     */
    public ?bool $can_manage_video_chats;
    /**
     * True, if the administrator can restrict, ban or unban chat members
     *
     * @var bool
     */
    public ?bool $can_restrict_members;
    /**
     * True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     *
     * @var bool
     */
    public ?bool $can_promote_members;
    /**
     * True, if the user is allowed to change the chat title, photo and other settings
     *
     * @var bool
     */
    public ?bool $can_change_info;
    /**
     * True, if the user is allowed to invite new users to the chat
     *
     * @var bool
     */
    public ?bool $can_invite_users;
    /**
     * Optional. True, if the administrator can post in the channel; channels only
     *
     * @var bool|null
     */
    public bool|null $can_post_messages;
    /**
     * Optional. True, if the administrator can edit messages of other users and can pin messages; channels only
     *
     * @var bool|null
     */
    public bool|null $can_edit_messages;
    /**
     * Optional. True, if the user is allowed to pin messages; groups and supergroups only
     *
     * @var bool|null
     */
    public bool|null $can_pin_messages;
    /**
     * Optional. True, if the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     *
     * @var bool|null
     */
    public bool|null $can_manage_topics;
    /**
     * Optional. Custom title for this user
     *
     * @var string|null
     */
    public string|null $custom_title;
}
