<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserApiController extends Controller
{
    public function profile()
    {
        return response()->json(auth()->user());
    }
}
