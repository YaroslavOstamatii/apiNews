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
 *                 @OA\Property(property="role", type="integer", example=1),
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
 *     path="/api/user/{user}",
 *     tags={"User"},
 *     summary="Get user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="user",
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
 *                  @OA\Property(property="role", type="integer", example=1),
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
 *     path="/api/user",
 *     tags={"User"},
 *     summary="Store a new user",
 *     @OA\RequestBody(
 *               @OA\MediaType(
 *               mediaType="application/x-www-form-urlencoded",
 *                    @OA\Schema (
 *                        type="object",
 *                        @OA\Property(property="name", type="string", example="Yarik"),
 *                        @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                        @OA\Property(property="role", type="integer", example=1),
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
 *                    @OA\Property(property="role", type="integer", example=1),
 *             ),
 *         ),
 *     ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Put(
 *     path="/api/user/{user}",
 *     tags={"User"},
 *     summary="Update user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="user",
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
 *                         @OA\Property(property="role", type="integer", example=1),
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
 *                  @OA\Property(property="role", type="integer", example=1),
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
 *     path="/api/user/{user}",
 *     tags={"User"},
 *     summary="Delete user by id",
 *     @OA\Parameter(
 *         description="user ID",
 *         in="path",
 *         name="user",
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
 * @OA\Post(
 *      path="/api/login",
 *      tags={"Login"},
 *      summary="Logs user into system",
 *      @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/x-www-form-urlencoded",
 *                   @OA\Schema (
 *                       type="object",
 *                       @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                       @OA\Property(property="password", type="string", example="qwerty123"),
 *                   )
 *          ),
 *      ),
 *     @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="user", type="object",
 *                   @OA\Property(property="id", type="integer", example=1),
 *                   @OA\Property(property="name", type="string", example="Yarik"),
 *                   @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                   @OA\Property(property="role", type="integer", example=1),
 *                   @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                   @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *              ),
 *              @OA\Property(property="token", type="string", example="News deleted successfully"),
 *          ),
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="incorrect login details"
 *      ),
 *  )
 *
 * @OA\Post(
 *       path="/api/register",
 *       tags={"Register"},
 *       summary="Register user in system",
 *       @OA\RequestBody(
 *       description="inputs for regisrer",
 *           @OA\MediaType(
 *               mediaType="application/x-www-form-urlencoded",
 *                    @OA\Schema (
 *                        type="object",
 *                        @OA\Property(property="name", type="string", example="Yaroslav"),
 *                        @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                        @OA\Property(property="password", type="string", example="qwerty123"),
 *                        @OA\Property(property="password_confirmation", type="string", example="qwerty123"),
 *                        @OA\Property(property="role", type="integer", example=0)
 *
 *                    )
 *           )
 *       ),
 *      @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *           @OA\JsonContent(
 *               @OA\Property(property="user", type="object", example={"name": "Yaroslav", "email": "yarik@yarik", "role": 0}),
 *               @OA\Property(property="message", type="string", example="User created successfully")
 *           )
 *       ),
 *       @OA\Response(
 *           response=400,
 *           description="Invalid username/password supplied"
 *       )
 *   )
 * @OA\Post(
 *        path="/api/logout",
 *        tags={"Logout"},
 *        summary="Logout user from system",
 *         security={{"bearer": {}}},
 *       @OA\Response(
 *            response=200,
 *            description="Logout",
 *        )
 *
 *    )
 */

class UserController extends Controller
{
    //
}
