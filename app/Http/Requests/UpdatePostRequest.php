<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', "min:5", "max:255", Rule::unique('posts')->ignore($this->post) , "string"],
            'description' => ['required', "min:10"],
            "user_id" => ['required', "exists:users,id", "integer"],
//            "title" => "required|min:5|max:255|unique:posts,title," . $this->post->id . "|string"
        "image" => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
}
