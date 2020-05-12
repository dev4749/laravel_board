<?php

namespace App\Http\Services;

use App\Http\Requests\PostRequest;
use App\Http\Services\CategoryService;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    private $postModel;
    public function __construct()
    {
        $this->postModel = new Post;
    }

    public function index()
    {
        return $this->postModel->getPaginate();
    }

    public function store(PostRequest $request)
    {
        $validateData = $request->all() + ['user_id' => Auth::id()];
        return $this->postModel->create($validateData);
    }

    public function update(PostRequest $request, Post $post)
    {
        return $post->update($request->all());
    }

    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
