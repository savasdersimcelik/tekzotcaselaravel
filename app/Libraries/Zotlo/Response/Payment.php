<?php

namespace App\Libraries\Zotlo\Response;

class Payment
{
    private $isSuccess = false;
    private $transactionId = null;
    private $providerTransactionId = null;
    private $customTransactionId = null;
    private $statusCode = null;
    private $statusMessage = null;
    private $paymentDate = null;
    private $providerStatus = null;
    private $paymentStatus = null;
    private $redirectUrl = null;
    private $paymentProvider = null;
    private $packageId = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setIsSuccess($data["isSuccess"] ?? false);
            $this->setTransactionId($data["transactionId"] ?? null);
            $this->setProviderTransactionId($data["providerTransactionId"] ?? null);
            $this->setCustomTransactionId($data["customTransactionId"] ?? null);
            $this->setStatusCode($data["statusCode"] ?? null);
            $this->setStatusMessage($data["statusMessage"] ?? null);
            $this->setPaymentDate($data["paymentDate"] ?? null);
            $this->setProviderStatus($data["providerStatus"] ?? null);
            $this->setPaymentStatus($data["paymentStatus"] ?? null);
            $this->setRedirectUrl($data["redirectUrl"] ?? null);
            $this->setPaymentProvider($data["paymentProvider"] ?? null);
            $this->setPackageId($data["packageId"] ?? null);
        }
    }

    public function setIsSuccess($isSuccess = null)
    {
        $this->isSuccess = $isSuccess;
    }

    public function getIsSuccess()
    {
        return $this->isSuccess;
    }

    public function isSuccess()
    {
        return $this->isSuccess;
    }

    public function setTransactionId($transactionId = null)
    {
        $this->transactionId = $transactionId;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function setProviderTransactionId($providerTransactionId = null)
    {
        $this->providerTransactionId = $providerTransactionId;
    }

    public function getProviderTransactionId()
    {
        return $this->providerTransactionId;
    }

    public function setCustomTransactionId($customTransactionId = null)
    {
        $this->customTransactionId = $customTransactionId;
    }

    public function getCustomTransactionId()
    {
        return $this->customTransactionId;
    }

    public function setStatusCode($statusCode = null)
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusMessage($statusMessage = null)
    {
        $this->statusMessage = $statusMessage;
    }

    public function getStatusMessage()
    {
        return $this->statusMessage;
    }

    public function setPaymentDate($paymentDate = null)
    {
        $this->paymentDate = $paymentDate;
    }

    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    public function setProviderStatus($providerStatus = null)
    {
        $this->providerStatus = $providerStatus;
    }

    public function getProviderStatus()
    {
        return $this->providerStatus;
    }

    public function setPaymentStatus($paymentStatus = null)
    {
        $this->paymentStatus = $paymentStatus;
    }

    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    public function setRedirectUrl($redirectUrl = null)
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function setPaymentProvider($paymentProvider = null)
    {
        $this->paymentProvider = $paymentProvider;
    }

    public function getPaymentProvider()
    {
        return $this->paymentProvider;
    }

    public function setPackageId($packageId = null)
    {
        $this->packageId = $packageId;
    }

    public function getPackageId()
    {
        return $this->packageId;
    }
}
