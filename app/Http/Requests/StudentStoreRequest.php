<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentStoreRequest extends FormRequest
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
            'name' => 'required',
            'nis' => 'required|unique:students,nis',
            'nisn' => 'required|unique:users,username',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'profile_picture' => 'image|max:1024',
            'class_at' => 'required',
            'registered_at' => 'required',
            'address' => 'required',
            'email' => 'required|unique:addresses,email',
            'phone' => 'required|unique:addresses,phone',
            'father.*' => 'required',
            'father.phone' => 'required|unique:addresses,phone',
            'mother.*' => 'required',
            'guardian.phone' => 'unique:addresses,phone'
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
