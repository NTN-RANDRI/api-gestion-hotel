<?php

namespace App\Infrastructure\Services;

use App\Application\Services\CurrentAuthInterface;
use Illuminate\Support\Facades\Auth;

class LaravelAuthService implements CurrentAuthInterface
{
    private function user()
    {
        $user = Auth::user();

        if (!$user) {
            throw new \RuntimeException('Unauthenticated user');
        }

        return $user;
    }

    public function id(): int
    {
        return $this->user()->id;
    }

    public function role(): string
    {
        return class_basename($this->user()->userable_type);
    }

    public function userableId(): int
    {
        return $this->user()->userable_id;
    }
}