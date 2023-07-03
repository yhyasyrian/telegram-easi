<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class InlineKeyboardButton
{
    /**
     * Label text on the button
     *
     * @var string
     */
    public string $text;
    /**
     * Optional. HTTP or tg:// URL to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
     *
     * @var string|null
     */
    public string|null $url;
    /**
     * Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     *
     * @var string|null
     */
    public string|null $callback_data;
    /**
     * Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot.
     *
     * @var WebAppInfo|null
     */
    public WebAppInfo|null $web_app;
    /**
     * Optional. An HTTPS URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget.
     *
     * @var LoginUrl|null
     */
    public LoginUrl|null $login_url;
    /**
     * Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. May be empty, in which case just the bot's username will be inserted.
     *
     * @var string|null
     */
    public string|null $switch_inline_query;
    /**
     * Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. May be empty, in which case only the bot's username will be inserted.This offers a quick way for the user to open your bot in inline mode in the same chat - good for selecting something from multiple options.
     *
     * @var string|null
     */
    public string|null $switch_inline_query_current_chat;
    /**
     * Optional. If set, pressing the button will prompt the user to select one of their chats of the specified type, open that chat and insert the bot's username and the specified inline query in the input field
     *
     * @var SwitchInlineQueryChosenChat|null
     */
    public SwitchInlineQueryChosenChat|null $switch_inline_query_chosen_chat;
    /**
     * Optional. Description of the game that will be launched when the user presses the button.NOTE: This type of button must always be the first button in the first row.
     *
     * @var CallbackGame|null
     */
    public CallbackGame|null $callback_game;
    /**
     * Optional. Specify True, to send a Pay button.NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
     *
     * @var bool|null
     */
    public bool|null $pay;
}
