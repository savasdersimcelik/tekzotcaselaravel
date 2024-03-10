<?php

namespace App\Libraries\Zotlo;

use App\Libraries\Zotlo\Request\CardRequest;
use App\Libraries\Zotlo\Response\Card;
use GuzzleHttp\RequestOptions;

class CreditCard extends Config
{
    private CardRequest $cardRequest;

    public function __construct(CardRequest $cardRequest)
    {
        parent::__construct();
        $this->cardRequest = $cardRequest;
    }

    public function getCardList(){
        $response = $this->client->request('GET', 'subscription/card-list', [
            RequestOptions::QUERY => [
                'subscriberId' => $this->cardRequest->getSubscriberId(),
            ]
        ]);
        $this->setResponse($response);
        return $this->result['cardList'] ?? [];
    }
}
