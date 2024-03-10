<?php

namespace App\Libraries\Zotlo\Response;

class Card
{
    private $id = null;
    private $token = null;
    private $cardNumber = null;
    private $cardExpire = null;
    private $createDate = null;
    private $tokenType = null;
    private $deletable = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setId($data["id"] ?? null);
            $this->setToken($data["token"] ?? null);
            $this->setCardNumber($data["cardNumber"] ?? null);
            $this->setCardExpire($data["cardExpire"] ?? null);
            $this->setCreateDate($data["createDate"] ?? null);
            $this->setTokenType($data["tokenType"] ?? null);
            $this->setDeletable($data["deletable"] ?? null);
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

    public function setToken($token = null)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setCardNumber($cardNumber = null)
    {
        $this->cardNumber = $cardNumber;
    }

    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    public function setCardExpire($cardExpire = null)
    {
        $this->cardExpire = $cardExpire;
    }

    public function getCardExpire()
    {
        return $this->cardExpire;
    }

    public function setCreateDate($createDate = null)
    {
        $this->createDate = $createDate;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setTokenType($tokenType = null)
    {
        $this->tokenType = $tokenType;
    }

    public function getTokenType()
    {
        return $this->tokenType;
    }

    public function setDeletable($deletable = null)
    {
        $this->deletable = $deletable;
    }

    public function getDeletable()
    {
        return $this->deletable;
    }
}
