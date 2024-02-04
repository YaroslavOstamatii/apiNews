<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Service\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }


    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers();

        return UserResource::collection($users)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $user = $this->userService->createUser($request);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): UserResource
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): UserResource
    {
        $user = $this->userService->updateUser($request, $user);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user);

        return response()->json(['message' => 'User deleted successfully']);
    }
}
