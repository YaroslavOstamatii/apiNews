<?php

namespace App\Service\Admin;

use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAdmins(): Collection
    {
        return Admin::all();
    }

    public function createAdmin($request): Admin
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        return Admin::create($data);
    }

    public function updateAdmin(UpdateAdminRequest $request, Admin $admin): Admin
    {
        $data = $request->validated();
        $admin->update($data);
        return $admin;
    }

    public function deleteAdmin($admin): void
    {
        $admin->delete();
    }
}
