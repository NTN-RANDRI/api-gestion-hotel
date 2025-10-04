<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AppException $e) {
            return ApiResponse::error(
                errors: [],
                message: $e->getMessage(),
                status: $e->getStatusCode(),
                exception: $e
            );
        });

        $this->renderable(function (ValidationException $e) {
            return ApiResponse::error(
                errors: $e->errors(),
                message: $e->getMessage(),
                status: 422,
                exception: $e
            );
        });
    }
}
