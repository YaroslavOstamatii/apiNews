<?php

namespace App\Http\Controllers\Swagger\Auth;

use App\Http\Controllers\Controller;

/**
 * @OA\Post(
 *       path="/apiAdmin/login",
 *       tags={"AuthAdmin"},
 *       summary="Logs user into system",
 *       @OA\RequestBody(
 *           @OA\MediaType(
 *               mediaType="application/x-www-form-urlencoded",
 *                    @OA\Schema (
 *                        type="object",
 *                        @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                        @OA\Property(property="password", type="string", example="qwerty123"),
 *                    )
 *           ),
 *       ),
 *      @OA\Response(
 *           response=200,
 *           description="Successful operation",
 *           @OA\JsonContent(
 *               @OA\Property(property="user", type="object",
 *                    @OA\Property(property="id", type="integer", example=1),
 *                    @OA\Property(property="name", type="string", example="Yarik"),
 *                    @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                    @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                    @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *               ),
 *               @OA\Property(property="token", type="string", example="News deleted successfully"),
 *           ),
 *       ),
 *       @OA\Response(
 *           response=401,
 *           description="incorrect login details"
 *       ),
 *   )
 *
 * @OA\Post(
 *        path="/apiAdmin/register",
 *        tags={"AuthAdmin"},
 *        summary="Register user in system",
 *        @OA\RequestBody(
 *        description="inputs for regisrer",
 *            @OA\MediaType(
 *                mediaType="application/x-www-form-urlencoded",
 *                     @OA\Schema (
 *                         type="object",
 *                         @OA\Property(property="name", type="string", example="Yaroslav"),
 *                         @OA\Property(property="email", type="string", example="yarik@yarik"),
 *                         @OA\Property(property="password", type="string", example="qwerty123"),
 *                         @OA\Property(property="password_confirmation", type="string", example="qwerty123"),
 *                     )
 *            )
 *        ),
 *       @OA\Response(
 *            response=200,
 *            description="Successful operation",
 *            @OA\JsonContent(
 *                @OA\Property(property="user", type="object", example={"name": "Yaroslav", "email": "yarik@yarik"}),
 *                @OA\Property(property="message", type="string", example="User created successfully")
 *            )
 *        ),
 *        @OA\Response(
 *            response=400,
 *            description="Invalid username/password supplied"
 *        )
 *    )
 * @OA\Post(
 *         path="/apiAdmin/logout",
 *         tags={"AuthAdmin"},
 *         summary="Logout user from system",
 *          security={{"bearer": {}}},
 *        @OA\Response(
 *             response=200,
 *             description="Logout",
 *         )
 *
 *     )
 */
class RegisterAdminController extends Controller
{
}
