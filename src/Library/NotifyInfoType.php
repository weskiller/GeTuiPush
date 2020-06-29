<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\Type\PBEnum;

class NotifyInfoType extends PBEnum
{
    public const _payload  = 0;
    public const _intent  = 1;
    public const _url  = 2;
}