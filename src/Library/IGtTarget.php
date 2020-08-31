<?php

namespace Weskiller\GeTuiPush\Library;

class IGtTarget
{
    protected string $appId;

	protected ?string $clientId = null;

    protected ?string $alias = null;

    public function get_appId()
    {
        return $this->appId;
    }
    public function setAppId($appId)
    {
        return $this->appId = $appId;
    }
    public function get_clientId()
    {
        return $this->clientId;
    }
    public function setClientId($clientId)
    {
        return $this->clientId = $clientId;
    }
    public function set_alias($alias)
    {
        return $this->alias = $alias;
    }
    public function get_alias()
    {
        return $this->alias;
    }
}