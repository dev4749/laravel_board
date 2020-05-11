<?php

namespace App\Http\Service;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Post as PostModel;

class PostService
{
    private $postModel;
    private $categoryList;
    public function __construct()
    {
        $this->categoryList = ['event', 'sports', 'daily'];
    }

    public function index(String $category)
    {
        $validator = Validator::make(compact('category'), [
           'category' => [Rule::in($this->categoryList)],
        ])->validate();

//        return $this->postModel->index($validator->valid()['category']);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'bail|required|between:5,255',
            'content' => 'bail|required|between:5,255',
            'category' => [
                Rule::in($this->categoryList)
            ],
        ]) + ['user_id' => Auth::id()];

        return PostModel::create($validateData);
    }

//    public function show(\App\Post $post)
//    {
//        $validator = Validator::make(compact('id'), [
//            'id' => 'bail|required|Integer|exists:posts'
//        ]);
//
//        if ($validator->fails()) {
//            return $validator->errors();
//        }
//        return $this->postModel->show($post->id);
//    }

//    public function edit(\App\Post $post)
//    {
//    }

    public function update(Request $request, \App\Post $post)
    {
        $validateData = $request->validate([
            'title' => 'bail|required|between:5,255',
            'content' => 'bail|required|between:5,255',
            'category' => [
                Rule::in($this->categoryList)
            ],
        ]);

        return $post->update($validateData);
    }

    public function getCategoryList()
    {
        return $this->categoryList;
    }
}
