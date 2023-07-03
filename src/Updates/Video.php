<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Video
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
     * Video width as defined by sender
     *
     * @var int
     */
    public int $width;
    /**
     * Video height as defined by sender
     *
     * @var int
     */
    public int $height;
    /**
     * Duration of the video in seconds as defined by sender
     *
     * @var int
     */
    public int $duration;
    /**
     * Optional. Video thumbnail
     *
     * @var PhotoSize|null
     */
    public PhotoSize|null $thumbnail;
    /**
     * Optional. Original filename as defined by sender
     *
     * @var string|null
     */
    public string|null $file_name;
    /**
     * Optional. MIME type of the file as defined by sender
     *
     * @var string|null
     */
    public string|null $mime_type;
    /**
     * Optional. File size in bytes. It can be bigger than 2^31 and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this value.
     *
     * @var int|null
     */
    public int|null $file_size;
}
