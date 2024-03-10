<?php

namespace App\Libraries\Zotlo\Request;

class CancelRequest
{
    private $subscriberId = null;
    private $packageId = null;
    private $reason = null;
    private $force = 0;

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

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason($reason)
    {
        $this->reason = $reason;
        return $this;
    }

    public function getForce()
    {
        return $this->force;
    }

    public function setForce($force = 0)
    {
        $this->force = $force;
        return $this;
    }
}
