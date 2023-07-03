<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ForumTopicCreated
{
    /**
     * Name of the topic
     *
     * @var string
     */
    public string $name;
    /**
     * Color of the topic icon in RGB format
     *
     * @var int
     */
    public int $icon_color;
    /**
     * Optional. Unique identifier of the custom emoji shown as the topic icon
     *
     * @var string|null
     */
    public string|null $icon_custom_emoji_id;
}
