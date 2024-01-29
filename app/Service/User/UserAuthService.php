<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    public function registerUser(array $data): User
    {
        $data['password']=Hash::make($data['password']);
        $user=User::create($data);
        return $user;
    }

public function loginUser(array $data):JsonResponse
    {
        $user=User::where('email',$data['email'])->first();

        if(!$user || !password_verify($data['password'],$user->password)){
            return response()->json(['message'=>'incorrect login details'],401);
        }
        $token=$user->createToken('token-name')->plainTextToken;
        return response()->json(['user'=>$user, 'token'=>$token], 200);
    }
    public function deleteUser(User $user):void
    {
        $user->delete();
    }
}
