<?php

namespace App\Http\Service;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostService
{
    private $postModel;
    private $categoryList;
    public function __construct()
    {
        $this->categoryList = ['event', 'sports', 'daily'];
    }

    public function index()
    {
        dd(\App\Post::paginate(5));
        $postList = \App\Post::paginate(5);
    }

    public function store(\App\Http\Requests\PostRequest $request)
    {
        $validateData = $request->all() + ['user_id' => Auth::id()];
        return \App\Post::create($validateData);
    }

    public function show(\App\Post $post)
    {
    }

    public function edit(\App\Post $post)
    {
    }

    public function update(\App\Http\Requests\PostRequest $request, \App\Post $post)
    {
        return $post->update($request->all());
    }

    public function destroy(\App\Post $post)
    {
        return $post->delete();
    }
}
