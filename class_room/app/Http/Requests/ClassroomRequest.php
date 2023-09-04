<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
        $id = $this->route('classroom' , 0);

        return [
            'code' => 'string',
            'name' => 'required|string|min:3|max:255',
            'section' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'room' => 'nullable|string| max:255',
            'cover_img' => [
                'image',
                'nullable',
                Rule::dimensions([
                    'min_width' => 300,
                    'min_height' => 100,
                ])
            ],
        ];
    }

    public function message(): array
    {
        // use to create custom error message
        return [
            'required' => ':attribute Important',
            'required.name' => 'Name field is Important!'
        ];
    }
}
