<?php

namespace Yhyasyrian\TelegramEasi\Updates;

use Yhyasyrian\TelegramEasi\Helper\Arrays;

class Update
{
    /**
     * The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     *
     * @var int
     */
    public int $update_id;
    /**
     * Optional. New incoming message of any kind - text, photo, sticker, etc.
     *
     * @var Message|null
     */
    public Message|null $message;
    /**
     * Optional. New version of a message that is known to the bot and was edited
     *
     * @var Message|null
     */
    public Message|null $edited_message;
    /**
     * Optional. New incoming channel post of any kind - text, photo, sticker, etc.
     *
     * @var Message|null
     */
    public Message|null $channel_post;
    /**
     * Optional. New version of a channel post that is known to the bot and was edited
     *
     * @var Message|null
     */
    public Message|null $edited_channel_post;
    /**
     * Optional. New incoming inline query
     *
     * @var InlineQuery|null
     */
    public InlineQuery|null $inline_query;
    /**
     * Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     *
     * @var ChosenInlineResult|null
     */
    public ChosenInlineResult|null $chosen_inline_result;
    /**
     * Optional. New incoming callback query
     *
     * @var CallbackQuery|null
     */
    public CallbackQuery|null $callback_query;
    /**
     * Optional. New incoming shipping query. Only for invoices with flexible price
     *
     * @var ShippingQuery|null
     */
    public ShippingQuery|null $shipping_query;
    /**
     * Optional. New incoming pre-checkout query. Contains full information about checkout
     *
     * @var PreCheckoutQuery|null
     */
    public PreCheckoutQuery|null $pre_checkout_query;
    /**
     * Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     *
     * @var Poll|null
     */
    public Poll|null $poll;
    /**
     * Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     *
     * @var PollAnswer|null
     */
    public PollAnswer|null $poll_answer;
    /**
     * Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
     *
     * @var ChatMemberUpdated|null
     */
    public ChatMemberUpdated|null $my_chat_member;
    /**
     * Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
     *
     * @var ChatMemberUpdated|null
     */
    public ChatMemberUpdated|null $chat_member;
    /**
     * Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
     *
     * @var ChatJoinRequest|null
     */
    public ChatJoinRequest|null $chat_join_request;
}
