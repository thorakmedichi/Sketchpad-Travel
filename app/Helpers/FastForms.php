<?php

namespace App\Sketchpad;

class FastForms {

    /**
     * Generate a full HTML form as autonomously as possible
     * This reduces the need to type repetative html into Views while at the same time 
     * allowing a place to make site wide changes to the design and layout of all forms
     * @param     string     $table            The table name we want to query to get the input fields
     * @param     string     $action           The URL the form will post to
     * @param     object     $errors           The Laravel error collection object
     * @param     array      $values           The values that should be used in the form fields, if it exists
     * @param     array      $callback         [Integer, Function] The first value of the array is the location in the list of inputs. The second is the function to run
     *                                         Typically the function will be a call to one of the static input functions in this class
     * @param     boolean    $ignoreGaurded    Should we return special fields typically not needed in forms or just ignore them (id, created_at, etc)
     * @return    html                         Echo out the HTML / PHP for the form
     */
    public static function generate($table, $action, $errors, $values = null, $callback = null, $ignoreGaurded = true){
        if (empty($table)){
            throw new Exception("You must provide a database table name", 1);
        }

        if (empty($action)){
            throw new Exception("You must provide an action endpoint", 2);
        }

        $fields = self::getDatabaseFields($table, $ignoreGaurded);
        
        self::generateHTML($fields, $action, $errors, $values, $callback);
    }

    /**
     * Get all the fields, their type and any extra data we can get about the fields
     * @param     string    $table            The table name to query
     * @param     boolean   $ignoreGaurded    Should we return special fields typically not needed in forms or just ignore them
     * @return    array                       Array of fields the query returned and any information about them
     */
    public static function getDatabaseFields($table, $ignoreGaurded){
        $fields = [];
        $columns = \DB::select('show columns from ' . $table);

        foreach ($columns as $value) {
            if ($ignoreGaurded){
                switch($value->Field){
                    case 'id':
                    case 'created_at':
                    case 'updated_at':
                    case 'deleted_at':
                    case 'remember_token':
                        continue 2;
                    default:
                        break;
                }
            }

            $fields[$value->Field]['type'] = $value->Type;
            $fields[$value->Field]['required'] = $value->Null == 'NO' ? false : true;
            $fields[$value->Field]['default'] = $value->Default;
            $fields[$value->Field]['misc'] = $value;
        }

        return $fields;
    }

    /**
     * Here is where the HTML will be generated for the entire form
     * @param     array     $fields      The list of fields and values needed to auto generate the form inputs
     * @param     string    $action      The URL that the form will post to
     * @param     object    $errors      Laravels error collection object
     * @param     object    $values      The values we want to populate the inputs, if they exist
     * @param     array     $callback    [Integer, Function] The first value of the array is the location in the list of inputs. The second is the function to run
     *                                   Typically the function will be a call to one of the static input functions in this class
     * @return    html                   This function simply echo's out the html output
     */
    public static function generateHTML($fields, $action, $errors, $values, $callback){

        echo '<form class="form-horizontal" role="form" method="POST" action="'. $action .'">'. csrf_field() ;
        
        $iteration = 1;

        foreach ($fields as $field => $settings){
            // This lets us add extra inputs and decide where to put them
            if (!empty($callback)){
                if ($iteration == $callback[0]){
                    $callback[1]();
                }
            }

            if (strpos($field, '_id') !== false){
                $exploded = explode('_', $field);
                $name = ucfirst($exploded[0]);
                $table = 'App\\'. $name;

                $options = $table::getSelectOptions();
                self::formSelect($field, $name, 'pencil', $options, $errors, $values[$field]);
            } 
            else {
                if (strpos($settings['type'], 'varchar') !== false){
                    self::formInput('text', $field, ucfirst($field), 'pencil', $errors, $values[$field]);
                }

                else if (strpos($settings['type'], 'int') !== false){
                    self::formInput('text', $field, ucfirst($field), 'pencil', $errors, $values[$field]);
                }

                else if (strpos($settings['type'], 'enum') !== false){
                    $options = [];

                    preg_match_all('(\'(\w+)\')', $settings['type'], $matches);

                    foreach ($matches[1] as $match){
                        $options[$match] = ucfirst($match);
                    }

                    self::formSelect($field, ucfirst($field), 'pencil', $options, $errors, $values[$field]);
                }

                else if (strpos($settings['type'], 'text') !== false){
                    self::formTextarea($field, ucfirst($field), 'pencil', $errors, $values[$field]);
                }

                if (strpos($settings['type'], 'decimal') !== false){
                    self::formInput('text', $field, ucfirst($field), 'pencil', $errors, $values[$field]);
                }

                if (strpos($settings['type'], 'date') !== false){
                    self::formInput('date', $field, ucfirst($field), 'pencil', $errors, $values[$field]);
                }
            }

            $iteration++;
        }

        $buttonText = 'Create';
        if (!empty($values)){
            $buttonText = 'Update';
        }

        echo '<div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-labeled fa fa-floppy-o pull-right">'. $buttonText .'</button>
                    </div>
                </div>
            </form>';
    }

