<?php

namespace Weskiller\GeTuiPush\IGeTui;

use Weskiller\GeTuiPush\Contracts\ApnMsgInterface;

class SimpleAlertMsg implements ApnMsgInterface
{

    protected $alertMsg;

    public function get_alertMsg() {
        return $this->alertMsg;
    }
}