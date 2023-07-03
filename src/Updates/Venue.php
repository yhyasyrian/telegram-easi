<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Venue
{
    /**
     * Venue location. Can't be a live location
     *
     * @var Location
     */
    public Location $location;
    /**
     * Name of the venue
     *
     * @var string
     */
    public string $title;
    /**
     * Address of the venue
     *
     * @var string
     */
    public string $address;
    /**
     * Optional. Foursquare identifier of the venue
     *
     * @var string|null
     */
    public string|null $foursquare_id;
    /**
     * Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
     *
     * @var string|null
     */
    public string|null $foursquare_type;
    /**
     * Optional. Google Places identifier of the venue
     *
     * @var string|null
     */
    public string|null $google_place_id;
    /**
     * Optional. Google Places type of the venue. (See supported types.)
     *
     * @var string|null
     */
    public string|null $google_place_type;
}
