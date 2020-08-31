<?php


namespace Weskiller\GeTuiPush\Utils;


class Json
{
    /**
     * @param $input
     * @return false|string
     * @throws \JsonException
     */
    static function encode($input)
    {
        return json_encode($input, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param $input
     * @return array
     * @throws \JsonException
     */
    static function decode($input)
    {
        return json_decode($input, true,512,JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING);
    }
}