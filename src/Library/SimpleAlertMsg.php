<?php

namespace Weskiller\GeTuiPush\Library;

use Weskiller\GeTuiPush\Contracts\ApnMsgInterface;

class SimpleAlertMsg implements ApnMsgInterface
{

    protected $alertMsg;

    public function get_alertMsg() {
        return $this->alertMsg;
    }
}