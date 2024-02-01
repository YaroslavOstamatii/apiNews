<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;

class NewsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, News $news): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

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
