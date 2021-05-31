<?php


namespace App\Http\Responses;


class ResponseCode
{
    // Error codes
    const ERROR = 0;
    const MAINTAIN_MODE = -1;
    const UNAUTHENTICATED = -2;
    const VALIDATION_ERROR = -3;

    // Success codes
    const SUCCESS = 1;
}