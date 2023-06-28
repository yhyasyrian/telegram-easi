<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Location {
    public float $longitude;
    public float $latitude;
    public ?float $horizontal_accuracy;
    public ?int $live_period;
    public ?int $heading;
    public ?int $proximity_alert_radius;


}