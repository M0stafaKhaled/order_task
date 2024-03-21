<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\Api\RegisterApiRequest;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class RegisterApiController extends Controller
{
    use ResponseTrait;

    public function __invoke(RegisterApiRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);


        event(new UserRegistered($user));

        return $this->makeResponse(
            ['user' => $user]
            , 'User registered successfully', 200);
    }
}
