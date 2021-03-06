<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_id' => 'required|integer',
            'status' => 'required|in:published,draft',
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'created_at' => 'date',
            'updated_at' => 'date',
            'deleted_at' => 'date'
        ];
    }
}
