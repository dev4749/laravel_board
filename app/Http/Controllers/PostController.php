<?php

namespace App\Http\Controllers;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use App\Http\Service\PostService;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    private $postService;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        $this->postService = new PostService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(String $category)
    {
        return $this->postService->index($category);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryList = $this->postService->getCategoryList();
        return view('post.create', compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $postId = $this->postService->store($request)->id;
        return redirect(route('post.show', $postId))->with('message', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(\App\Post $post)
    {
        $this->authorize('own', $post);
        $categoryList = $this->postService->getCategoryList();
        return view('post.edit', compact('post', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Post $post)
    {
        $this->authorize('own', $post);
        $this->postService->update($request, $post);
        return redirect(route('post.show', $post->id))->with('message', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Post $post)
    {
        $this->authorize('own', $post);
        //
    }
}
