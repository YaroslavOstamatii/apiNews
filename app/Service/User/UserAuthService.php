<?php

namespace App\Service\User;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UserAuthService
{
    public function registerUser(RegisterUserRequest $request): User
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function loginUser(LoginUserRequest $request): array
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new UnauthorizedException('Incorrect login details');
        }
        $token = $user->createToken('token-user')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function logoutUser($request): void
    {
        $request->user()->tokens()->delete();
    }
}
