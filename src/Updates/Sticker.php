<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class Sticker
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
     * Type of the sticker, currently one of “regular”, “mask”, “custom_emoji”. The type of the sticker is independent from its format, which is determined by the fields is_animated and is_video.
     *
     * @var string
     */
    public string $type;
    /**
     * Sticker width
     *
     * @var int
     */
    public int $width;
    /**
     * Sticker height
     *
     * @var int
     */
    public int $height;
    /**
     * True, if the sticker is animated
     *
     * @var bool
     */
    public ?bool $is_animated;
    /**
     * True, if the sticker is a video sticker
     *
     * @var bool
     */
    public ?bool $is_video;
    /**
     * Optional. Sticker thumbnail in the .WEBP or .JPG format
     *
     * @var PhotoSize|null
     */
    public PhotoSize|null $thumbnail;
    /**
     * Optional. Sticker thumbnail in the .WEBP or .JPG format
     *
     * @var PhotoSize|null
     */
    public PhotoSize|null $thumb;
    /**
     * Optional. Emoji associated with the sticker
     *
     * @var string|null
     */
    public string|null $emoji;
    /**
     * Optional. Name of the sticker set to which the sticker belongs
     *
     * @var string|null
     */
    public string|null $set_name;
    /**
     * Optional. For premium regular stickers, premium animation for the sticker
     *
     * @var File|null
     */
    public File|null $premium_animation;
    /**
     * Optional. For mask stickers, the position where the mask should be placed
     *
     * @var MaskPosition|null
     */
    public MaskPosition|null $mask_position;
    /**
     * Optional. For custom emoji stickers, unique identifier of the custom emoji
     *
     * @var string|null
     */
    public string|null $custom_emoji_id;
    /**
     * Optional. True, if the sticker must be repainted to a text color in messages, the color of the Telegram Premium badge in emoji status, white color on chat photos, or another appropriate color in other places
     *
     * @var bool|null
     */
    public bool|null $needs_repainting;
    /**
     * Optional. File size in bytes
     *
     * @var int|null
     */
    public int|null $file_size;
}
