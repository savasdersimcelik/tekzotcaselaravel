<?php

namespace App\Libraries\Zotlo;

use App\Libraries\Zotlo\Response\Meta;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class Config
{
    protected Client $client;
    protected $response;
    protected $body;
    protected $result;
    protected $meta;
    protected $statusCode;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://test-api.zotlo.com/v1/',
            RequestOptions::HEADERS => config('services.jotlo'),
        ]);
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse($response): void
    {
        $this->response = $response;
        $this->setStatusCode($response->getStatusCode());
        $this->setBody(json_decode($this->response->getBody()->getContents(), true));
        $this->setResult($this->body['result']);
        $this->setMeta($this->body['meta']);
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result): void
    {
        $this->result = $result;
    }

    public function setMeta($meta): void
    {
        $this->meta = new Meta($meta);
    }

    public function getMeta(): Meta
    {
        return $this->meta;
    }

    public function setStatusCode($statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
