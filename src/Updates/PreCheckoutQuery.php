<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class PreCheckoutQuery
{
    /**
     * Unique query identifier
     *
     * @var string
     */
    public string $id;
    /**
     * User who sent the query
     *
     * @var User
     */
    public User $from;
    /**
     * Three-letter ISO 4217 currency code
     *
     * @var string
     */
    public string $currency;
    /**
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     *
     * @var int
     */
    public int $total_amount;
    /**
     * Bot specified invoice payload
     *
     * @var string
     */
    public string $invoice_payload;
    /**
     * Optional. Identifier of the shipping option chosen by the user
     *
     * @var string|null
     */
    public string|null $shipping_option_id;
    /**
     * Optional. Order information provided by the user
     *
     * @var OrderInfo|null
     */
    public OrderInfo|null $order_info;
}
