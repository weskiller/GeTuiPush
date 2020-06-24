<?php


namespace Weskiller\GeTuiPush\Utils;


class Json
{
    static function encode($input)
    {
        $json = json_encode($input, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_BIGINT_AS_STRING);
        if(json_last_error()) {
            return false;
        }
        return $json;
    }
}