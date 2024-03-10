<?php

namespace App\Http\Controllers;

use App\Libraries\Zotlo\Profile;
use App\Libraries\Zotlo\Request\ProfileRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test(){
//        $profileRequest = new ProfileRequest();
//        $profileRequest->setSubscriberId(Auth::id());
//        $profileRequest->setPackageId('zotlo.premium');
//
//        $profile = new Profile($profileRequest);
//        $request = $profile->request();
//
//        print_r($request->getNewPackage());


        $jayParsedAry = [
            "id" => 9189,
            "token" => "MGl2dk44eWVSbU5KMDAxZG1NMVhhTGhyazJNaDlJQndaU1pya1lodFpJVFJUVytjS1krbSsvOGdEanNVYjQ2Tg==",
            "cardNumber" => "41111111****1111",
            "cardExpire" => "11/27",
            "createDate" => "2024-01-08 12:58:33",
            "tokenType" => "creditCard",
            "deletable" => true
        ];


        $text = '';

        foreach ($jayParsedAry as $item => $value){
            $text = $text. 'private $'.$item.' = null;';
        }

        $text = $text. 'public function __construct($data = null)
    {
        if ($data){';
        foreach ($jayParsedAry as $item => $value){
            $text = $text. '$this->'.$this->generatorEntitySetFuncName($item).'($data["'.$item.'"] ?? null);';
        }
        $text = $text. '}
    }';

        foreach ($jayParsedAry as $item => $value){
            $text = $text. 'public function '.$this->generatorEntitySetFuncName($item).'($'.$item.' = null){$this->'.$item.' = $'.$item.';}';
            $text = $text. 'public function '.$this->generatorEntityGetFuncName($item).'(){return $this->'.$item.';}';
        }

        print_r($text);
    }

    function generatorEntitySetFuncName($column){
        return 'set'.ucfirst(preg_replace_callback("/_[a-z]?/",function ($column){
                return ucfirst(strtoupper(ltrim($column[0], "_")));
            },$column));
    }

    function generatorEntityGetFuncName($column){
        return 'get'.ucfirst(preg_replace_callback("/_[a-z]?/",function ($column){
                return ucfirst(strtoupper(ltrim($column[0], "_")));
            },$column));
    }

    function generatorEntityFunctionName($matches) {
        return ucfirst(strtoupper(ltrim($matches[0], "_")));
    }
}
