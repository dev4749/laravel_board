<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function own(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
