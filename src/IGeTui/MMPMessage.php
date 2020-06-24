<?php


namespace Weskiller\GeTuiPush\IGeTui;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBBool;

class MMPMessage extends PBMessage
{
    protected $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
    public function __construct($reader=null)
    {
        parent::__construct($reader);
        $this->fields["2"] = "Transparent";
        $this->values["2"] = "";
        $this->fields["3"] = "PBString";
        $this->values["3"] = "";
        $this->fields["4"] = "PBInt";
        $this->values["4"] = "";
        $this->fields["5"] = "PBInt";
        $this->values["5"] = "";
        $this->fields["6"] = "PBInt";
        $this->values["6"] = "";
        $this->fields["7"] = "PBBool";
        $this->values["7"] = "";
        $pool7 = new PBBool();
        $pool7->value = true;
        $this->values["7"] = $pool7;
        $this->fields["8"] = "PBInt";
        $this->values["8"] = "";
        $this->fields["9"] = "PBString";
        $this->values["9"] = "";
        $this->fields["10"] = "PBBool";
        $this->values["10"] = "";
        $pool10 = new PBBool();
        $pool10->value = true;
        $this->values["10"] = $pool10;
    }
    function transparent()
    {
        return $this->_get_value("2");
    }
    function set_transparent($value)
    {
        $this->_set_value("2", $value);
    }
    function extraData()
    {
        return $this->_get_value("3");
    }
    function set_extraData($value)
    {
        $this->_set_value("3", $value);
    }
    function msgType()
    {
        return $this->_get_value("4");
    }
    function set_msgType($value)
    {
        $this->_set_value("4", $value);
    }
    function msgTraceFlag()
    {
        return $this->_get_value("5");
    }
    function set_msgTraceFlag($value)
    {
        $this->_set_value("5", $value);
    }
    function msgOfflineExpire()
    {
        return $this->_get_value("6");
    }
    function set_msgOfflineExpire($value)
    {
        $this->_set_value("6", $value);
    }
    function isOffline()
    {
        return $this->_get_value("7");
    }
    function set_isOffline($value)
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
    function cdnUrl()
    {
        return $this->_get_value("9");
    }
    function set_cdnUrl($value)
    {
        $this->_set_value("9", $value);
    }
    function isSync()
    {
        return $this->_get_value("10");
    }
    function set_isSync($value)
    {
        $this->_set_value("10", $value);
    }
}