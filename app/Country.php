<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function Locations(){
    	return $this->hasMany(Location::class);
    }


    public static function getSelectOptions(){
        return self::orderBy('name')->pluck('name', 'id');
    }
}
