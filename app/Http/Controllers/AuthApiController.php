<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\AuthApiRequest;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    use ResponseTrait;
    public function __invoke(AuthApiRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::guard('api')->attempt($credentials)) {
         return $this->makeResponse(
             []
             , 'Unauthorized', 401);
        }

        return $this->respondWithToken($token);
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
