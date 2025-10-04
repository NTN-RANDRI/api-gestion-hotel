<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class AppException extends Exception
{
    protected int $statusCode = 500;

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function toArray(): array
    {
        return [
            'success' => false,
            'error' => [
                'status' => $this->statusCode,
                'message' => $this->getMessage(),
                'type' => class_basename($this),
                'timestamp' => now()->toISOString()
            ]
        ];
    }

    public function toResponse(): JsonResponse
    {
        return response()->json($this->toArray(), $this->getStatusCode());
    }

}
