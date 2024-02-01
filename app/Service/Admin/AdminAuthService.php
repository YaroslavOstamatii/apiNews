<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\LoginAdminRequest;
use App\Http\Requests\Admin\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;

class AdminAuthService
{
    public function registerAdmin(RegisterAdminRequest $request): Admin
    {
        $data = $request->validated();
        $data['password']=Hash::make($data['password']);

        return Admin::create($data);
    }

public function loginAdmin(LoginAdminRequest $request): array
    {
        $data = $request->validated();
        $admin=Admin::where('email',$data['email'])->first();

        if(!$admin || !password_verify($data['password'],$admin->password)){
            throw new UnauthorizedException('Incorrect login details');
        }
        $token=$admin->createToken('token-admin')->plainTextToken;

        return ['admin' => $admin, 'token' => $token];
    }
    public function logoutAdmin($request):void
    {
        $request->user()->tokens()->delete();
    }
}
