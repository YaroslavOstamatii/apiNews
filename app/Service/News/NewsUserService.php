<?php

namespace App\Service\News;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NewsUserService
{
    public function getAllNews(): Collection
    {
        return News::all();
    }
    public function createNews(array $data, User $user): Model
    {
        return $user->news()->create($data);
    }

    public function updateNews(array $data, News $news): News
    {
        $news->update($data);

        return $news;
    }

    public function deleteNews($news)
    {
        $news->delete();
    }


}
