<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Service\News\NewsService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public function __construct(
        private readonly NewsService $newsService,
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

        return $news->isEmpty() ? response()->json(['error' => 'News is empty'], 404) : response()->json($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();

        $news = $this->newsService->createNews($data, $user);
        return NewsResource::make($news);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $news)
    {

        try {
            $news = News::findOrFail($news);
            return response()->json($news, 200);
        } catch (ModelNotFoundException $exception) {

            return response()->json(['error' => 'News not found'], 404);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, string $news)
    {
        $data = $request->validated();
        try {
            $news = $this->newsService->updateNews($data, $news);
            return response()->json($news, 200);
        } catch (ModelNotFoundException $exception) {

            return response()->json(['error' => 'News not found'], 404);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $news)
    {
        try {
            $news = News::findOrFail($news);
            $this->newsService->deleteNews($news);

            return response()->json(['message' => 'News deleted successfully'], 200);
        } catch (ModelNotFoundException $exception) {

            return response()->json(['error' => 'News not found'], 404);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json(['error' => 'Failed to delete news'], 400);
        }

    }
}
