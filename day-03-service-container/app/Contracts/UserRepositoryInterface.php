<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function register(string $email, string $password): ?User;

    public function getAllUsers(): array;
}