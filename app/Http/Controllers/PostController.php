<?php

namespace App\Http\Controllers;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use App\Http\Service\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->postService = new PostService;
    }

    public function index()
    {
        $postList = \App\Post::with('user')->paginate(10);
        return view('post.index', compact('postList'));
    }

    public function create()
    {
        $categoryList = config('category');
        return view('post.create', compact('categoryList'));
    }

    public function store(\App\Http\Requests\PostRequest $request)
    {
        $postId = $this->postService->store($request)->id;
        return redirect(route('post.show', $postId))->with('message', 'success');
    }

    public function show(\App\Post $post)
    {
        return view('post.show', compact('post'));
    }

    public function edit(\App\Post $post)
    {
        $this->authorize('own', $post);
        $categoryList = config('category');
        return view('post.edit', compact('post', 'categoryList'));
    }

    public function update(\App\Http\Requests\PostRequest $request, \App\Post $post)
    {
        $this->authorize('own', $post);
        $this->postService->update($request, $post);
        return redirect(route('post.show', $post->id))->with('message', 'success');
    }


    public function destroy(\App\Post $post)
    {
        $this->authorize('own', $post);
        $this->postService->destroy($post);
        return redirect('/home')->with('message', 'success');
    }
}
