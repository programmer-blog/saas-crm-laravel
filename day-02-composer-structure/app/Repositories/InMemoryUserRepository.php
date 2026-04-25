<?php

namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;


class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function __construct()
    {
        $this->users[] = new User(1, "test@test.com", "123456");
    }

    public function findByEmail(string $email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->email === $email) {
                return $user;
            }
        }
        return null;
    }

    public function register(string $email, string $password): ?User
    {
        if ($this->findByEmail($email)) {
            return null;
        }

        $user = new User(
            count($this->users) + 1,
            $email,
            password_hash($password, PASSWORD_DEFAULT)
        );

        $this->users[] = $user;
        return $user;
    }

    public function getAllUsers(): array
    {
        return $this->users;
    }
}