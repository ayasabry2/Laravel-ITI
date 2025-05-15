<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'body' => 'required|string|max:1000',
            'commentable_id' => 'required|integer',
            'commentable_type' => 'required|string|in:App\Models\Post',
        ];
    }

    public function messages(): array
{
    return [
        'body.required' => 'The comment field is required.',
        'body.string' => 'The comment must be a string.',
        'body.max' => 'The comment may not be greater than 1000 characters.',
        'commentable_id.required' => 'The post ID is required.',
        'commentable_type.required' => 'The post type is required.',
        'commentable_type.in' => 'The post type is invalid.',
    ];
}
}