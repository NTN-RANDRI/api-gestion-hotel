<?php

namespace App\Application\UseCases\Auth;

use App\Application\Services\TokenServiceInterface;
use App\Domain\Repositories\UserRepositoryInterface;

class Login
{

    public function __construct(
        private UserRepositoryInterface $userRepo,
        private TokenServiceInterface $tokenService,
    )
    {}

    public function execute(string $email, string $password): ?string
    {
        $user = $this->userRepo->findByEmail($email);

        if (!$user || !password_verify($password, $user->getPassword())) {
            return null;
        }

        return $this->tokenService->createToken($user);
    }

}