<?php
namespace Weskiller\GeTuiPush\Library;

use Weskiller\GeTuiPush\Contracts\ApnMsgInterface;

class DictionaryAlertMsg implements ApnMsgInterface
{

    public $title;
    public $body;
    public $titleLocKey;
    public $titleLocArgs = array();
    public $actionLocKey;
    public $locKey;
    public $locArgs = array();
    public $launchImage;
    public $subtitle;
    public $subtitleLocKey;
    public $subtitleLocArgs;

    public function get_alertMsg() {

        $alertMap = array();

        if ($this->title !== null && $this->title !== "") {
            $alertMap["title"] = $this->title;
        }
        if ($this->body !== null && $this->body !== "") {
            $alertMap["body"] = $this->body;
        }
        if ($this->titleLocKey !== null && $this->titleLocKey !== "") {
            $alertMap["title-loc-key"] = $this->titleLocKey;
        }
        if (count($this->titleLocArgs) > 0) {
            $alertMap["title-loc-args"] = $this->titleLocArgs;
        }
        if ($this->actionLocKey !== null && $this->actionLocKey) {
            $alertMap["action-loc-key"] = $this->actionLocKey;
        }
        if ($this->locKey !== null && $this->locKey !== "") {
            $alertMap["loc-key"] = $this->locKey;
        }
        if (count($this->locArgs) > 0) {
            $alertMap["loc-args"] = $this->locArgs;
        }
        if ($this->launchImage !== null && $this->launchImage !== "") {
            $alertMap["launch-image"] = $this->launchImage;
        }

        if(count($alertMap) === 0)
        {
            return null;
        }

        if ($this->subtitle !== null && $this->subtitle !== "") {
            $alertMap["subtitle"] = $this->subtitle;
        }
        if (count($this->subtitleLocArgs) > 0) {
            $alertMap["subtitle-loc-args"] = $this->subtitleLocArgs;
        }
        if ($this->subtitleLocKey !== null && $this->subtitleLocKey !== "") {
            $alertMap["subtitle-loc-key"] = $this->subtitleLocKey;
        }
        return $alertMap;
    }
}