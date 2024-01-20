<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Models\User;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $this->userService->createUser($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(is_null($user)) return response(['message'=>'not found user']);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoginUserRequest $request, string $id)
    {
        $data = $request->validated();
        $this->userService->updateUser($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id) ? 'succes' : 'unsucces';
    }

    protected function register(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = $this->userService->registerUser($data);
        $token = $user->createToken('token-name')->plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'logOut'];
    }

    protected function login(LoginUserRequest $request)
    {
        $data = $request->validated();
        $responce=$this->userService->loginUser($data);
        return $responce;

    }
}
