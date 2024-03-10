<?php

namespace App\Libraries\Zotlo\Request;

class ProfileRequest
{
    private $subscriberId = null;
    private $packageId = null;

    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    public function getPackageId()
    {
        return $this->packageId;
    }

    public function setPackageId( $packageId)
    {
        $this->packageId = $packageId;
        return $this;
    }
}
