<?php

namespace App\Service\News;

use App\Models\News;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class NewsService
{
    public function createNews(array $data,  $user)
    {
        $news = new News();
        $news->title = $data['title'];
        $news->text = $data['text'];
        if($user !== User::class){
            $user=User::find($user);

        }
        $news->user()->associate($user);
        $news->save();
        return $news;
    }

    public function updateNews($data, $news)
    {
        $news=News::findOrFail($news);
        $news->update($data);
        return $news;
    }

    public function deleteNews(News $news)
    {
        $news->delete();
    }


}
