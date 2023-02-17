<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonScheduleRequest extends FormRequest
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
            'semester' => 'required',
            'teacher_id' => 'required',
            'class_room_id' => 'required',
            'subjects_id' => 'required',
            'day_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
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
            'teacher_id' => 'guru',
            'class_room_id' => 'kelas',
            'subjects_id' => 'mata pelajaran',
            'day_id' => 'hari',
            'start_time' => 'jam mulai',
            'end_time' => 'jam selesai',
        ];
    }
}
