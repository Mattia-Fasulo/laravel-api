<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|unique:projects|max:150|min:3',
            'description' => 'nullable',
            'cover_image' => ['nullable','image','max:3000'],
            'category_id' => 'nullable|exists:categories,id',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least :min characters long.',
            'title.max' => 'Title cannot exceed :max characters.',
            'title.unique:projects' => 'The title already exists.'
        ];
    }
}
