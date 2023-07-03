<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class SwitchInlineQueryChosenChat
{
    /**
     * Optional. The default inline query to be inserted in the input field. If left empty, only the bot's username will be inserted
     *
     * @var string|null
     */
    public string|null $query;
    /**
     * Optional. True, if private chats with users can be chosen
     *
     * @var bool|null
     */
    public bool|null $allow_user_chats;
    /**
     * Optional. True, if private chats with bots can be chosen
     *
     * @var bool|null
     */
    public bool|null $allow_bot_chats;
    /**
     * Optional. True, if group and supergroup chats can be chosen
     *
     * @var bool|null
     */
    public bool|null $allow_group_chats;
    /**
     * Optional. True, if channel chats can be chosen
     *
     * @var bool|null
     */
    public bool|null $allow_channel_chats;
}
