<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', "min:5", "max:255", "unique:posts,title", "string"],
            'description' => ['required', "min:10"],
            "user_id" => ['required', "exists:users,id", "integer"]
        ];
    }


    public function messages(): array
    {
        return [
            "title.required" => "please enter title, Title is required",
            "title.min" => "التايتل لازم يكون اكتر من 5 حروف",
            "description.required" => "please enter description, Description is required",
            "description.min" => "الوصف لازم يكون اكتر من 10 حروف",
            "user_id.required" => "please select user, User is required",
            "user_id.exists" => "please select valid user, User must exist in users table",
        ];
    }
}
