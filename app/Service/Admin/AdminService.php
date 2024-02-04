<?php

namespace App\Service\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function getAdmins(): Collection
    {
        return Admin::all();
    }

    public function createAdmin(array $data): Admin
    {
        $data['password'] = Hash::make($data['password']);

        return Admin::create($data);
    }

    public function updateAdmin(array $data, Admin $admin): Admin
    {
        $admin->update($data);

        return $admin;
    }

    public function deleteAdmin(Admin $admin): void
    {
        $admin->delete();
    }
}
