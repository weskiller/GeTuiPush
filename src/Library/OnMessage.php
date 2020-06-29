<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBBool;
use Weskiller\GeTuiPush\Protobuf\Type\PBInt;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class OnMessage extends PBMessage
{
    protected int $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["2"] = PBBool::class;
        $this->values["2"] = "";
        $this->fields["3"] = PBInt::class;
        $this->values["3"] = "";
        $this->fields["4"] = Transparent::class;
        $this->values["4"] = "";
        $this->fields["5"] = PBString::class;
        $this->values["5"] = "";
        $this->fields["6"] = PBInt::class;
        $this->values["6"] = "";
        $this->fields["7"] = PBInt::class;
        $this->values["7"] = "";
        $this->fields["8"] = PBInt::class;
        $this->values["8"] = "";
    }
    function isOffline()
    {
        return $this->_get_value("2");
    }
    function set_isOffline($value)
    {
        $this->_set_value("2", $value);
    }
    function offlineExpireTime()
    {
        return $this->_get_value("3");
    }
    function set_offlineExpireTime($value)
    {
        $this->_set_value("3", $value);
    }
    function transparent()
    {
        return $this->_get_value("4");
    }
    function set_transparent($value)
    {
        $this->_set_value("4", $value);
    }
    function extraData()
    {
        return $this->_get_value("5");
    }
    function set_extraData($value)
    {
        $this->_set_value("5", $value);
    }
    function msgType()
    {
        return $this->_get_value("6");
    }
    function set_msgType($value)
    {
        $this->_set_value("6", $value);
    }
    function msgTraceFlag()
    {
        return $this->_get_value("7");
    }
    function set_msgTraceFlag($value)
    {
        $this->_set_value("7", $value);
    }
    function priority()
    {
        return $this->_get_value("8");
    }
    function set_priority($value)
    {
        $this->_set_value("8", $value);
    }
}