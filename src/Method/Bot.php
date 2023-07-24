<?php

namespace Yhyasyrian\TelegramEasi\Method;

class Bot {
    /**
     * Is the result available
     *
     * @var bool
     */
    public bool $ok;
    /**
     * Result from API
     * 
     * @var mixed
     */
    public mixed $result;
    /**
     * Description from API
     * 
     * @var string
     */
    public string $description;
    /**
     * Config Class
     * 
     * @param \stdClass $ApiResult Return request from API Telegram
     */
    public function __construct(\stdClass $ApiResult) {
        $this->result = $ApiResult->result;
        $this->ok = $ApiResult->ok;
        $this->description = $ApiResult->description;
    }
}