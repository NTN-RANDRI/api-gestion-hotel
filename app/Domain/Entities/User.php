<?php

namespace App\Domain\Entities;

class User
{

    public function __construct(
        private ?int $id,
        private string $email,
        private string $password,
    )
    {}

    // GETTERS
    public function getId(): int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }

}