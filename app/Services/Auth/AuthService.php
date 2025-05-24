<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login(array $credentials): string
    {
        if (!auth()->attempt($credentials)) {
            throw new \Exception('Invalid credentials');
        }

        return auth()->user()->createToken('auth_token')->plainTextToken;
    }
}
