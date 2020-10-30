<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Post extends Model
{
    use Searchable;
    protected $table = 'posts';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
