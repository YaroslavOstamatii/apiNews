<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Service\Admin\AdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService,
    ){
    }

    public function index(): AnonymousResourceCollection
    {
        $admin = $this->adminService->getAdmins();

        return AdminResource::collection($admin);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request): AdminResource
    {
        $data = $request->validated();
        $admin = $this->adminService->createAdmin($data);

        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin): AdminResource
    {
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin): AdminResource
    {
        $data = $request->validated();
        $admin = $this->adminService->updateAdmin($data, $admin);

        return new AdminResource($admin);
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
