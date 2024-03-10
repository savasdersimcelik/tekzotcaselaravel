<?php

namespace App\Libraries\Zotlo\Response;

class Meta
{
    private $requestId = null;
    private $httpStatus = null;

    public function __construct($data)
    {
        if ($data){
            $this->setRequestId($result['requestId'] ?? null);
            $this->setHttpStatus($result['httpStatus'] ?? null);
        }
    }

    public function setRequestId(mixed $requestId): void
    {
        $this->requestId = $requestId;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setHttpStatus(mixed $httpStatus): void
    {
        $this->httpStatus = $httpStatus;
    }

    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

}
