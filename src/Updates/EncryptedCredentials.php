<?php

namespace Yhyasyrian\TelegramEasi\Updates;

class EncryptedCredentials
{
    /**
     * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     *
     * @var string
     */
    public string $data;
    /**
     * Base64-encoded data hash for data authentication
     *
     * @var string
     */
    public string $hash;
    /**
     * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     *
     * @var string
     */
    public string $secret;
}
