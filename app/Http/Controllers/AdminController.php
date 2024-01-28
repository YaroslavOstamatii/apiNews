<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Models\Admin;
use App\Service\Admin\AdminService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService,
    ){
    }

    public function index():JsonResponse
    {
        $admin=$this->adminService->getAllAdmin();

        return $admin->isEmpty() ? response()->json(['error' => 'users is empty'], 404) : response()->json($admin);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request):AdminResource
    {
        $data = $request->validated();
        $admin=$this->adminService->createAdmin($data);

        return new AdminResource($admin);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin):JsonResponse
    {
        try {
            $admin = Admin::find($admin);

            return response()->json($admin, 200);
        }   catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $admin):JsonResponse
    {
        $data = $request->validated();

        try {
            $admin = $this->adminService->updateAdmin($data, $admin);
            return response()->json($admin, 200);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $admin):JsonResponse
    {
        try {
            $admin = Admin::findOrFail($admin);
            $this->adminService->deleteAdmin($admin);

            return response()->json(['message' => 'Admin deleted successfully'], 200);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json(['error' => 'Failed to delete user'], 400);
        }
    }
}
