<?php

namespace App\Services\Auth;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $data): User;
    public function login(array $credentials): string;
}
