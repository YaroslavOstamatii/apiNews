<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\User;
use App\Service\User\UserAuthService;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    public function __construct(
       private readonly UserAuthService $userAuthService
    ){
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userAuthService->registerUser($data);

        return response()->json(['message' => 'Register success','user'=>$user], 201);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userAuthService->loginUser($data);

        return response()->json(['message' => "Login successfully {$user['user']->email}", 'token' => $user['token']]);
    }

}
