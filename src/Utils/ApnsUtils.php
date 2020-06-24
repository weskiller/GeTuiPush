<?php

namespace Weskiller\GeTuiPush\Utils;

use RuntimeException;

Class ApnsUtils
{

    static function validatePayloadLength($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload,$contentAvailable)
    {
        $json = self:: processPayload($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload,$contentAvailable);
        return strlen($json);
    }

    static function processPayload($locKey, $locArgs, $message, $actionLocKey, $launchImage, $badge, $sound, $payload, $contentAvailable)
    {
        $isValid = false;
        $pb = new Payload();
        if ($locKey !== null && $locKey !== '') {
            // loc-key
            $pb->setAlertLocKey(($locKey));
            // loc-args
            if ($locArgs !== null && $locArgs !== '') {
                $pb->setAlertLocArgs(explode(',',($locArgs)));
            }
            $isValid = true;
        }

        // body
        if ($message !== null && $message !== '') {
            $pb->setAlertBody(($message));
            $isValid = true;
        }

        // action-loc-key
        if ($actionLocKey !== null && $actionLocKey !== '') {
            $pb->setAlertActionLocKey($actionLocKey);
        }

        // launch-image
        if ($launchImage !== null && $launchImage !== '') {
            $pb->setAlertLaunchImage($launchImage);
        }

        // badge
        $badgeNum = -1;
        if(is_numeric($badge)){
            $badgeNum = (int)$badge;
        }
        if ($badgeNum >= 0) {
            $pb->setBadge($badgeNum);
            $isValid = true;
        }

        // sound
        if ($sound !== null && $payload !== '') {
            $pb->setSound($sound);
        } else {
            $pb->setSound("default");
        }

        //contentAvailable
        if ($contentAvailable === 1) {
            $pb->setContentAvailable(1);
            $isValid = true;
        }

        // payload
        if ($payload !== null && $payload !== '') {
            $pb->addParam("payload", ($payload));
        }

        if($isValid === false){
            throw new RuntimeException("one of the params(locKey,message,badge) must not be null or contentAvailable must be 1");
        }
        $json = $pb->toString();
        if($json === null){
            throw new RuntimeException("payload json is null");
        }
        return $json;
    }
}