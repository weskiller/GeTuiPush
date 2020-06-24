<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\Type\PBEnum;

class NotifyInfoType extends PBEnum
{
    const _payload  = 0;
    const _intent  = 1;
    const _url  = 2;
}