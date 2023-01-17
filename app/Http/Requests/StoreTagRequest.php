<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:tags|max:150',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'name.max' => 'Name cannot exceed :max characters.',
            'name.unique:tags' => 'The name already exists.'
        ];
    }
}
