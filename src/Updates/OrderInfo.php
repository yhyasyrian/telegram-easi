<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class OrderInfo
{
    /**
     * Optional. User name
     *
     * @var string|null
     */
    public string|null $name;
    /**
     * Optional. User's phone number
     *
     * @var string|null
     */
    public string|null $phone_number;
    /**
     * Optional. User email
     *
     * @var string|null
     */
    public string|null $email;
    /**
     * Optional. User shipping address
     *
     * @var ShippingAddress|null
     */
    public ShippingAddress|null $shipping_address;
}
