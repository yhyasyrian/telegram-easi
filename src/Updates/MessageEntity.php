<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class MessageEntity
{
    /**
     * Type of the entity. Currently, can be “mention” (@username), “hashtag” (#hashtag), “cashtag” ($USD), “bot_command” (/start@jobs_bot), “url” (https://telegram.org), “email” (do-not-reply@telegram.org), “phone_number” (+1-212-555-0123), “bold” (bold text), “italic” (italic text), “underline” (underlined text), “strikethrough” (strikethrough text), “spoiler” (spoiler message), “code” (monowidth string), “pre” (monowidth block), “text_link” (for clickable text URLs), “text_mention” (for users without usernames), “custom_emoji” (for inline custom emoji stickers)
     *
     * @var string
     */
    public string $type;
    /**
     * Offset in UTF-16 code units to the start of the entity
     *
     * @var int
     */
    public int $offset;
    /**
     * Length of the entity in UTF-16 code units
     *
     * @var int
     */
    public int $length;
    /**
     * Optional. For “text_link” only, URL that will be opened after user taps on the text
     *
     * @var string|null
     */
    public string|null $url;
    /**
     * Optional. For “text_mention” only, the mentioned user
     *
     * @var User|null
     */
    public User|null $user;
    /**
     * Optional. For “pre” only, the programming language of the entity text
     *
     * @var string|null
     */
    public string|null $language;
    /**
     * Optional. For “custom_emoji” only, unique identifier of the custom emoji. Use getCustomEmojiStickers to get full information about the sticker
     *
     * @var string|null
     */
    public string|null $custom_emoji_id;
}
