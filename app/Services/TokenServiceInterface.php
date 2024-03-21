<?php

namespace App\Services;

use App\Models\User;

interface TokenServiceInterface
{
public function createForUser(User $user): string;
}
