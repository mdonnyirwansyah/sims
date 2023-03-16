<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentUpdateRequest extends FormRequest
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
        $father = $this->student->families()->where('type', 'Father')->first();
        $guardian = $this->student->families()->where('type', 'Guardian')->first();

        return [
            'name' => 'required',
            'nis' => 'required|unique:students,nis,'.$this->student->id,
            'nisn' => 'required|unique:users,username,'.$this->student->user->id,
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'profile_picture' => 'image|max:1024',
            'class_at' => 'required',
            'registered_at' => 'required',
            'address' => 'required',
            'email' => $this->student->user->address()->count() > 0 ? 'required|unique:addresses,email,'.$this->student->user->address->id : 'required|unique:addresses,email',
            'phone' => $this->student->user->address()->count() > 0 ? 'required|unique:addresses,phone,'.$this->student->user->address->id : 'required|unique:addresses,phone',
            'father.*' => 'required',
            'father.phone' => $father ? 'required|unique:addresses,phone,'.$father->address->id : 'required|unique:addresses,phone',
            'mother.*' => 'required',
            'guardian.*' => $guardian ? 'required' : '',
            'guardian.phone' => $guardian ? 'unique:addresses,phone,'.$guardian->address->id : 'unique:addresses,phone'
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
            'name' => 'nama',
            'nis' => 'nis',
            'nisn' => 'nisn',
            'place_of_birth' => 'tempat lahir',
            'date_of_birth' => 'tanggal lahir',
            'gender' => 'jenis kelamin',
            'religion' => 'agama',
            'profile_picture' => 'foto profil',
            'class_at' => 'di kelas',
            'registered_at' => 'pada tanggal',
            'address' => 'alamat',
            'email' => 'email',
            'phone' => 'no. hp',
            'father.name' => 'nama ayah',
            'father.occupation' => 'pekerjaan ayah',
            'mother.name' => 'nama ibu',
            'mother.occupation' => 'pekerjaan ibu',
            'father.address' => 'alamat orang tua',
            'father.phone' => 'no. hp orang tua',
            'guardian.name' => 'nama wali',
            'guardian.occupation' => 'pekerjaan wali',
            'guardian.address' => 'alamat wali',
            'guardian.phone' => 'no. hp wali',
        ];
    }
}
