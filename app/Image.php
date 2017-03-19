<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

    public function Locations(){
    	return $this->belongsToMany(Location::class, 'location_image');
    }

    public function Trips(){
    	return $this->belongsToMany(Trip::class, 'trip_image');
    }

    public function Author(){
    	return $this->belongsTo(Author::class);
    }


    public static function getSelectOptions(){
        return self::orderBy('name')->pluck('name', 'id');
    }
}
