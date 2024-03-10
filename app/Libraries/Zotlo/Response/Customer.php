<?php

namespace App\Libraries\Zotlo\Response;

class Customer
{
    private $id = null;
    private $createDate = null;
    private $country = null;
    private $firstname = null;
    private $lastname = null;
    private $email = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setId($data["id"] ?? null);
            $this->setCreateDate($data["createDate"] ?? null);
            $this->setCountry($data["country"] ?? null);
            $this->setFirstname($data["firstname"] ?? null);
            $this->setLastname($data["lastname"] ?? null);
            $this->setEmail($data["email"] ?? null);
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

    public function setCreateDate($createDate = null)
    {
        $this->createDate = $createDate;
    }

    public function getCreateDate()
    {
        return $this->createDate;
    }

    public function setCountry($country = null)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setFirstname($firstname = null)
    {
        $this->firstname = $firstname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setEmail($email = null)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
