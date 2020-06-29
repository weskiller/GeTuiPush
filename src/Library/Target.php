<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class Target extends PBMessage
{
    protected int $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["1"] = PBString::class;
        $this->values["1"] = "";
        $this->fields["2"] = PBString::class;
        $this->values["2"] = "";
        $this->fields["3"] = PBString::class;
        $this->values["3"] = "";
    }
    function appId()
    {
        return $this->_get_value("1");
    }
    function set_appId($value)
    {
        $this->_set_value("1", $value);
    }
    function clientId()
    {
        return $this->_get_value("2");
    }
    function set_clientId($value)
    {
        $this->_set_value("2", $value);
    }
    function alias()
    {
        return $this->_get_value("3");
    }
    function set_alias($value)
    {
        $this->_set_value("3", $value);
    }
}