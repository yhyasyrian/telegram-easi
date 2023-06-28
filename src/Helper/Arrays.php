<?php

namespace Yhyasyrian\TelegramEasi\Helper;

class Arrays {
    public static function addValues(mixed $var,array|\stdClass $data) {
        /**
         * @var array<array|int|string> $key
         */
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (isset($var->{$key}) and is_object($var->{$key})) {
                    $var->{$key} = self::addValues((new ($var->{$key}::class)),$value);
                }
            } else {
                $var->{$key} = $value;
            }
        }
        return $var;
    }
}