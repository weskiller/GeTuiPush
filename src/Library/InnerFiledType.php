<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\Type\PBEnum;

class InnerFiledType extends PBEnum
{
    const str  = 0;
    const int32  = 1;
    const int64  = 2;
    const floa  = 3;
    const doub  = 4;
    const bool  = 5;
}