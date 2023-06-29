<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'subjects' => 'required|array',
            'subjects.*.value' => 'nullable|numeric',
            'subjects.*.description' => 'nullable'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'subjects.*.value' => 'nilai',
            'subjects.*.description' => 'keterangan'
        ];
    }
}
