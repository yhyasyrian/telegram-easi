<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatLocation
{
    /**
     * The location to which the supergroup is connected. Can't be a live location.
     *
     * @var Location
     */
    public Location $location;
    /**
     * Location address; 1-64 characters, as defined by the chat owner
     *
     * @var string
     */
    public string $address;
}
