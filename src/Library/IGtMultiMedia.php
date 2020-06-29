<?php

namespace Weskiller\GeTuiPush\Library;

class IGtMultiMedia {
    /**
     * 资源ID
     */
    protected $rid;
    /**
     * 资源url
     */
    protected $url;
    /**
     * 资源类型
     */
    protected $type;
    /**
     * 是否只支持wifi下发
     */
    protected $onlywifi = 0;

    public function __construct(){}

    function get_rid() {
        return $this->rid;
    }

    function  set_rid($rid) {
        $this->rid = $rid;
        return $this;
    }

    function get_url() {
        return $this->url;
    }

    function set_url($url) {
        $this->url = $url;
        return$this;
    }

    function get_type() {
        return $this -> type;
    }

    function set_type($type) {
        $this -> type = $type;
        return $this;
    }

    function set_onlywifi($onlywifi) {
        $this -> onlywifi = $onlywifi ? 1:0;
        return $this;
    }

    function get_onlywifi() {
        return $this -> onlywifi;
    }
}