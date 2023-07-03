<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class PhotoSize
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
     * Photo width
     *
     * @var int
     */
    public int $width;
    /**
     * Photo height
     *
     * @var int
     */
    public int $height;
    /**
     * Optional. File size in bytes
     *
     * @var int|null
     */
    public int|null $file_size;
}
