<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Location
{
    /**
     * Longitude as defined by sender
     *
     * @var Float
     */
    public Float $longitude;
    /**
     * Latitude as defined by sender
     *
     * @var Float
     */
    public Float $latitude;
    /**
     * Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     *
     * @var float|null
     */
    public float|null $horizontal_accuracy;
    /**
     * Optional. Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
     *
     * @var int|null
     */
    public int|null $live_period;
    /**
     * Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
     *
     * @var int|null
     */
    public int|null $heading;
    /**
     * Optional. The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
     *
     * @var int|null
     */
    public int|null $proximity_alert_radius;
}
