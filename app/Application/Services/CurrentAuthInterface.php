<?php

namespace App\Application\Services;

interface CurrentAuthInterface
{
    public function id(): int;
    public function role(): string;
    public function userableId(): int;
}