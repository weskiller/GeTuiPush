<?php

namespace Weskiller\GeTuiPush\Payload;

use RuntimeException;

Class VOIPPayload {

    protected $voIPPayload;

    /**
     * @return false|string
     */
    public function get_payload()
    {
        $payload = $this->voIPPayload;
        if($payload === null || empty($payload)){
            throw new RuntimeException("payload cannot be empty");
        }
        $params = array();
        if($payload !== null) {
            $params["payload"] = $payload;
        }
        $params["isVoIP"] = 1;
        return json_encode($params,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_BIGINT_AS_STRING);
     }

     public function setVoIPPayload($voIPPayload){
        $this->voIPPayload = $voIPPayload;
     }

}