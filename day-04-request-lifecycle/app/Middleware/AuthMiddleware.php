<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle(): bool
    {
        // fake check
        return true;
    }
}