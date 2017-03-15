<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{   
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Blogs(){
    	return $this->hasMany(Blog::class);
    }

    // A Trip could belong to multiple authors if both authors are writting about a joint trip
    public function Trips(){
    	return $this->belongsToMany(Trip::class, 'trip_author');
    }

    // A location can belong to many authors as authors are bound to travel to similar locations
    public function Locations(){
    	return $this->belongsToMany(Location::class, 'location_author');
    }

    public function Image(){
    	return $this->hasOne(Image::class);
    }
}
