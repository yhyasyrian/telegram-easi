<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class ChatPhoto
{
    /**
     * File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     *
     * @var string
     */
    public string $small_file_id;
    /**
     * Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    public string $small_file_unique_id;
    /**
     * File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     *
     * @var string
     */
    public string $big_file_id;
    /**
     * Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     *
     * @var string
     */
    public string $big_file_unique_id;
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
     * Optional. File size in bytes
     *
     * @var int|null
     */
    public int|null $file_size;
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
}
