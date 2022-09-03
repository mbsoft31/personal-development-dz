<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
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
            "title" => ["required", "string", "min:3"],
            "slug" => ["required", "string", "unique:books,slug"],
            "content" => ["nullable", "string"],
            "thumb" => ["nullable", "string"],
            "price" => ["nullable"],
            "status" => ["required", Rule::in(["draft", "published"])]
        ];
    }
}
