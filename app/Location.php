<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = ['id'];

    public function Country(){
    	return $this->belongsTo(Country::class);
    }

    // A location can belong to many authors as authors are bound to travel to similar locations
    public function Authors(){
    	return $this->belongsToMany(Author::class, 'location_author');
    }

    public function Blogs(){
    	return $this->morphToMany(Blog::class, 'blog_relation');
    }

    public function Images(){
    	return $this->belongsToMany(Image::class,  'location_image');
    }

    public function Map(){
    	return $this->belongsTo(Map::class);
    }
}
