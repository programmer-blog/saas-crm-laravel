<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function register(Request $request)
    {
        $user = $this->authService->register($request->all());

        return response()->json([
            'message' => 'User registered',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $user = $this->authService->login($request->all());

        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ]);
    }
}
