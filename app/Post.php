<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = ['title', 'content', 'category', 'user_id'];
}
