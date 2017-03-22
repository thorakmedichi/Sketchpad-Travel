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
        return self::orderBy('name')->pluck('name', 'id');
    }


    public static function deleteFilenameFromDb($id, $filename){
        try {
            Map::where([['id', $id], ['kml_filename', $filename]])->update(['kml_filename' => null]);
        }
        catch (Exception $ex) {
            throw $ex;
        }

        return true;
    }
}
