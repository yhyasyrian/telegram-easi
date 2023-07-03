<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Game
{
    /**
     * Title of the game
     *
     * @var string
     */
    public string $title;
    /**
     * Description of the game
     *
     * @var string
     */
    public string $description;
    /**
     * Photo that will be displayed in the game message in chats.
     *
     * @var array<PhotoSize>
     */
    public ?array $photo;
    /**
     * Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     *
     * @var string|null
     */
    public string|null $text;
    /**
     * Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     *
     * @var array<MessageEntity>|null
     */
    public ?array $text_entities;
    /**
     * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
     *
     * @var Animation|null
     */
    public Animation|null $animation;
}
