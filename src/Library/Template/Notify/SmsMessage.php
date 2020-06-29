<?php

namespace Weskiller\GeTuiPush\Library\Template\Notify;

class SmsMessage {

    protected $smsTemplateId;
    /**
     * 短信填充
     */
    protected $smsContent;
    /**
     * 离线多久后进行消息补发
     */
    protected $offlineSendtime;

    protected $url;//Applink路径
    protected $isApplink;
    protected $payload;

    /**
     * @return mixed
     */
    public function getSmsTemplateId()
    {
        return $this->smsTemplateId;
    }

    /**
     * @param mixed $smsTemplateId
     */
    public function setSmsTemplateId($smsTemplateId)
    {
        $this->smsTemplateId = $smsTemplateId;
    }

    /**
     * @return mixed
     */
    public function getSmsContent()
    {
        return $this->smsContent;
    }

    /**
     * @param mixed $smsContent
     */
    public function setSmsContent($smsContent)
    {
        $this->smsContent = $smsContent;
    }

    /**
     * @return mixed
     */
    public function getOfflineSendtime()
    {
        return $this->offlineSendtime;
    }

    /**
     * @param mixed $offlineSendtime
     */
    public function setOfflineSendtime($offlineSendtime)
    {
        $this->offlineSendtime = $offlineSendtime;
    }


    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getisApplink()
    {
        return $this->isApplink;
    }

    /**
     * @param mixed $isApplink
     */
    public function setIsApplink($isApplink)
    {
        $this->isApplink = $isApplink;
    }
    
    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @param mixed $payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }//自定义字段

}