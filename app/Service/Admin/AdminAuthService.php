<?php

namespace App\Service\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AdminAuthService
{
    public function registerAdmin(array $data): Admin
    {
        $data['password']=Hash::make($data['password']);
        $user=Admin::create($data);
        return $user;
    }

public function loginAdmin(array $data)
    {
        $admin=Admin::where('email',$data['email'])->first();

        if(!$admin || !password_verify($data['password'],$admin->password)){
            throw new UnauthorizedException('Incorrect login details');
        }
        $token=$admin->createToken('token-name')->plainTextToken;

        return ['user' => $admin, 'token' => $token];
    }
    public function logoutAdmin($request):void
    {
        $request->admin()->tokens()->delete();
    }
}
