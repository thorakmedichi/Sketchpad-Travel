<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];

    public function Locations(){
        return $this->morphedByMany(Location::class, 'tag_relation');
    }

    public function Trips(){
        return $this->morphedByMany(Trip::class, 'tag_relation');
    }

    public function Blogs(){
        return $this->morphedByMany(Blog::class, 'tag_relation');
    }

    public function Images(){
        return $this->morphedByMany(Image::class, 'tag_relation');
    }

    public static function getSelectOptions(){
        return self::orderBy('title')->pluck('title', 'id');
    }
}
