<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Service\Admin\AdminService;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService,
    ){
    }

    public function index(): JsonResponse
    {
        $admin = $this->adminService->getAdmins();

        return AdminResource::collection($admin)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request): AdminResource
    {
        $admin = $this->adminService->createAdmin($request);

        return AdminResource::make($admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin): AdminResource
    {
        return AdminResource::make($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin): AdminResource
    {
        $admin = $this->adminService->updateAdmin($request, $admin);

        return AdminResource::make($admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin): JsonResponse
    {
        $this->adminService->deleteAdmin($admin);

        return response()->json(['message' => 'Admin deleted successfully']);

    }
}
