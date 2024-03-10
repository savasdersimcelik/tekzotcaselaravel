<?php

namespace App\Libraries\Zotlo\Request;

class CardRequest
{
    private $subscriberId = null;

    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }
}
