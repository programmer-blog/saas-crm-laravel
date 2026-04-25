<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Repositories\InMemoryUserRepository;
use App\Services\AuthService;

$repo = new InMemoryUserRepository();
$auth = new AuthService($repo);

// login
var_dump($auth->login("test@test.com", "123456"));

// register
var_dump($auth->register("new@test.com", "password123"));

// get all users (IMPORTANT: no password exposed yet conceptually)
var_dump($auth->getAllUsers());