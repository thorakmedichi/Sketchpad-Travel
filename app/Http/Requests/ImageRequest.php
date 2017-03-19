<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{

    private $clean = false;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function all(){
        return $this->sanitize(parent::all());
    }
    
    protected function sanitize(Array $inputs){
            if($this->clean){
                return $inputs;
            }

            // Remove whitespace from postal codes
            $inputs['date'] = date('Y-m-d', strtotime($inputs['date']));

            // Replace the inputs for the actual DB entries
            $this->replace($inputs);
            $this->clean = true;

            return $inputs;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'filename' => 'required|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date_format:Y-m-d',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date'
        ];
    }
}
