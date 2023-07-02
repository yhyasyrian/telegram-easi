<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Audio
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
     * Duration of the audio in seconds as defined by sender
     *
     * @var int
     */
    public int $duration;
    /**
     * Optional. Performer of the audio as defined by sender or by audio tags
     *
     * @var string|null
     */
    public string|null $performer;
    /**
     * Optional. Title of the audio as defined by sender or by audio tags
     *
     * @var string|null
     */
    public string|null $title;
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
    /**
     * Optional. Thumbnail of the album cover to which the music file belongs
     *
     * @var PhotoSize|null
     */
    public PhotoSize|null $thumbnail;
}
