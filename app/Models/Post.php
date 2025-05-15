<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'body','created_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
    return $this->morphMany(Comment::class, 'commentable');
    }

}
