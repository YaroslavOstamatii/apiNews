<?php

namespace App\Service\News;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Support\Collection;

class NewsService
{
    public function getAllNews(): Collection
    {
        return News::all();
    }
    public function createNews(StoreNewsRequest $request): News
    {
        $data = $request->validated();
        $user = $request->user();
        $news = $user->news()->create($data);

        return $news;
    }

    public function updateNews(UpdateNewsRequest $request, News $news): News
    {
        $data = $request->validated();
        $news->update($data);

        return $news;
    }

    public function deleteNews($news)
    {
        $news->delete();
    }


}
