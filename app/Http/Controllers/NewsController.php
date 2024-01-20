<?php

namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use App\Service\News\NewsService;
use Exception;
use http\Client\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="News API",
 *      description="L5 Swagger OpenApi description",
 *
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 *
 */
class NewsController extends Controller
{
    public function __construct(
        private readonly NewsService $newsService,
    )
    {
    }

    /**
     * Display a listing of the news.
     *
     * @return Response
     * @OA\Get(
     *      path="/api/news",
     *      operationId="getNewsList",
     *      tags={"News"},
     *      summary="Get list of news",
     *      description="Returns list of news",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *      )
     * )
     */
    public function index()
    {
        $news= News::all();
        return response()->json(['news' => $news]);
    }
    /**
     * Display a listing of the news.
     *
     * @return Response
     * @OA\Post(
     *      path="/api/news",
     *      operationId="storeNewNews",
     *      tags={"NewNews"},
     *      summary="Create a news",
     *      description="Returns a news",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *      )
     * )
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

    public function show(string $news)
    {
        return News::where('id', $news)->get();
    }
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
