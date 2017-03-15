<?php

namespace App\Sketchpad;

class FastForms {

    public static function generate($table, $action, $errors, $ignoreGaurded = true){
        if (empty($table)){
            throw new Exception("You must provide a database table name", 1);
        }

        $fields = self::getDatabaseFields($table, $ignoreGaurded);
        
        self::generateHTML($fields, $action, $errors);
    }

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

    public static function generateHTML($fields, $action, $errors){

        echo '<form class="form-horizontal" role="form" method="POST" action="'. $action .'">'. csrf_field() ;
                        
        foreach ($fields as $field => $settings){
            if (strpos($settings['type'], 'varchar') !== false){
                self::formInput('text', $field, ucfirst($field), 'pencil', $errors);
            }

            if (strpos($settings['type'], 'int') !== false){
                self::formInput('text', $field, ucfirst($field), 'pencil', $errors);
            }

            if (strpos($settings['type'], 'enum') !== false){
                $options = [];

                preg_match_all('(\'(\w+)\')', $settings['type'], $matches);

                foreach ($matches[1] as $match){
                    $options[$match] = ucfirst($match);
                }

                self::formSelect($field, ucfirst($field), 'pencil', $options, $errors);
            }

            if (strpos($settings['type'], 'text') !== false){
                self::formTextarea($field, ucfirst($field), 'pencil', $errors);
            }
        }

        echo '<div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-labeled fa fa-floppy-o pull-right">Add</button>
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

    public static function inputWrapper($name, $input, $icon, $errors){
        echo '
            <div class="form-group '. ($errors->has($name) ? "has-error" : "") .'">
                <div class="col-md-12">
                    <label>'. ucfirst($name) .'</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-'. $icon .' fa-lg"></i></span>
                        '. $input .'
                    </div>
                    '. self::viewError($errors, $name) .' 
                </div>
            </div>';
    }

    public static function formInput($type, $name, $label, $icon, $errors, $value=''){
        $input = '<input type="'. $type .'" id="'. $name .'" name="'. $name .'" value="'. old($name, $value) .'" placeholder="'. $label .'" class="form-control">';

        self::inputWrapper($name, $input, $icon, $errors);
    }

    public static function formSelect($name, $label, $icon, $options=[], $errors, $value='', $multiple=false){
        $optionList = '<option value="undefined">Select a '. $label .'</option>';

        foreach ($options as $val => $option) {
            $optionList .= '<option value="'. $val .'" '. (old($name) == $val || $value == $val ? "selected" : "") .'>'. $option .'</option>';
        }

        $input = '<select id="'. $name .'" name="'. $name .'" class="selectpicker" '. ($multiple ? 'multiple' : '') .' data-live-search="true" data-width="fit" data-size="20">
                    '. $optionList .'
                  </select>';

        self::inputWrapper($name, $input, $icon, $errors);
    }

    public static function formTextarea($name, $label, $icon, $errors, $value=''){
        $input = '<textarea id="'. $name .'" name="'. $name .'" class="form-control expanding">'. old($name, $value) .'</textarea>';

        self::inputWrapper($name, $input, $icon, $errors);
    }

    public static function formFile($name, $label, $errors){
        $input = '<input type="file" id="'. $name .'" name="'. $name .'" class="form-control" />';

        self::inputWrapper($name, $input, 'paperclip', $errors);
    }

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