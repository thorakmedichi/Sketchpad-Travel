<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            $inputs['visit_date'] = date('Y-m-d', strtotime($inputs['visit_date']));

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
            'country_id' => 'required|string|size:2',
            'image_id' => 'nullable|integer',
            'map_id' => 'nullable|integer',
            'google_place_id' => 'nullable|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'visit_date' => 'required|date_format:Y-m-d',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date'
        ];
    }
}
