<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Get(
 *     path="/apiAdmin/admin",
 *     tags={"Admin"},
 *     summary="Get all Admin",
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
 * ),
 *
 * @OA\Get(
 *     path="/apiAdmin/admin/{admin}",
 *     tags={"Admin"},
 *     summary="Get user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="admin",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="name", type="string", example="Yarik"),
 *                  @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                  @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                  @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="not found"
 *     ),
 *     @OA\Response(
 *          response=400,
 *          description="error"
 *      ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Post(
 *     path="/apiAdmin/admin",
 *     tags={"Admin"},
 *     summary="Store a new user",
 *     @OA\RequestBody(
 *               @OA\MediaType(
 *               mediaType="application/x-www-form-urlencoded",
 *                    @OA\Schema (
 *                        type="object",
 *                        @OA\Property(property="name", type="string", example="Yarik"),
 *                        @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                        @OA\Property(property="password", type="string", example="1234qwe"),
 *                        @OA\Property(property="password_confirmation", type="string", example="1234qwe"),
 *                    )
 *               )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="name", type="string", example="Yarik"),
 *                    @OA\Property(property="email", type="string", example="yarik@yarik"),
 *             ),
 *         ),
 *     ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Put(
 *     path="/apiAdmin/admin/{admin}",
 *     tags={"Admin"},
 *     summary="Update user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="admin",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\RequestBody(
 *               @OA\MediaType(
 *                mediaType="application/json",
 *                     @OA\Schema (
 *                         type="object",
 *                        @OA\Property(property="name", type="string", example="Yarik"),
 *                         @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                         @OA\Property(property="password", type="string", example="1234qwe"),
 *                         @OA\Property(property="password_confirmation", type="string", example="1234qwe"),
 *                     )
 *                )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *                  @OA\Property(property="id", type="integer", example=1),
 *                  @OA\Property(property="name", type="string", example="Yarik"),
 *                  @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                  @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                  @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="not found"
 *     ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Delete(
 *     path="/apiAdmin/admin/{admin}",
 *     tags={"Admin"},
 *     summary="Delete user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="admin",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="News deleted successfully"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="not found"
 *     ),
 *     security={{"bearer": {}}}
 * ),

 */

class AdminController extends Controller
{
    //
}
