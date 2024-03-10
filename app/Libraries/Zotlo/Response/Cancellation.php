<?php

namespace App\Libraries\Zotlo\Response;

class Cancellation
{
    private $date = null;
    private $reason = null;
    private $code = null;

    public function __construct($data = null)
    {
        if ($data) {
            $this->setDate($data["date"] ?? null);
            $this->setReason($data["reason"] ?? null);
            $this->setCode($data["code"] ?? null);
        }
    }

    public function setDate($date = null)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setReason($reason = null)
    {
        $this->reason = $reason;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setCode($code = null)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }
}
