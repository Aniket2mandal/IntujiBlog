<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
