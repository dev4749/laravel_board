<?php

namespace App\Http\Services;

class CategoryService
{
    public function getList()
    {
        return config('category');
    }
}
