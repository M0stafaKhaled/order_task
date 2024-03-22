<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\AuthApiRequest;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    use ResponseTrait;
    public function login(AuthApiRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
         return $this->makeResponse(
             []
             , 'Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return $this->makeResponse(
            []
            , 'User logged out successfully', 200);
    }

    private function respondWithToken($token): \Illuminate\Http\JsonResponse
    {
        return $this->makeResponse(
            ['access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60]
            , 'User logged in successfully', 200);
    }
}
