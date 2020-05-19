<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
use App\Http\Services\CommentService;
use http\Env\Response;

class CommentController extends Controller
{
    private $commentService;
    public function __construct()
    {
        // 1. 로그인 여부 체크
        $this->middleware('auth');
        // 2. 권한 체크
        $this->middleware('can:own,comment')->only('destroy');
        $this->commentService = new CommentService;
    }

    public function store(Post $post, CommentRequest $request)
    {
        return $this->commentService->store($post, $request);
    }

    public function destroy(Post $post, Comment $comment)
    {
        return $this->commentService->destroy($comment);
    }
}
