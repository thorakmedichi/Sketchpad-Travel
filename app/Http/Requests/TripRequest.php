<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
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
            $inputs['start_date'] = date('Y-m-d', strtotime($inputs['start_date']));
            $inputs['end_date'] = date('Y-m-d', strtotime($inputs['end_date']));

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
            'image_id' => 'nullable|integer',
            'map_id' => 'nullable|integer',
            'name' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date'
        ];
    }
}
