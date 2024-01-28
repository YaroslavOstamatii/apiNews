<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAdminController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['message' => 'Register success','user'=>$user], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function login(Request $request)
    {

        $user = auth()->user();

        if (!$user) {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            $email = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->first();

            if (!$user) {
                $user = Admin::where('email', $email)->first();

                if (!$user) {
                    return response()->json(['message' => 'Invalid credentials'], 401);
                }

                if (!password_verify($password, $user->password)) {
                    return response()->json(['message' => 'Invalid credentials'], 401);
                }

                $token = $user->createToken('auth-token')->plainTextToken;
            } else {
                if (!password_verify($password, $user->password)) {
                    return response()->json(['message' => 'Invalid credentials'], 401);
                }

                $token = $user->createToken('auth-token')->plainTextToken;
            }

            return response()->json(['message' => 'LogIn success','User logged in'=>$user,'token'=>$token], 200);
        }
        else{
            $token = auth()->user()->currentAccessToken();
            return response()->json(['message' => 'you are Logged in ','User logged in'=>$user,'token'=>$token], 200);
        }
    }

}
