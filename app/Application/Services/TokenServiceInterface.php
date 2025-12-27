<?php

namespace App\Application\Services;

use App\Domain\Entities\User;

interface TokenServiceInterface
{
    public function createToken(User $user): string;
}