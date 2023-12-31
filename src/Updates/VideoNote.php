<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class VideoNote
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
     * Video width and height (diameter of the video message) as defined by sender
     *
     * @var int
     */
    public int $length;
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
     * Optional. Video thumbnail
     *
     * @var PhotoSize|null
     */
    public PhotoSize|null $thumb;
    /**
     * Optional. File size in bytes
     *
     * @var int|null
     */
    public int|null $file_size;
}
