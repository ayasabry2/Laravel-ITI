<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $postId = $this->route('post'); 

        return [
            'title' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('posts', 'title')->ignore($postId), 
            ],
            'body' => ['required', 'min:10'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'created_by' => ['required', 'string', 'max:255']
        ];
    }
}