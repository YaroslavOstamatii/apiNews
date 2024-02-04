<?php

namespace App\Service\News;

use App\Models\Admin;
use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NewsAdminService
{
    public function getAllNews(): Collection
    {
        return News::all();
    }
    public function createNews(array $data, Admin $user): Model
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
