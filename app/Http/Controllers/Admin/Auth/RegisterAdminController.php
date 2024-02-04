<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginAdminRequest;
use App\Http\Requests\Admin\RegisterAdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Service\Admin\AdminAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterAdminController extends Controller
{
    public function __construct(
        private readonly AdminAuthService $adminAuthService
    ){
    }

    public function register(RegisterAdminRequest $request): JsonResponse
    {
        $data = $request->validated();
        $admin = $this->adminAuthService->registerAdmin($data);

        return response()->json([
            'Login successfully for admin' => new AdminResource($admin),
        ]);
    }


    public function logout(Request $request): JsonResponse
    {
        $this->adminAuthService->logoutAdmin($request);

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function login(LoginAdminRequest $request): JsonResponse
    {
        $data = $request->validated();
        $adminAndToken = $this->adminAuthService->loginAdmin($data);

        return response()->json([
            'Login successfully for admin' => new AdminResource($adminAndToken['admin']),
            'token' => $adminAndToken['token'],
        ]);
    }

}
