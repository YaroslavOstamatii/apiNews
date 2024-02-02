<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 *
 * @OA\Get(
 *     path="/apiAdmin/news",
 *     tags={"NewsAdmin"},
 *     summary="Get all new news",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="News Text"),
 *                 @OA\Property(property="text", type="string", example="News Text"),
 *                 @OA\Property(property="published_at", type="datetime", example="1900-01-01 12:00:00"),
 *                 @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *                 @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *             ),
 *         ),
 *     ),
 * ),
 *
 * @OA\Get(
 *     path="/apiAdmin/news/{post}",
 *     tags={"NewsAdmin"},
 *     summary="Get news by id",
 *     @OA\Parameter(
 *         description="news ID",
 *         in="path",
 *         name="post",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="News Text"),
 *             @OA\Property(property="text", type="string", example="News Text"),
 *             @OA\Property(property="image", type="string", example="img"),
 *             @OA\Property(property="is_active", type="integer", example=1),
 *             @OA\Property(property="published_at", type="datetime", example="1900-01-01 12:00:00"),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *             @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="not found"
 *     ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Post(
 *     path="/apiAdmin/news",
 *     tags={"NewsAdmin"},
 *     summary="Store a new news",
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title", type="string", example="News Title"),
 *                     @OA\Property(property="text", type="string", example="News Text"),
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="News Text"),
 *                 @OA\Property(property="text", type="string", example="News Text"),
 *             ),
 *         ),
 *     ),
 *     security={{"bearer": {}}}
 * ),
 *
 * @OA\Put(
 *     path="/apiAdmin/news/{post}",
 *     tags={"NewsAdmin"},
 *     summary="Update news by id",
 *     @OA\Parameter(
 *         description="news ID",
 *         in="path",
 *         name="post",
 *         required=true,
 *         example=1,
 *     ),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             allOf={
 *                 @OA\Schema(
 *                     @OA\Property(property="title", type="string", example="Edit News Title"),
 *                     @OA\Property(property="text", type="string", example="Edit News Text"),
 *                 )
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="title", type="string", example="News Text"),
 *             @OA\Property(property="text", type="string", example="News Text"),
 *             @OA\Property(property="image", type="string", example="img"),
 *             @OA\Property(property="is_active", type="integer", example=1),
 *             @OA\Property(property="published_at", type="datetime", example="1900-01-01 12:00:00"),
 *             @OA\Property(property="user_id", type="integer", example=1),
 *             @OA\Property(property="created_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
 *             @OA\Property(property="updated_at", type="datetime", example="2024-01-21T12:58:45.000000Z"),
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
 *     path="/apiAdmin/news/{post}",
 *     tags={"NewsAdmin"},
 *     summary="Delete news by id",
 *     @OA\Parameter(
 *         description="news ID",
 *         in="path",
 *         name="post",
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

class NewsAdminController extends Controller
{
}
