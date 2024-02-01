<?php

namespace App\Policies;

use App\Models\News;

class NewsPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update($user, News $news): bool
    {
        // if current user === news.user OR Admin
        return ($user->id === $news->newsable->id && $news->newsable_type === get_class($user))||is_a($user,'App\Models\Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, News $news): bool
    {
        // if current user === news.user OR Admin
        return ($user->id === $news->newsable->id && $news->newsable_type === get_class($user))||is_a($user,'App\Models\Admin');
    }
}
