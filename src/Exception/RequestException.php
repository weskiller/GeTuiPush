<?php

namespace Weskiller\GeTuiPush\Exception;

use Exception;

class RequestException extends Exception
{
    protected $requestId;

    public function __construct($requestId, $message, $e)
    {
        parent::__construct($message, $e);
        $this->requestId = $requestId;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }
}