<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpFoundation\Response;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof TokenBlacklistedException) {
                return response(['error' => 'Token can not be used, get a new one'], Response::HTTP_BAD_REQUEST);
            } else if ($e instanceof TokenInvalidException) {
                return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
            } else if ($e instanceof TokenExpiredException) {
                return response(['error' => 'Token expired'], Response::HTTP_BAD_REQUEST);
            } else if ($e instanceof JWTException) {
                return response(['error' => 'Token is not provided'], Response::HTTP_BAD_REQUEST);
            }
        });
    }
}
