<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'new_file_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title field must not exceed 255 characters.',
            'message.required' => 'The message field is required.',
            'file_path.required' => 'An image is required.',
            'file_path.image' => 'The selected file must be an image.',
            'file_path.mimes' => 'Only JPEG, PNG, JPG, and GIF images are allowed.',
            'file_path.max' => 'The image size should not exceed 2MB.',
        ];
    }
}
