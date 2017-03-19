<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => 'required|integer',
            'image_id' => 'nullable|integer',
            'map_id' => 'nullable|integer',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'visit_date' => 'required|date',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date'
        ];
    }
}
