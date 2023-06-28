<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Message {
    public int $message_id;
    public ?int $message_thread_id;
    public ?User $from;
    public ?Chat $sender_chat;
    public int $date;
    public ?User $forward_from;
    public ?Chat $forward_from_chat;
    public ?int $forward_from_message_id;
    public ?string $forward_signature;
    public ?string $forward_sender_name;
    public ?int $forward_date;
    public ?bool $is_topic_message;
    public ?bool $is_automatic_forward;
    public ?Message $reply_to_message;
    public ?User $via_bot;
    public int $edit_date;
    public ?bool $has_protected_content;
    public ?string $sticker_set_name;
    public ?bool $can_set_sticker_set;
    public ?int $linked_chat_id;
    public ?ChatLocation $location;
    function __construct() {
        // User
        $this->from = new User;
        $this->forward_from = new User;
        $this->via_bot = new User;
        // Chat
        $this->sender_chat = new Chat;
        $this->forward_from_chat = new Chat;
        // ChatLocation
        $this->location = new ChatLocation;
    }
}