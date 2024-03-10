<?php

namespace App\Libraries\Zotlo;

use App\Libraries\Zotlo\Request\PaymentRequest;
use App\Libraries\Zotlo\Response\Customer;
use App\Libraries\Zotlo\Response\Package;
use GuzzleHttp\RequestOptions;

class Payment extends Config
{
    private PaymentRequest $paymentRequest;
    private \App\Libraries\Zotlo\Response\Profile $profile;
    private Package $package;
    private Package $newPackage;
    private Customer $customer;
    private \App\Libraries\Zotlo\Response\Payment $payment;

    public function __construct(PaymentRequest $paymentRequest)
    {
        parent::__construct();
        $this->paymentRequest = $paymentRequest;
    }

    public function request(){
        $response = $this->client->request('POST', 'payment/credit-card', [
            RequestOptions::JSON =>  [
                "cardNo" => $this->paymentRequest->getCardNo(),
                "cardOwner" => $this->paymentRequest->getCardOwner(),
                "expireMonth" => $this->paymentRequest->getExpireMonth(),
                "expireYear" => $this->paymentRequest->getExpireYear(),
                "cvv" => $this->paymentRequest->getCvv(),
                "language" => $this->paymentRequest->getLanguage(),
                "packageId" => $this->paymentRequest->getPackageId(),
                "packageCountry" => $this->paymentRequest->getPackageCountry(),
                "platform" => $this->paymentRequest->getPlatform(),
                "cardToken" => $this->paymentRequest->getCardToken(),
                "subscriberPhoneNumber" => $this->paymentRequest->getSubscriberPhoneNumber(),
                "subscriberFirstname" => $this->paymentRequest->getSubscriberFirstname(),
                "subscriberLastname" => $this->paymentRequest->getSubscriberLastname(),
                "subscriberEmail" => $this->paymentRequest->getSubscriberEmail(),
                "subscriberId" => $this->paymentRequest->getSubscriberId(),
                "subscriberIpAddress" => $this->paymentRequest->getSubscriberIpAddress(),
                "subscriberCountry" => $this->paymentRequest->getSubscriberCountry(),
                "transactionSource" => $this->paymentRequest->getTransactionSource(),
                "installment" => $this->paymentRequest->getInstallment(),
                "quantity" => $this->paymentRequest->getQuantity(),
                "force3ds" => $this->paymentRequest->getForce3ds(),
                "useWallet" => $this->paymentRequest->getUseWallet(),
                "discountPercent" => $this->paymentRequest->getDiscountPercent(),
                "redirectUrl" => $this->paymentRequest->getRedirectUrl(),
                "customParameters" => $this->paymentRequest->getCustomParameters(),
            ]
        ]);
        $this->setResponse($response);
        $this->setProfile($this->result['profile'] ?? []);
        $this->setPackage($this->result['package'] ?? []);
        $this->setNewPackage($this->result['newPackage'] ?? []);
        $this->setCustomer($this->result['customer'] ?? []);
        $this->setPayment($this->result['response'] ?? []);
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

    public function setPayment($payment): void
    {
        $this->payment = new \App\Libraries\Zotlo\Response\Payment($payment);
    }

    public function getPayment(): Response\Payment
    {
        return $this->payment;
    }
}
