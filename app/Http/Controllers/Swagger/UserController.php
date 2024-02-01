<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Get(
 *     path="/api/user",
 *     tags={"User"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Yarik"),
 *                 @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                 @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                 @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *             ),
 *         ),
 *     ),
 *     @OA\Response(
 *          response=404,
 *          description="users empty"
 *      ),
 *     security={{"bearer": {}}}
 * )
 *
 */

class UserController extends Controller
{
    //
}
