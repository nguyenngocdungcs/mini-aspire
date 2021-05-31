<?php

namespace App\Exceptions;

use App\Http\Responses\APIResponse;
use App\Http\Responses\ResponseCode;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function prepareJsonResponse($request, Exception $e)
    {
        if ($e instanceof MaintenanceModeException) {
            return APIResponse::fail(
                null,
                'System is in Maintenance Mode. Try again later!',
                ResponseCode::MAINTAIN_MODE
            );
        }

        if ($e instanceof UnauthorizedHttpException) {
            return APIResponse::unauthenticated();
        }

        return APIResponse::error($e);
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return APIResponse::fail(
            ['errors' => $exception->errors()],
            'The given data was invalid',
            ResponseCode::VALIDATION_ERROR
        );
    }
}
