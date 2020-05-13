<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
use App\Http\Services\CommentService;
class CommentController extends Controller
{
    private $commentService;
    public function __construct()
    {
        $this->middleware('auth')->except('index');
        $this->commentService = new CommentService;
    }

    public function index(Post $post)
    {

    }

    public function store(Post $post, CommentRequest $request)
    {
        return $this->commentService->store($post, $request);
    }

    public function edit(Comment $comment)
    {

    }

    public function update(CommentRequest $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
