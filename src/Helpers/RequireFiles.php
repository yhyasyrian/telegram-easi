<?php

namespace Yhyasyrian\TelegramEasi\Helpers;

class RequireFiles {
    public function __construct(string $filename,bool $isUpdate = false)
    {
        if ($isUpdate) {
            require_once __DIR__."/../Updates/{$filename}.php";
        } else {
            require_once __DIR__."/../{$filename}.php";
        }
    }
}