<?php

namespace Weskiller\GeTuiPush\Exception;

use Exception;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-28
 * Time: 下午5:05
 */
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