<?php

namespace App\Http\Controllers;

use App\Libraries\Zotlo\Package;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;

class PackageController extends Controller
{
    public function index()
    {
        try {
            $package = new Package();
            return response()->json([
                'result' => $package->getPackageList()
            ], Response::HTTP_OK);

        } catch (RequestException $exception) {
            $body = json_decode($exception->getResponse()->getBody()->getContents());
            return response()->json([
                'message' => $body->meta->errorMessage
            ], $exception->getCode());
        }
    }
}
