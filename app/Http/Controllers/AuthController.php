<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Auth\GetAuthByUserable;
use App\Application\UseCases\Auth\Login;
use App\Application\UseCases\Auth\RegisterClient;
use App\Application\UseCases\Auth\RegisterPersonnel;
use App\Http\Mappers\ClientHttpMapper;
use App\Http\Mappers\PersonnelHttpMapper;
use App\Http\Mappers\UserHttpMapper;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterClientRequest;
use App\Http\Requests\Auth\RegisterPersonnelRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function __construct(
        private Login $login,
        private RegisterClient $registerClientUseCase,
        private RegisterPersonnel $registerPersonnelUseCase,
        private GetAuthByUserable $getAuthByUserable,
    )
    {}

    public function auth(Request $request): JsonResponse 
    {
        $auth = $request->user();

        $output = $this->getAuthByUserable->execute($auth->userable_id, class_basename($auth->userable_type));

        return ApiResponse::success($output);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $token = $this->login->execute($validated['email'], $validated['password']);

        if (!$token) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function registerClient(RegisterClientRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $clientInput = ClientHttpMapper::toDTO($validated['client']);
        $userInput = UserHttpMapper::toDTO($validated['user']);

        $clientOutput = $this->registerClientUseCase->execute($clientInput, $userInput);

        return ApiResponse::success($clientOutput, 'Register Client Success');
    }

    public function RegisterPersonnel(RegisterPersonnelRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $personnelInput = PersonnelHttpMapper::toDTO($validated['personnel']);
        $userInput = UserHttpMapper::toDTO($validated['user']);

        $personnelOutput = $this->registerPersonnelUseCase->execute($personnelInput, $userInput);

        return ApiResponse::success($personnelOutput, 'Register Personnel Success');
    }

}
