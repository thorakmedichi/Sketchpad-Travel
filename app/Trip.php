<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = ['id'];

    // A Trip could belong to multiple authors if both authors are writting about a joint trip
    public function Authors(){
    	return $this->belongsToMany(Author::class, 'trip_author');
    }

    public function Blogs(){
    	return $this->morphToMany(Blog::class, 'blog_relation');
    }

    public function Images(){
    	return $this->belongsToMany(Image::class,  'trip_image');
    }

    public function Map(){
    	return $this->belongsTo(Map::class);
    }
}
