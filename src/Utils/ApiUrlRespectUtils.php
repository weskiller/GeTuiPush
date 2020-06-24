<?php

namespace Weskiller\GeTuiPush\Utils;

use RuntimeException;

class ApiUrlRespectUtils
{
    static $appkeyAndFasterHost = [];

    static $appKeyAndHost = [];

    static $appkeyAndLastExecuteTime = [];

    public static function getFastest($appkey,$hosts)
    {
        if ($hosts === null || count($hosts )=== 0)
        {
            throw new RuntimeException("Hosts cann't be null or size must greater than 0");
        }
        if(isset(self::$appkeyAndFasterHost[$appkey]) && count(array_diff($hosts,isset(self::$appKeyAndHost[$appkey])?ApiUrlRespectUtils::$appKeyAndHost[$appkey]:null)) == 0)
        {
            return self::$appkeyAndFasterHost[$appkey];
        }

        $fastest = self::getFastestRealTime($hosts);
        self::$appKeyAndHost[$appkey] = $hosts;
        self::$appkeyAndFasterHost[$appkey] = $fastest;
        return $fastest;
    }

    public static function getFastestRealTime($hosts)
    {
        $mint=60.0;
        $s_url="";
        foreach ($hosts as $iValue) {
            $start = array_sum(explode(" ",microtime()));
            HttpManager::httpHead($iValue);
            $ends = array_sum(explode(" ",microtime()));
            $diff=$ends-$start;
            if ($mint > $diff)
            {
                $mint=$diff;
                $s_url= $iValue;
            }
        }
        return $s_url;
    }
}