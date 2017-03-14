<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $gaurded = [];

    public function Author(){
    	return $this->belongsTo(Author::class);
    }

    public function Location(){
    	return $this->morphedByMany(Location::class, 'blog_relation');
    }

    public function Trip(){
    	return $this->morphedByMany(Trip::class, 'blog_relation');
    }
}
