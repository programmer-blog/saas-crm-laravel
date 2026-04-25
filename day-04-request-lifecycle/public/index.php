<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\UserController;

$router = new Router();
$router->middleware(\App\Middleware\AuthMiddleware::class);
$router->get('/users', [UserController::class, 'index']);

// simulate request
$response = $router->dispatch('GET', '/users');

var_dump($response);