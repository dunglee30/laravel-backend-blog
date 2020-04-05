<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Post extends Model
{

    public function user() {
        return $this->belongsTo(User::class);
    } 

    protected $fillable = [
        'title', 'content', 'user_id','url', 'views', 'image',
    ];

    
}
