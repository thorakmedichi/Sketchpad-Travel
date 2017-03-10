<?php

/* --------------------------------------------
 * GENERIC
 * --------------------------------------------
 */

/**
 * Fancy format for print_r
 * @param     variable      $value    The variable, array, object or collection we want to display
 * @param     boolean       $die      Terminate the script after displaying the output or not
 */
function pre_r($value, $die = false) {
    echo '<pre>';
    print_r ($value);
    echo '</pre>';
    if ($die)
        die();
}

/* --------------------------------------------
 * FILE HANDLING
 * --------------------------------------------
 */

/**
 * Sanitize a filename string to remove special characters
 * @param     string    $file    A filename with no extension
 * @return    string             A sanitized and snake_cased filename
 */
function sanitize_filename($fileName){
    // Remove anything which isn't a word, whitespace, number
    // or any of the following caracters -_~,;[]().
    $fileName = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $fileName);
    // Remove any runs of periods.
    $fileName = mb_ereg_replace("([\.]{2,})", '', $fileName);
    
    return snake_case($fileName);   
}

/**
 * Create a temporary directory for storing files in while processing them
 * NOTE: Laravel specific  
 * @return    String    The full path to the newly created directory or false on fail
 */
function createTempPath() {
    $path = storage_path() . '/temp/' . str_replace('/', '_', uniqid());

    if (!is_dir($path)){
        if (!mkdir($path, 0777, true)) {
            return false;
        }
    }

    return $path;
}

/**
 * A valid file must have some size to it but also within the PHP config limits.
 * NOTE: Laravel specific
 * @param     file     $file    The file object returned from Laravel
 * @return    boolean           Is this a valid files size or not
 */
function isFileSizeValid($file){
    $fileSize = method_exists($file, 'getSize') ? $file->getSize() : $file['size'];
    if (($fileSize >= returnBytes(ini_get('upload_max_filesize'))) || (empty($fileSize))){
        return false;
    }
    return true;
}

/**
 * Used by isFileSizeValid()
 * This function returns the number of bytes based on the string passed to it
 * @param     string    $val    The string value of the file we are trying to determine the bytes for
 * @return    integer           The size in bytes
 */
function returnBytes ($val) {
    if(empty($val)) return 0;

    $val = trim($val);

    preg_match('#([0-9]+)[\s]*([a-z]+)#i', $val, $matches);

    $last = '';
    if(isset($matches[2])){
        $last = $matches[2];
    }

    if(isset($matches[1])){
        $val = (int) $matches[1];
    }

    switch (strtolower($last)) {
        case 'g':
        case 'gb':
            $val *= 1024;
        case 'm':
        case 'mb':
            $val *= 1024;
        case 'k':
        case 'kb':
            $val *= 1024;
    }
    return (int) $val;
}


/* --------------------------------------------
 *  ARRAYS
 * --------------------------------------------
 */

/**
 * Convert any complex object to a multidimensional array
 * @param  object   $obj    The object we want to convert into an array
 * @return array            The new array
 */
function object_to_array($obj) {
    if(is_object($obj)) $obj = (array) $obj;
    if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
            $new[$key] = object_to_array($val);
        }
    }
    else $new = $obj;
    return $new;
}

/**
 * This PHP Function works like strpos() but allows you to submit an array as the needle.
 * The function then loops through each value in the array and determines if the $haystack contains any of the values in the array.
 * If the $pos param is passed as FALSE it will return the whole word match, otherwise it will return the character position
 * @param  array    $haystack   This is the haystack to search
 * @param  array    $needle     This is the array of needles to find in the haystack
 * @param  boolean  $returnPos  Determins if we want to return a whole word match or character position
 * @return string / int         String or Integer of the match
 */
function strpos_arr($haystack, $needle, $returnPos = true) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = stripos($haystack, $what))!==false) return $returnPos ? $pos : $what;
    }
    return false;
}

/**
 * Finds a key that exists in a multidimensional array. Much like array_key_exists for single array dimension
 * @param  array    $array      This is the haystack to search
 * @param  string   $key        This is the needle we hope to find as a key in the haystack
 * @return bool                 true / false
 */
function array_key_exists_multi( Array $array, $key ) {
    if (array_key_exists($key, $array)) {
        return true;
    }
    foreach ($array as $k=>$v) {
        if (!is_array($v)) { continue; }
        if (array_key_exists($key, $v)) { return true; }
    }
    return false;
}