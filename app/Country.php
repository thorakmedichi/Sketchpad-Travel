<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $gaurded = [];

    public function Locations(){
    	return $this->hasMany(Location::class);
    }
}
