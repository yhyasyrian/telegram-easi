<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class PassportFile
{
    /**
     * Identifier for this file, which can be used to download or reuse the file
     *
     * @var string
     */
    public string $file_id;
    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    public string $file_unique_id;
    /**
     * File size in bytes
     *
     * @var int
     */
    public int $file_size;
    /**
     * Unix time when the file was uploaded
     *
     * @var int
     */
    public int $file_date;
}
