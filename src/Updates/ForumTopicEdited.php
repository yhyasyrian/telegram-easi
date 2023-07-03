<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ForumTopicEdited
{
    /**
     * Optional. New name of the topic, if it was edited
     *
     * @var string|null
     */
    public string|null $name;
    /**
     * Optional. New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the icon was removed
     *
     * @var string|null
     */
    public string|null $icon_custom_emoji_id;
}
