<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'courses';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
