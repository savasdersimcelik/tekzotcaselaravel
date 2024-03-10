<?php

namespace App\Libraries\Zotlo;

use App\Libraries\Zotlo\Response\Customer;
use App\Libraries\Zotlo\Response\Package;
use App\Libraries\Zotlo\Request\CancelRequest;
use App\Libraries\Zotlo\Request\ProfileRequest;
use GuzzleHttp\RequestOptions;

class Profile extends Config
{
    private ProfileRequest $profileRequest;
    private \App\Libraries\Zotlo\Response\Profile $profile;
    private Package $package;
    private Package $newPackage;
    private Customer $customer;

    public function __construct(ProfileRequest $profileRequest)
    {
        parent::__construct();
        $this->profileRequest = $profileRequest;
    }

    public function request(){
        $response = $this->client->request('GET', 'subscription/profile', [
            RequestOptions::QUERY => [
                'subscriberId' => $this->profileRequest->getSubscriberId(),
                'packageId' => $this->profileRequest->getPackageId(),
            ]
        ]);
        $this->setResponse($response);
        $this->setProfile($this->result['profile'] ?? []);
        $this->setPackage($this->result['package'] ?? []);
        $this->setNewPackage($this->result['newPackage'] ?? []);
        $this->setCustomer($this->result['customer'] ?? []);
        return $this;
    }

    public function setProfile($profile): void
    {
        $this->profile = new \App\Libraries\Zotlo\Response\Profile($profile);
    }

    public function getProfile(): Response\Profile
    {
        return $this->profile;
    }

    public function setPackage($package): void
    {
        $this->package = new Package($package);
    }

    public function getPackage(): Package
    {
        return $this->package;
    }

    public function setNewPackage($newPackage): void
    {
        $this->newPackage = new Package($newPackage);
    }

    public function getNewPackage(): Package
    {
        return $this->newPackage;
    }

    public function setCustomer($customer): void
    {
        $this->customer = new Customer($customer);
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
