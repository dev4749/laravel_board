<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'category', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPaginate()
    {
        return $this->with('user')->paginate(10);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