    /**
     * Saves duplication of HTML output for validation errors
     * @param  object   $errors     The object created by Laravel that contains all the error details
     * @param  string   $field      The NAME of the form field that we are targeting
     * @return string               The visual output of the error 
     */
    public static function viewError($errors, $field){
        $str = '';
        if ($errors->has($field)){
            $str .='<small class="help-block">
                        <strong>'. $errors->first($field) .'</strong>
                    </small>';
        }
        return $str;
    }

    /**
     * The bootstrap HTML wrapper for each input element.
     * This is where we set where and how the label is displayed and how many columns the input width is etc
     * @param     string    $name      The field name
     * @param     string    $label     The label text
     * @param     string    $input     The actual input to be displayed
     * @param     string    $icon      The FontAwesome icon to display, if any
     * @param     array     $errors    The Laravel error collection
     * @return    html                 The HTML to be echo'd out
     */
    public static function inputWrapper($name, $label, $input, $icon, $errors){
        echo '
            <div class="form-group '. ($errors->has($name) ? "has-error" : "") .'">
                <div class="col-md-12">
                    <label>'. ucfirst($label) .'</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-'. $icon .' fa-lg"></i></span>
                        '. $input .'
                    </div>
                    '. self::viewError($errors, $name) .' 
                </div>
            </div>';
    }

    /**
     * Standard HTML Input Type
     * @param     string    $type      The type of the input. (text, date, email, etc)
     * @param     string    $name      The name of the field (also used as the id)
     * @param     string    $label     The text to be used for the label
     * @param     string    $icon      The FontAwesome icon to display, if any
     * @param     array     $errors    The Laravel error collection
     * @param     array     $value     The value we want to populate the input with, if it exists
     * @return    html                 The HTML output for this input, including the wrapper
     */
    public static function formInput($type, $name, $label, $icon, $errors, $value=''){
        $input = '<input type="'. $type .'" id="'. $name .'" name="'. $name .'" value="'. old($name, $value) .'" placeholder="'. $label .'" class="form-control">';

        self::inputWrapper($name, $label, $input, $icon, $errors);
    }

    /**
     * HTML Select input
     * @param     string     $name        The name of the field (also used as the id)
     * @param     string     $label       The text to be used for the label
     * @param     string     $icon        The FontAwesome icon to display, if any
     * @param     array      $options     The array of key => value options to be used
     * @param     array      $errors      The Laravel error collection
     * @param     array      $value       The value we want to populate the input with, if it exists
     * @param     boolean    $multiple    Is this a single select box or a multiple select box
     * @return    html                 The HTML output for this input, including the wrapper
     */
    public static function formSelect($name, $label, $icon, $options=[], $errors, $value='', $multiple=false){
        $optionList = '<option value="undefined">Select a '. $label .'</option>';

        foreach ($options as $val => $option) {
            $optionList .= '<option value="'. $val .'" '. (old($name) == $val || $value == $val ? "selected" : "") .'>'. $option .'</option>';
        }

        $input = '<select id="'. $name .'" name="'. $name .'" class="selectpicker" '. ($multiple ? 'multiple' : '') .' data-live-search="true" data-width="fit" data-size="20">
                    '. $optionList .'
                  </select>';

        self::inputWrapper($name, $label, $input, $icon, $errors);
    }

