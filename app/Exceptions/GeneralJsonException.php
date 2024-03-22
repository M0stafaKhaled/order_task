<?php

namespace App\Exceptions;

use Exception;

class GeneralJsonException extends Exception
{
    protected $code = 400;

    public function __construct($message, $code = 400)
    {
        parent::__construct($message);
        $this->code = $code;
    }

    public function render($request)
    {
        return response()->json([
            'status' => $this->code,
            'message' => $this->getMessage(),
            'data' => null
        ], $this->code);
    }
}
