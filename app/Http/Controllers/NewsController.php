<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
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
        return News::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        try {
            $news = $this->newsService->createNews($data, $user);
            return response(['status' => 'news created', 'title News' => $news->title], 201);
        } catch (Exception $exception) {

            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $news)
    {
        return News::where('id', $news)->get();
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

            return response(['message' => 'News deleted successfully'], 200);
        } catch (ModelNotFoundException $exception) {

            return response(['error' => 'News not found'], 404);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json(['error' => 'Failed to delete news'], 400);
        }

    }
}
