<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content'];
    public function User(){
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->hasOne(Image::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
