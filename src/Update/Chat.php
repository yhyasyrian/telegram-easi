<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Chat {
    public int $id;
    public string $type;
    public ?string $title;
    public ?string $username;
    public ?string $first_name;
    public ?string $last_name;
    public ?bool $is_forum;
    public ?ChatPhoto $photo;
    public string|array|null $active_usernames;
    public ?string $emoji_status_custom_emoji_id;
    public ?string $bio;
    public ?bool $has_private_forwards;
    public ?bool $has_restricted_voice_and_video_messages;
    public ?bool $join_to_send_messages;
    public ?bool $join_by_request;
    public ?string $description;
    public ?string $invite_link;
    public Message $pinned_message;
    public ChatPermissions $permissions;
    public int $slow_mode_delay;
    public int $message_auto_delete_time;
    public ?bool $has_aggressive_anti_spam_enabled;
    public ?bool $has_hidden_members;
    public ?bool $has_protected_content;
    public ?string $sticker_set_name;
    public ?bool $can_set_sticker_set;
    public int $linked_chat_id;
    public ChatLocation $location;
}