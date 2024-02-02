<?php

namespace App\Service\User;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }
    public function createUser(StoreUserRequest $request): User
    {
        $data = $request->validated();
        $data['password']=Hash::make($data['password']);
        $user=User::create($data);

        return $user;
    }

    public function updateUser(UpdateRequest $request, User $user): User
    {
        $data = $request->validated();
        $user->update($data);

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}
