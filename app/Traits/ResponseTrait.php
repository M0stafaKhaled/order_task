<?php

namespace App\Traits;

trait ResponseTrait
{

    public function makeResponse($data, $message = '', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
    public function makeError($message, $status = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => null
        ], $status);
    }
}
