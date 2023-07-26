<?php

namespace Yhyasyrian\TelegramEasi\Method;

use Yhyasyrian\TelegramEasi\Helpers\ConfigObject;
use Yhyasyrian\TelegramEasi\Updates\Update;

class GetUpdate extends Api
{
    /**
     * Start the bot with CLI
     * 
     * @return void
     */
    public function startBot(callable $callable): void
    {
        $update = new Update();
        $update->update_id = 0;
        while (true) {
            $offset = $update->update_id ?? 0;
            $update = $this->getUpdate(offset: ($offset + 1));
            if (empty($update)) {
                continue;
            }
            $callable(Update:$update,Api:$this);
        }
    }
    /**
     * Use this method to receive incoming updates using long polling (<a href="https://en.wikipedia.org/wiki/Push_technology#Long_polling">wiki</a>). Returns an Array of <a href="#update">Update</a> objects.
     * @param int|null $offset OptionalIdentifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will be forgotten.
     * @param int|null $limit OptionalLimits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @param int|null $timeout OptionalTimeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only.
     * @param string|null $allowed_updates OptionalA JSON-serialized list of the update types you want your bot to receive. For example, specify [“message”, “edited_channel_post”, “callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted updates may be received for a short period of time.
     * @return \Yhyasyrian\TelegramEasi\Updates\Update|null
     */
    public function getUpdate(?int $offset = 0, ?int $limit = 0, ?int $timeout = 0, ?string $allowed_updates = null): \Yhyasyrian\TelegramEasi\Updates\Update|null
    {
        $update = $this->getUpdates(offset: $offset);
        if (isset($update->result[0])) {
            return (new ConfigObject(\Yhyasyrian\TelegramEasi\Updates\Update::class, $update->result[0]))->getUpdate();
        } else {
            return null;
        }
    }
}
