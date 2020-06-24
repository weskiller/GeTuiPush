<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\Type\PBEnum;

class SMSStatus extends PBEnum
{
    const unread  = 0;
    const read  = 1;
}