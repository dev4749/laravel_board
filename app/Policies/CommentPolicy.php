<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;
    public function own(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
