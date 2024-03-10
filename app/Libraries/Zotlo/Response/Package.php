<?php

namespace App\Libraries\Zotlo\Response;

class Package
{
    private $id = null;
    private $packageId = null;
    private $name = null;
    private $packageType = null;
    private $period = null;
    private $trialPeriod = null;
    private $price = null;
    private $trialPrice = null;
    private $currency = null;
    private $status = null;
    private $providerId = null;
    private $prices = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setId($data["id"] ?? null);
            $this->setPackageId($data["packageId"] ?? null);
            $this->setName($data["name"] ?? null);
            $this->setPackageType($data["packageType"] ?? null);
            $this->setPeriod($data["period"] ?? null);
            $this->setTrialPeriod($data["trialPeriod"] ?? null);
            $this->setPrice($data["price"] ?? null);
            $this->setTrialPrice($data["trialPrice"] ?? null);
            $this->setCurrency($data["currency"] ?? null);
            $this->setStatus($data["status"] ?? null);
            $this->setProviderId($data["providerId"] ?? null);
            $this->setPrices($data["prices"] ?? null);
        }
    }

    public function setId($id = null)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPackageId($packageId = null)
    {
        $this->packageId = $packageId;
    }

    public function getPackageId()
    {
        return $this->packageId;
    }

    public function setName($name = null)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPackageType($packageType = null)
    {
        $this->packageType = $packageType;
    }

    public function getPackageType()
    {
        return $this->packageType;
    }

    public function setPeriod($period = null)
    {
        $this->period = $period;
    }

    public function getPeriod()
    {
        return $this->period;
    }

    public function setTrialPeriod($trialPeriod = null)
    {
        $this->trialPeriod = $trialPeriod;
    }

    public function getTrialPeriod()
    {
        return $this->trialPeriod;
    }

    public function setPrice($price = null)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setTrialPrice($trialPrice = null)
    {
        $this->trialPrice = $trialPrice;
    }

    public function getTrialPrice()
    {
        return $this->trialPrice;
    }

    public function setCurrency($currency = null)
    {
        $this->currency = $currency;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setStatus($status = null)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setProviderId($providerId = null)
    {
        $this->providerId = $providerId;
    }

    public function getProviderId()
    {
        return $this->providerId;
    }

    public function setPrices($prices = null)
    {
        $this->prices = $prices;
    }

    public function getPrices()
    {
        return $this->prices;
    }
}
