<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class WebAppData
{
    /**
     * The data. Be aware that a bad client can send arbitrary data in this field.
     *
     * @var string
     */
    public string $data;
    /**
     * Text of the web_app keyboard button from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
     *
     * @var string
     */
    public string $button_text;
}
