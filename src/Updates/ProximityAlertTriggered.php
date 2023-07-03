<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ProximityAlertTriggered
{
    /**
     * User that triggered the alert
     *
     * @var User
     */
    public User $traveler;
    /**
     * User that set the alert
     *
     * @var User
     */
    public User $watcher;
    /**
     * The distance between the users
     *
     * @var int
     */
    public int $distance;
}
