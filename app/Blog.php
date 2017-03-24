<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = ['id'];

    public function Author(){
        return $this->belongsTo(Author::class);
    }

    public function Locations(){
        return $this->morphedByMany(Location::class, 'blog_relation');
    }

    public function Trips(){
        return $this->morphedByMany(Trip::class, 'blog_relation');
    }

    public function Tags(){
        return $this->morphToMany(Tag::class, 'tag_relation');
    }

    public static function getSelectOptions(){
        return self::orderBy('title')->pluck('title', 'id');
    }

}
