<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class AppStartUp extends PBMessage
{
    var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
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
    function android()
    {
        return $this->_get_value("1");
    }
    function set_android($value)
    {
        $this->_set_value("1", $value);
    }
    function symbia()
    {
        return $this->_get_value("2");
    }
    function set_symbia($value)
    {
        $this->_set_value("2", $value);
    }
    function ios()
    {
        return $this->_get_value("3");
    }
    function set_ios($value)
    {
        $this->_set_value("3", $value);
    }
}