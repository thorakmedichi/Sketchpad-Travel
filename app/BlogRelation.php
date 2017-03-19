<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogRelation extends Model
{
	public static function getSelectOptions(){
        return self::orderBy('type')->pluck('type', 'type');
    }
}