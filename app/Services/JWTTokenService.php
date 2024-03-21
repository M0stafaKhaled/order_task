<?php

namespace App\Services;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTTokenService implements TokenServiceInterface
{
    /**
     * Generate a JWT token for a user.
     *
     * @param  User  $user
     * @return string
     */
    public function createForUser(User $user): string
    {
        return JWTAuth::fromUser($user);
    }
}