    /**
     * HTML Textarea input
     * @param     string    $name      The name of the field (also used as the id)
     * @param     string    $label     The text to be used for the label
     * @param     string    $icon      The FontAwesome icon to display, if any
     * @param     array     $errors    The Laravel error collection
     * @param     array     $value     The value we want to populate the input with, if it exists
     * @return    html                 The HTML output for this input, including the wrapper
     */
    public static function formTextarea($name, $label, $icon, $errors, $value=''){
        $input = '<textarea id="'. $name .'" name="'. $name .'" class="form-control expanding">'. old($name, $value) .'</textarea>';

        self::inputWrapper($name, $label, $input, $icon, $errors);
    }

    /**
     * HTML File input
     * @param     string    $name      The name of the field (also used as the id)
     * @param     string    $label     The text to be used for the label
     * @param     array     $errors    The Laravel error collection
     * @return    html                 The HTML output for this input, including the wrapper
     */
    public static function formFile($name, $label, $errors){
        $input = '<input type="file" id="'. $name .'" name="'. $name .'" class="form-control" />';

        self::inputWrapper($name, $label, $input, 'paperclip', $errors);
    }

    /**
     * HTML Checkbox input
     * @param     string    $name           The name of the field (also used as the id)
     * @param     string    $label          The text to be used for the label
     * @param     string    $description    The description of what this checkbox is for
     * @param     boolean   $checked        Is this input checked or not
     * @param     array     $errors         The Laravel error collection
     * @return    html                      The HTML output for this input, including the wrapper
     */
    public static function formCheckbox($name, $label, $description, $checked, $errors){
        echo '
            <div class="form-group '. ($errors->has($name) ? "has-error" : "") .'">
                
                <div class="col-md-3">
                    <input type="hidden" name="'. $name .'" value="'. old($name, '0') .'">
                    
                    <label class="form-checkbox form-icon active">
                        <input type="checkbox" id="'. $name .'" name="'. $name .'" value="1" '. ($checked ? 'checked="checked"' : '') .'>
                        '. $label .'
                    </label>
                </div>

                <div class="col-md-9">
                    <p>'. $description .'</p>
                    <p>'. self::viewError($errors, $name) .'</p>
                </div>
            </div>';
    }

    // public static function formDropzone($name, $label, $errors){
    //     echo '
    //         <div class="form-group '. ($errors->has($name) ? "has-error" : "") .'">
    //             <label class="col-md-3 control-label">'. $label .'</label>

    //             <div class="col-md-8">
    //                 <div id="'. $name .'" class="dropzone"></div>
    //                 '. self::viewError($errors, $name) .'
    //             </div>
    //         </div>';
    // }

    // public static function formTimePicker($name, $label, $defaultTime, $errors){
    //     echo '
    //         <div class="form-group '. ($errors->has($name) ? "has-error" : "") .'">
    //             <strong>&nbsp;&nbsp;'. $label .'</strong><br/>

    //             <div class="col-md-12">
    //                 <div class="input-group date">
    //                     <span class="input-group-addon"><i class="fa fa-clock-o fa-lg"></i></span>
    //                     <input type="time" id="'. $name .'" name="'. $name .'" value="'. $defaultTime .'" class="form-control time-picker" />
    //                 </div>
    //                 '. self::viewError($errors, $name) .'
    //             </div>
    //         </div>';
    // }

    // public static function formSearchField($name, $label, $errors, $value=''){
    //     echo '
    //         <form>
    //             <div class="'. ($errors->has($name) ? "has-error" : "") .'">
    //                 <div class="col-md-12" style="padding: 5px 0px;">
    //                     <div class="input-group">
    //                         <input type="text" id="'. $name .'" name="'. $name .'" value="'. old($name, $value) .'" placeholder="'. $label .'" class="form-control">
    //                         <span class="input-group-btn"><button id="'. $name .'Search" class="btn btn-default fa fa-search"></button></span>
    //                     </div>
    //                     '. self::viewError($errors, $name) .' 
    //                 </div>
    //             </div>
    //         </form>';
    // }
}