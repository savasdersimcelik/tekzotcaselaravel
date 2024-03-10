<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "email" => ['required', 'email'],
            "password" => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $token = JWTAuth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if (!empty($token)) {
            return response()->json([
                "status" => true,
                "message" => "Giriş işlemi başarılı",
                "token" => $token
            ], Response::HTTP_OK);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ], Response::HTTP_BAD_REQUEST);

    }

    public function refreshToken()
    {
        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "Yeni token üretildi",
            "token" => $newToken,
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            "status" => true,
            "message" => "Çıkış yapıldı"
        ]);
    }
}
