<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

use Carbon\Carbon;

class Post extends Model
{

    public function user() {
        return $this->belongsTo(User::class);
    } 

    protected $fillable = [
        'title', 'content', 'category', 'public_at', 'user_id','url', 'views', 'image',
    ];

    public function scopePublic($query) {
        return $query->where('public_at', '<=',Carbon::now());
    }
    
    public function scopeDefault($query) {
        return $query->where('public_at', null);
    }
}
