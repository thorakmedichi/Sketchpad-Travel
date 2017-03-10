<?php 

namespace App\SketchpadForms;

/*
|--------------------------------------------------------------------------
| View Helper Functions
|--------------------------------------------------------------------------
|
| This file should only contain helper functions related to specialized 
| view renderings. 
|
| Segregating our helper functions keeps things tidy
|
*/

class Form {
	/**
	 * Saves duplication of HTML output for validation errors
	 * @param  object 	$errors 	The object created by Laravel that contains all the error details
	 * @param  string 	$field  	The NAME of the form field that we are targeting
	 * @return string         		The visual output of the error 
	 */
	public static function viewError($errors, $field){
		$str = '';
		if ($errors->has($field)){
            $str .='<small class="help-block">
		                <strong>'. $errors->first($field) .'</strong>
		            </small>';
        }
        echo $str;
	}
}