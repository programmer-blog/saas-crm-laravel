<?php
require_once 'Repositories/InMemoryUserRepository.php';
require_once 'Services/AuthService.php';

$repo = new InMemoryUserRepository();
$authService = new AuthService($repo);

$result = $authService->login("test@test.com", "123456");

$result = $authService->register("newuser@example.com", "password123");

$result = $authService->getAllUsers();

var_dump($result);