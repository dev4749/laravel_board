<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
class CommentService
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment;
    }

    public function getPagniate(Post $post)
    {
        return $this->commentModel->getPaginate($post);
    }

    public function store(Post $post, CommentRequest $request)
    {
        $comment = ['post_id' => $post->id, 'user_id' => Auth::id()] + $request->all();
        return $this->commentModel->create($comment)->setAttribute('user_name', Auth::user()->name);
    }

    public function update(CommentRequest $request, \App\Post $post)
    {
    }

    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
