<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class UserAuthService
{
    public function registerUser(array $data): User
    {
        $data['password']=Hash::make($data['password']);
        $user=User::create($data);
        return $user;
    }

public function loginUser(array $data)
    {
        $user=User::where('email',$data['email'])->first();

        if(!$user || !password_verify($data['password'],$user->password)){
            throw new UnauthorizedException('Incorrect login details');
        }
        $token=$user->createToken('token-name')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }
    public function logoutUser($request):void
    {
        $request->user()->tokens()->delete();
    }
}
