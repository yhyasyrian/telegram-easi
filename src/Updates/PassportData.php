<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class PassportData
{
    /**
     * Array with information about documents and other Telegram Passport elements that was shared with the bot
     *
     * @var array<EncryptedPassportElement>
     */
    public ?array $data;
    /**
     * Encrypted credentials required to decrypt the data
     *
     * @var EncryptedCredentials
     */
    public EncryptedCredentials $credentials;
}
