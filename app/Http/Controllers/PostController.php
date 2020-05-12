<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Services\PostService;
use App\Http\Services\CategoryService;
use App\Post;

class PostController extends Controller
{
    private $postService;
    private $categoryService;
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->postService = new PostService;
        $this->categoryService = new CategoryService;
    }

    public function index()
    {
        $postList = $this->postService->index();
        return view('post.index', compact('postList'));
    }

    public function create()
    {
        $categoryList = $this->categoryService->getList();
        return view('post.create', compact('categoryList'));
    }

    public function store(PostRequest $request)
    {
        $postId = $this->postService->store($request)->id;
        return redirect(route('post.show', $postId))->with('message', 'success');
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('own', $post);
        $categoryList = $this->categoryService->getList();
        return view('post.edit', compact('post', 'categoryList'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('own', $post);
        $this->postService->update($request, $post);
        return redirect(route('post.show', $post->id))->with('message', 'success');
    }


    public function destroy(Post $post)
    {
        $this->authorize('own', $post);
        $this->postService->destroy($post);
        return redirect(route('post.index'))->with('message', 'success');
    }
}
