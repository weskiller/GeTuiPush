<?php


namespace Weskiller\GeTuiPush\Library;


use Weskiller\GeTuiPush\Protobuf\PBMessage;
use Weskiller\GeTuiPush\Protobuf\Type\PBString;

class NotifyInfo extends PBMessage
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
        $this->fields["4"] = PBString::class;
        $this->values["4"] = "";
        $this->fields["5"] = PBString::class;
        $this->values["5"] = "";
        $this->fields["6"] = NotifyInfoType::class;
        $this->values["6"] = "";
        $notify = new NotifyInfoType();
        $notify->value = NotifyInfoType::_payload;
        $this->values["6"] = $notify;
        $this->fields["7"] = PBString::class;
        $this->values["7"] = "";
    }
    function title()
    {
        return $this->_get_value("1");
    }
    function set_title($value)
    {
        $this->_set_value("1", $value);
    }
    function content()
    {
        return $this->_get_value("2");
    }
    function set_content($value)
    {
        $this->_set_value("2", $value);
    }
    function payload()
    {
        return $this->_get_value("3");
    }
    function set_payload($value)
    {
        $this->_set_value("3", $value);
    }
    function intent()
    {
        return $this->_get_value("4");
    }
    function set_intent($value)
    {
        $this->_set_value("4", $value);
    }
    function url()
    {
        return $this->_get_value("5");
    }
    function set_url($value)
    {
        $this->_set_value("5", $value);
    }
    function type()
    {
        return $this->_get_value("6");
    }
    function set_type($value)
    {
        $this->_set_value("6", $value);
    }
    function notifyId()
    {
        return $this->_get_value("7");
    }
    function set_notifyId($value)
    {
        $this->_set_value("7", $value);
    }
}