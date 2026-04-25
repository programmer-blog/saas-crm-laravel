<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Repositories\InMemoryUserRepository;

class UserController
{
    private AuthService $authService;

    public function __construct()
    {
        $repo = new InMemoryUserRepository();
        $this->authService = new AuthService($repo);
    }

    public function index()
    {
        return $this->authService->getAllUsers();
    }
}