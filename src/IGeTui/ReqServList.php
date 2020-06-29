<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBInt;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class ReqServList extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = PBString::class;
        $this->values["1"] = "";
        $this->fields["2"] = PBInt::class;
        $this->values["2"] = "";
    }
    function seqId()
    {
        return $this->_get_value("1");
    }
    function set_seqId($value)
    {
        $this->_set_value("1", $value);
    }
    function timestamp()
    {
        $this->_get_value("2");
    }
    function set_timestamp($value)
    {
        $this->_set_value("2", $value);
    }
}