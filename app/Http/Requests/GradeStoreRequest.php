<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class GradeStoreRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['error' => $validator->errors()], Response::HTTP_OK));
    }

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
            'semester' => 'required',
            'class_room_id' => 'required',
            'type' => 'required',
            'student_id' => 'required',
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
            'school_year_id' => 'tahun pelajaran',
            'semester' => 'semester',
            'class_room_id' => 'kelas',
            'type' => 'jenis',
            'student_id' => 'siswa',
            'subjects.*.value' => 'nilai',
            'subjects.*.description' => 'keterangan'
        ];
    }
}
