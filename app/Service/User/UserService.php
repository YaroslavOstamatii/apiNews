<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        $data['password']=Hash::make($data['password']);
        $data['role']=1;
        $user=User::firstOrCreate(['email'=>$data['email']],$data);
        return $user;
    }

    public function updateUser($data, $user)
    {
        $user = User::findOrFail($user);

        $user->update($data);
        return $user;
    }


    public function registerUser(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        $token=$user->createToken('token-name', ['*'], now()->addHour())->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ],200);
    }
public function loginUser(array $data)
    {
        $user=User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password)){
            return response([
                'message'=>'incorrect login details',
            ],401);
        }
        $token=$user->createToken('token-name', ['*'], now()->addHour())->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ],200);
    }
    public function deleteUser(User $user)
    {
        $user->delete();
    }
}
