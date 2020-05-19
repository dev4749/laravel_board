<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class Comment extends Model
{
    protected $fillable = ['post_id', 'user_id', 'content'];

//    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getPaginate(Post $post)
    {
        return $this->with('user')->where('post_id', $post->id)->orderBy('id', 'desc')->paginate(10);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))->timezone(config('app.timezone'))->toDateTimeString();
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->setTimezone(config('app.timezone'))->toDateTimeString();
    }
}
