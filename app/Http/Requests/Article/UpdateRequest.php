<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:550|unique:articles,title,'.$this->id,
            'body' => 'required',
            'is_draft' => 'nullable|boolean',
            'publish_at' => 'nullable',
            'expires_at' => 'nullable',
            'author_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'header_image' => 'nullable|url',
            'publish_at' => 'nullable',
            'expires_at' => 'nullable',
        ];
    }
}
