<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{

    public static function success(mixed $data = null, string $message = "Succès", int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'status' => $status,
            'message' => $message,
            'timestamp' => now()->toISOString(),
        ], $status);
    }

    public static function crudSuccess(string $action, string $resource, mixed $data = null): JsonResponse
    {
        $messages = [
            'create' => ucfirst($resource) . " créé avec succès",
            'read'   => ucfirst($resource) . " récupéré avec succès",
            'list'   => "Liste des " . mb_strtolower($resource) . "s",
            'update' => ucfirst($resource) . " mis à jour avec succès",
            'delete' => ucfirst($resource) . " supprimé avec succès",
        ];

        $statusCodes = [
            'create' => 201,
            'read'   => 200,
            'list'   => 200,
            'update' => 200,
            'delete' => 200,
        ];

        $message = $messages[$action] ?? "Opération réussie";
        $status  = $statusCodes[$action] ?? 200;

        return self::success($data, $message, $status);
    }

    public static function error(
        mixed $errors = [],
        string $message = "Erreur",
        int $status = 500,
        \Throwable $exception
    ): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => [
                'status' => $status,
                'message' => $message,
                'errors' => $errors,
                'type' => class_basename($exception),
                'timestamp' => now()->toISOString(),
            ]
        ], $status);
    }
}