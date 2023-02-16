<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRoomRequest extends FormRequest
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
            'school_year_id' => 'required',
            'class' => 'required',
            'name' => 'required',
            'teacher_id' => 'required'
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
            'school_year_id' => 'tahun pelajaran',
            'class' => 'kelas',
            'name' => 'nama kelas',
            'teacher_id' => 'wali kelas'
        ];
    }
}
