<?php

namespace App\Exceptions;

use App\Http\Responses\APIResponse;
use Exception;

class ResponseException extends Exception
{
    public function render($request)
    {
        if (expectsJson()) {
            return APIResponse::fail(null, $this->getMessage());
        }
    }
}
