<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBInt;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class GtAuth extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = PBString::class;
        $this->values["1"] = "";
        $this->fields["2"] = PBString::class;
        $this->values["2"] = "";
        $this->fields["3"] = PBInt::class;
        $this->values["3"] = "";
        $this->fields["4"] = PBString::class;
        $this->values["4"] = "";
    }
    function sign()
    {
        return $this->_get_value("1");
    }
    function set_sign($value)
    {
        $this->_set_value("1", $value);
    }
    function appkey()
    {
        return $this->_get_value("2");
    }
    function set_appkey($value)
    {
        $this->_set_value("2", $value);
    }
    function timestamp()
    {
        return $this->_get_value("3");
    }
    function set_timestamp($value)
    {
        $this->_set_value("3", $value);
    }
    function seqId()
    {
        return $this->_get_value("4");
    }
    function set_seqId($value)
    {
        $this->_set_value("4", $value);
    }
}