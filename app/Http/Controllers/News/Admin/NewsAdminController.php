<?php

namespace App\Http\Controllers\News\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Service\News\NewsAdminService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsAdminController extends Controller
{
    public function __construct(
        private readonly NewsAdminService $newsService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        $news = $this->newsService->getAllNews();

        return NewsResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request): NewsResource
    {
        $data = $request->validated();
        $user = $request->user();

        $news = $this->newsService->createNews($data,$user);

        return new NewsResource($news);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): NewsResource
    {
        return new NewsResource($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news): NewsResource
    {
        $this->authorize('update', $news);
        $data = $request->validated();
        $news = $this->newsService->updateNews($data, $news);

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        $this->authorize('delete', $news);
        $this->newsService->deleteNews($news);

        return response()->json(['message'=>'delete successful']);
    }
}
