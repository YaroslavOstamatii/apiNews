<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
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
    public function deleteUser(User $user):void
    {
        $user->delete();
    }
}
