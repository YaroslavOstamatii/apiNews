<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Service\News\NewsService;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function __construct(
        private readonly NewsService $newsService,
    ){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $news = $this->newsService->getAllNews();

        return NewsResource::collection($news)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request): NewsResource
    {
        $news = $this->newsService->createNews($request);

        return NewsResource::make($news);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): NewsResource
    {
        return NewsResource::make($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news): NewsResource
    {
        $this->authorize('update', $news);
        $news = $this->newsService->updateNews($request, $news);

        return NewsResource::make($news);
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
