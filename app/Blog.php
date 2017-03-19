<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $gaurded = ['id'];

    public function Author(){
    	return $this->belongsTo(Author::class);
    }

    public function Location(){
    	return $this->morphedByMany(Location::class, 'blog_relation');
    }

    public function Trip(){
    	return $this->morphedByMany(Trip::class, 'blog_relation');
    }

    public function Relation(){
        return $blogRelation = BlogRelation::where('blog_id', $this->id)->first();
    }

    public static function getSelectOptions(){
        return self::orderBy('title')->pluck('title', 'id');
    }

}
