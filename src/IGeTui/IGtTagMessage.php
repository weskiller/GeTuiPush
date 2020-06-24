<?php
namespace Weskiller\GeTuiPush\IGeTui;

class IGtTagMessage extends IGtMessage
{

    protected $appIdList;
    protected $tag;
    protected $speed=0;

    function get_appIdList() {
        return $this->appIdList;
    }

    function  set_appIdList($appIdList) {
        $this->appIdList = $appIdList;
    }

    function get_tag() {
        return $this->tag;
    }

    function set_tag($tag) {
        $this->tag = $tag;
    }

    function get_speed()
    {
        return $this->speed;
    }
    function set_speed($speed)
    {
        $this->speed=$speed;
    }
}