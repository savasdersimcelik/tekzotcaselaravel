<?php

namespace App\Libraries\Zotlo\Response;

class Profile
{
    private $status = null;
    private $realStatus = null;
    private $subscriberId = null;
    private $subscriptionId = null;
    private $subscriptionType = null;
    private $startDate = null;
    private $expireDate = null;
    private $renewalDate = null;
    private $package = null;
    private $country = null;
    private $phoneNumber = null;
    private $language = null;
    private $originalTransactionId = null;
    private Cancellation|null $cancellation = null;
    private $customParameters = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setStatus($data["status"] ?? null);
            $this->setRealStatus($data["realStatus"] ?? null);
            $this->setSubscriberId($data["subscriberId"] ?? null);
            $this->setSubscriptionId($data["subscriptionId"] ?? null);
            $this->setSubscriptionType($data["subscriptionType"] ?? null);
            $this->setStartDate($data["startDate"] ?? null);
            $this->setExpireDate($data["expireDate"] ?? null);
            $this->setRenewalDate($data["renewalDate"] ?? null);
            $this->setPackage($data["package"] ?? null);
            $this->setCountry($data["country"] ?? null);
            $this->setPhoneNumber($data["phoneNumber"] ?? null);
            $this->setLanguage($data["language"] ?? null);
            $this->setOriginalTransactionId($data["originalTransactionId"] ?? null);
            $this->setCancellation($data["cancellation"] ?? null);
            $this->setCustomParameters($data["customParameters"] ?? null);
        }
    }

    public function setStatus($status = null)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setRealStatus($realStatus = null)
    {
        $this->realStatus = $realStatus;
    }

    public function getRealStatus()
    {
        return $this->realStatus;
    }

    public function setSubscriberId($subscriberId = null)
    {
        $this->subscriberId = $subscriberId;
    }

    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    public function setSubscriptionId($subscriptionId = null)
    {
        $this->subscriptionId = $subscriptionId;
    }

    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    public function setSubscriptionType($subscriptionType = null)
    {
        $this->subscriptionType = $subscriptionType;
    }

    public function getSubscriptionType()
    {
        return $this->subscriptionType;
    }

    public function setStartDate($startDate = null)
    {
        $this->startDate = $startDate;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setExpireDate($expireDate = null)
    {
        $this->expireDate = $expireDate;
    }

    public function getExpireDate()
    {
        return $this->expireDate;
    }

    public function setRenewalDate($renewalDate = null)
    {
        $this->renewalDate = $renewalDate;
    }

    public function getRenewalDate()
    {
        return $this->renewalDate;
    }

    public function setPackage($package = null)
    {
        $this->package = $package;
    }

    public function getPackage()
    {
        return $this->package;
    }

    public function setCountry($country = null)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setPhoneNumber($phoneNumber = null)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setOriginalTransactionId($originalTransactionId = null)
    {
        $this->originalTransactionId = $originalTransactionId;
    }

    public function getOriginalTransactionId()
    {
        return $this->originalTransactionId;
    }

    public function setCancellation($cancellation = null)
    {
        $this->cancellation = new Cancellation($cancellation);
    }

    public function getCancellation(): Cancellation
    {
        return $this->cancellation;
    }

    public function setCustomParameters($customParameters = null)
    {
        $this->customParameters = $customParameters;
    }

    public function getCustomParameters()
    {
        return $this->customParameters;
    }
}
