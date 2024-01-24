<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data):User
    {
        $data['password']=Hash::make($data['password']);
        $user=User::firstOrCreate(['email'=>$data['email']],$data);
        return $user;
    }

    public function updateUser($data, $user):User
    {
        $user = User::findOrFail($user);
        $user->update($data);
        return $user;
    }


    public function registerUser(array $data):JsonResponse
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        $token=$user->createToken('token-name', ['*'], now()->addHour())->plainTextToken;

        return response()->json(['user'=>$user, 'token'=>$token], 200);
    }
public function loginUser(array $data):JsonResponse
    {
        $user=User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password)){
            return response()->json(['message'=>'incorrect login details'],401);
        }
        $token=$user->createToken('token-name', ['*'], now()->addHour())->plainTextToken;
        return response()->json(['user'=>$user, 'token'=>$token], 200);
    }
    public function deleteUser(User $user):void
    {
        $user->delete();
    }
}
