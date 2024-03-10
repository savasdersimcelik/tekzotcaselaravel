<?php

namespace App\Libraries\Zotlo;

use App\Libraries\Zotlo\Request\CardRequest;
use App\Libraries\Zotlo\Response\Card;
use GuzzleHttp\RequestOptions;

class Package extends Config
{
    public function getPackageList(){
        $response = $this->client->request('GET', 'team/package');
        $this->setResponse($response);
        return $this->result['packages'] ?? [];
    }
}
