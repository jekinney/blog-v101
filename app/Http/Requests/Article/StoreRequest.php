<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'author_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:550|unique:articles,title',
            'body' => 'required',
            'header_image' => 'nullable|url',
            'is_draft' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'publish_at' => 'nullable',
            'expires_at' => 'nullable',
        ];
    }
}
