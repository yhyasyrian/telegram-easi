<?php

namespace Yhyasyrian\TelegramEasi\Method;

class Api
{
    /**
     * Function send request to API Telegram
     * 
     * @var callable file_get_contents
     */
    public $request = file_get_contents::class;
    /**
     * Set Token Bot
     * 
     * @var string
     */
    public string $token;
    /**
     * Set send request to API Telegram and use that
     * 
     * @param callable|string $request Function send request to API Telegram
     * @param string $token Set Token Bot
     */
    public function __construct(callable|string $request = file_get_contents::class,string $token)
    {
        $this->request = $request;
        $this->token = $token;
    }
    /**
     * Call To API Telegram
     * 
     * @param array $data data send to API Telegram
     * @param string $metohd name method
     * @return Bot
     */
    public function call(array $data = [],string $metohd) :Bot {
        $call = $this->request;
        $return = $call('https://api.telegram.org/bot'.$this->token.'/'.$metohd.'?'.http_build_query($data));
        if (is_string($return)) {
            $return = json_decode($return);
        }
        return (new Bot($return));
    }
    /**
     * Use this method to specify a URL and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified URL, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     * If you'd like to make sure that the webhook was set by you, you can specify secret data in the parameter secret_token. If specified, the request will contain a header “X-Telegram-Bot-Api-Secret-Token” with the secret token as content.
     * 
     * @param string $url YesHTTPS URL to send updates to. Use an empty string to remove webhook integration
     * @param string|null $certificate OptionalUpload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
     * @param string|null $ip_address OptionalThe fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
     * @param int|null $max_connections OptionalThe maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
     * @param array<string>|null $allowed_updates OptionalA JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
     * @param bool|null $drop_pending_updates OptionalPass True to drop all pending updates
     * @param string|null $secret_token OptionalA secret token to be sent in a header “X-Telegram-Bot-Api-Secret-Token” in every webhook request, 1-256 characters. Only characters A-Z, a-z, 0-9, _ and - are allowed. The header is useful to ensure that the request comes from a webhook set by you.
     * 
     * @return Bot
     */
    public function setWebhook(string $url, string|null $certificate = '', string|null $ip_address = '', int|null $max_connections = 0, ?array $allowed_updates = [], bool|null $drop_pending_updates = false, string|null $secret_token = '') :Bot {
        return $this->call([
            'url' => $url,'certificate' => $certificate,'ip_address' => $ip_address,'max_connections' => $max_connections,'allowed_updates' => $allowed_updates,'drop_pending_updates' => $drop_pending_updates,'secret_token' => $secret_token,
        ],'setWebhook');
    }
}
