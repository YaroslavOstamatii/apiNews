<?php

namespace App\Service\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAllAdmin():Collection
    {
        return Admin::all();
    }
    public function createAdmin(array $data):Admin
    {
        $data['password']=Hash::make($data['password']);
        $user=Admin::create($data);
        return $user;
    }

    public function updateAdmin($data, $admin):Admin
    {
        $admin = Admin::findOrFail($admin);
        $admin->update($data);
        return $admin;
    }


    public function registerAdmin(array $data):JsonResponse
    {
        $admin= Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
        $token=$admin->createToken('token-name', ['*'], now()->addHour())->plainTextToken;

        return response()->json(['admin'=>$admin, 'token'=>$token], 200);
    }
public function loginAdmin(array $data):JsonResponse
    {
        $admin=Admin::where('email',$data['email'])->first();

        if(!$admin || !Hash::check($data['password'],$admin->password)){
            return response()->json(['message'=>'incorrect login details'],401);
        }
        $token=$admin->createToken('token-name', ['*'], now()->addHour())->plainTextToken;
        return response()->json(['admin'=>$admin, 'token'=>$token], 200);
    }
    public function deleteAdmin(Admin $admin):void
    {
        $admin->delete();
    }
}
