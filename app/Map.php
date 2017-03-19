<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $guarded = ['id'];

    public function Locations(){
    	return $this->hasMany(Location::class);
    }
    
    public function Trips(){
    	return $this->hasMany(Trip::class);
    }

    public static function getSelectOptions(){
        return self::orderBy('klm_file')->pluck('klm_file', 'id');
    }
}
