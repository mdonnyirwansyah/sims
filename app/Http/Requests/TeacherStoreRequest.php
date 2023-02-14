<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
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
            'nip' => 'required|unique:teachers,nip',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'profile_picture' => 'image|max:1024',
            'address' => 'required',
            'email' => 'required|unique:addresses,email',
            'phone' => 'required|unique:addresses,phone'
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
            'nip' => 'nip',
            'place_of_birth' => 'tempat lahir',
            'date_of_birth' => 'tanggal lahir',
            'gender' => 'jenis kelamin',
            'religion' => 'agama',
            'education' => 'pendidikan',
            'profile_picture' => 'foto profil',
            'address' => 'alamat',
            'email' => 'email',
            'phone' => 'no. hp',
        ];
    }
}
