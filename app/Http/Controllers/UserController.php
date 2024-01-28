<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Service\User\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

/**
 *
*/
class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ){
//        $this->middleware('admin')->only(['store', 'update']);
    }

    public function index():JsonResponse
    {
        $user=User::all();

        return $user->isEmpty() ? response()->json(['error' => 'users is empty'], 404) : response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request):UserResource
    {
        $data = $request->validated();
        $user=$this->userService->createUser($data);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user):JsonResponse
    {
        try {
            $user = User::findOrFail($user);

            return response()->json($user, 200);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $user):JsonResponse
    {
//        $this->authorize('update', auth()->user());
        $data = $request->validated();

        try {
            $user = $this->userService->updateUser($data, $user);
            return response()->json($user, 200);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user):JsonResponse
    {
        try {
            $user = User::findOrFail($user);
            $this->userService->deleteUser($user);

            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json(['error' => 'Failed to delete user'], 400);
        }
    }


}
