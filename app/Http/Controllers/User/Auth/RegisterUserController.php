<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Resources\User\UserResource;
use App\Service\User\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function __construct(
        private readonly UserAuthService $userAuthService
    ){
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->userAuthService->registerUser($request);
        return response()->json([
            'Login successfully for user' => new UserResource($user),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->userAuthService->logoutUser($request);

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        $userAndToken = $this->userAuthService->loginUser($request);

        return response()->json([
            'Login successfully for user' => new UserResource($userAndToken['user']),
            'token' => $userAndToken['token'],
        ]);
    }
}
