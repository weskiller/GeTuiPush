<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class SmsContentEntry extends PBMessage
{
    protected int $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = PBString::class;
        $this->values["1"] = "";
        $this->fields["2"] = PBString::class;
        $this->values["2"] = "";
    }
    function key()
    {
        return $this->_get_value("1");
    }
    function set_key($value)
    {
        $this->_set_value("1", $value);
    }
    function value()
    {
        return $this->_get_value("2");
    }
    function set_value($value)
    {
        $this->_set_value("2", $value);
    }
}