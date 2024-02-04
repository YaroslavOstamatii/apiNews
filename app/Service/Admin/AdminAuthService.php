<?php

namespace App\Service\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AdminAuthService
{
    public function registerAdmin(array $data): Admin
    {
        $data['password'] = Hash::make($data['password']);

        return new Admin($data);
    }

public function loginAdmin(array $data): array
    {

        $admin = Admin::where('email', $data['email'])->first();

        if(!$admin || !password_verify($data['password'], $admin->password)){
            throw new UnauthorizedException('Incorrect login details');
        }
        $token = $admin->createToken('token-admin')->plainTextToken;

        return ['admin' => $admin, 'token' => $token];
    }
    public function logoutAdmin($request): void
    {
        $request->user()->tokens()->delete();
    }
}
