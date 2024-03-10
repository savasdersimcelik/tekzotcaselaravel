<?php

namespace App\Http\Controllers;

use App\Libraries\Zotlo\CreditCard;
use App\Libraries\Zotlo\Request\CardRequest;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        try {
            $cardRequest = new CardRequest();
            $cardRequest->setSubscriberId(Auth::id());

            $card = new CreditCard($cardRequest);

            return response()->json([
                'result' => $card->getCardList()
            ], Response::HTTP_OK);

        } catch (RequestException $exception) {
            $body = json_decode($exception->getResponse()->getBody()->getContents());
            return response()->json([
                'message' => $body->meta->errorMessage
            ], $exception->getCode());
        }
    }
}
