<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class User
{
    /**
     * Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     *
     * @var int
     */
    public int $id;
    /**
     * True, if this user is a bot
     *
     * @var bool
     */
    public ?bool $is_bot;
    /**
     * User's or bot's first name
     *
     * @var string
     */
    public string $first_name;
    /**
     * Optional. User's or bot's last name
     *
     * @var string|null
     */
    public string|null $last_name;
    /**
     * Optional. User's or bot's username
     *
     * @var string|null
     */
    public string|null $username;
    /**
     * Optional. IETF language tag of the user's language
     *
     * @var string|null
     */
    public string|null $language_code;
    /**
     * Optional. True, if this user is a Telegram Premium user
     *
     * @var bool|null
     */
    public bool|null $is_premium;
    /**
     * Optional. True, if this user added the bot to the attachment menu
     *
     * @var bool|null
     */
    public bool|null $added_to_attachment_menu;
    /**
     * Optional. True, if the bot can be invited to groups. Returned only in getMe.
     *
     * @var bool|null
     */
    public bool|null $can_join_groups;
    /**
     * Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     *
     * @var bool|null
     */
    public bool|null $can_read_all_group_messages;
    /**
     * Optional. True, if the bot supports inline queries. Returned only in getMe.
     *
     * @var bool|null
     */
    public bool|null $supports_inline_queries;
}
