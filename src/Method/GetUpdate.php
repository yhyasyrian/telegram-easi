<?php

namespace Yhyasyrian\TelegramEasi\Method;

use Exception;
use Yhyasyrian\TelegramEasi\Helpers\ConfigObject;
use Yhyasyrian\TelegramEasi\Updates\Update;

class GetUpdate extends Api
{
    /**
     * Start the bot with CLI
     * 
     * @param callable $callable
     * 
     * @return void
     */
    public function startBot(object|callable|string $callable): void
    {
        if (PHP_SAPI == 'cli') {
            $this->deleteWebhook();
            $Update = new Update();
            $Update->update_id = 0;
            while (true) {
                $offset = $Update->update_id ?? 0;
                $Update = $this->getUpdate(offset: ($offset + 1));
                if (empty($Update)) {
                    continue;
                }
                $this->eventTelegram(callable:$callable,Update:$Update);
            }
        } else {
            $Update = file_get_contents('php://input');
            if (!empty($Update)) {
                $Update = (new ConfigObject(\Yhyasyrian\TelegramEasi\Updates\Update::class, json_decode($Update,1)))->getUpdate();
                $this->eventTelegram(callable:$callable,Update:$Update);
            }
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
    /**
     * Start function bot
     * 
     * @param object|callable $callable fot run bot
     * @return void
     */
    private function eventTelegram(object|callable|string $callable,Update $Update) :void {
        if (is_string($callable) and !class_exists($callable)) {
            throw new Exception("The param \$callable must be object|callable for run");
        } else if (is_string($callable) and class_exists($callable)) {
            $callable = new $callable();
        }
        if (is_object($callable) and !is_callable($callable)) {
            if (isset($Update->message)) {
                try {
                    $callable->isNewMessage(Update:$Update->message);
                } catch (\Throwable $th) {}
            } else if ($Update->edited_message) {
                try {
                    $callable->isEditMessage(Update:$Update->edited_message);
                } catch (\Throwable $th) {}
            } else if ($Update->channel_post) {
                try {
                    $callable->isNewChannelMessage(Update:$Update->channel_post);
                } catch (\Throwable $th) {}
            } else if ($Update->callback_query) {
                try {
                    $callable->isCallBack(Update:$Update->callback_query);
                } catch (\Throwable $th) {}
            } else if ($Update->edited_channel_post) {
                try {
                    $callable->isEditChannelMessage(Update:$Update->edited_channel_post);
                } catch (\Throwable $th) {}
            } else {
                $callable->isAny(Update:$Update);
            }
        } else {
            $callable(Update:$Update,Api:$this);
        }
    }
}
