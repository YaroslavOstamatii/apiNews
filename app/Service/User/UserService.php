<?php

namespace App\Service\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data)
    {
        $news = new User();
        $news->title = $data['title'];
        $news->text = $data['text'];
        $news->save();
    }

    public function updateUser($data, $id): void
    {
        $user = User::find($id);
        $user->update($data);
    }


    public function registerUser(array $data)
    {
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_READER,
        ]);
        return $user;
    }
public function loginUser(array $data)
    {
        $user=User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password)){
            return response([
                'message'=>'bad creds',
            ],401);
        }
        $token=$user->createToken('token-name')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ],201);
    }
}
