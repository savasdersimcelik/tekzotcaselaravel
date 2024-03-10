<?php

namespace App\Libraries\Zotlo\Request;

use App\Enums\CountryEnum;
use App\Enums\PlatformEnum;

class PaymentRequest
{
    private $cardNo = null;
    private $cardOwner = null;
    private $expireMonth = null;
    private $expireYear = null;
    private $cvv = null;
    private $language = null;
    private $packageId = null;
    private $packageCountry = null;
    private $platform = null;
    private $cardToken = null;
    private $subscriberPhoneNumber = null;
    private $subscriberFirstname = null;
    private $subscriberLastname = null;
    private $subscriberEmail = null;
    private $subscriberId = null;
    private $subscriberIpAddress = null;
    private $subscriberCountry = null;
    private $transactionSource = null;
    private $installment = 1;
    private $quantity = 1;
    private $force3ds = 0;
    private $useWallet = false;
    private $discountPercent = 0;
    private $redirectUrl = null;
    private $customParameters = null;

    public function setCardNo($cardNo = null)
    {
        $this->cardNo = $cardNo;
    }

    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function setCardOwner($cardOwner = null)
    {
        $this->cardOwner = $cardOwner;
    }

    public function getCardOwner()
    {
        return $this->cardOwner;
    }

    public function setExpireMonth($expireMonth = null)
    {
        $this->expireMonth = $expireMonth;
    }

    public function getExpireMonth()
    {
        return $this->expireMonth;
    }

    public function setExpireYear($expireYear = null)
    {
        $this->expireYear = $expireYear;
    }

    public function getExpireYear()
    {
        return $this->expireYear;
    }

    public function setCvv($cvv = null)
    {
        $this->cvv = $cvv;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setLanguage($language = null)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language ?? CountryEnum::TR->value;
    }

    public function setPackageId($packageId = null)
    {
        $this->packageId = $packageId;
    }

    public function getPackageId()
    {
        return $this->packageId;
    }

    public function setPackageCountry($packageCountry = null)
    {
        $this->packageCountry = $packageCountry;
    }

    public function getPackageCountry()
    {
        return $this->packageCountry ?? CountryEnum::TR->value;
    }

    public function setPlatform($platform = null)
    {
        $this->platform = $platform;
    }

    public function getPlatform()
    {
        return $this->platform ?? PlatformEnum::IOS->value;
    }

    public function setCardToken($cardToken = null)
    {
        $this->cardToken = $cardToken;
    }

    public function getCardToken()
    {
        return $this->cardToken;
    }

    public function setSubscriberPhoneNumber($subscriberPhoneNumber = null)
    {
        $this->subscriberPhoneNumber = $subscriberPhoneNumber;
    }

    public function getSubscriberPhoneNumber()
    {
        return $this->subscriberPhoneNumber;
    }

    public function setSubscriberFirstname($subscriberFirstname = null)
    {
        $this->subscriberFirstname = $subscriberFirstname;
    }

    public function getSubscriberFirstname()
    {
        return $this->subscriberFirstname;
    }

    public function setSubscriberLastname($subscriberLastname = null)
    {
        $this->subscriberLastname = $subscriberLastname;
    }

    public function getSubscriberLastname()
    {
        return $this->subscriberLastname;
    }

    public function setSubscriberEmail($subscriberEmail = null)
    {
        $this->subscriberEmail = $subscriberEmail;
    }

    public function getSubscriberEmail()
    {
        return $this->subscriberEmail;
    }

    public function setSubscriberId($subscriberId = null)
    {
        $this->subscriberId = $subscriberId;
    }

    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    public function setSubscriberIpAddress($subscriberIpAddress = null)
    {
        $this->subscriberIpAddress = $subscriberIpAddress;
    }

    public function getSubscriberIpAddress()
    {
        return $this->subscriberIpAddress ?? "176.234.132.188";
    }

    public function setSubscriberCountry($subscriberCountry = null)
    {
        $this->subscriberCountry = $subscriberCountry;
    }

    public function getSubscriberCountry()
    {
        return $this->subscriberCountry ?? CountryEnum::TR->value;
    }

    public function setTransactionSource($transactionSource = null)
    {
        $this->transactionSource = $transactionSource;
    }

    public function getTransactionSource()
    {
        return $this->transactionSource;
    }

    public function setInstallment($installment = null)
    {
        $this->installment = $installment;
    }

    public function getInstallment()
    {
        return $this->installment;
    }

    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setForce3ds($force3ds = null)
    {
        $this->force3ds = $force3ds;
    }

    public function getForce3ds()
    {
        return $this->force3ds;
    }

    public function setUseWallet($useWallet = null)
    {
        $this->useWallet = $useWallet;
    }

    public function getUseWallet()
    {
        return $this->useWallet;
    }

    public function setDiscountPercent($discountPercent = null)
    {
        $this->discountPercent = $discountPercent;
    }

    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    public function setRedirectUrl($redirectUrl = null)
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    public function setCustomParameters($customParameters = null)
    {
        $this->customParameters = $customParameters;
    }

    public function getCustomParameters()
    {
        return $this->customParameters ?? [];
    }
}
