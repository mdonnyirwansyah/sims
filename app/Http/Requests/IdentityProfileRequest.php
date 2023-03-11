<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IdentityProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (Auth::user()->role->name !== 'Student') {
            return [
                'name' => 'required',
                'nip' => 'required|unique:users,username,'.$this->user->id,
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'religion' => 'required',
                'education' => 'required',
                'profile_picture' => 'image|max:1024'
            ];
        }

        return [
            'name' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'profile_picture' => 'image|max:1024'
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
            'place_of_birth' => 'tempat lahir',
            'date_of_birth' => 'tanggal lahir',
            'gender' => 'jenis kelamin',
            'religion' => 'agama',
            'education' => 'pendidikan',
            'profile_picture' => 'foto profil',
        ];
    }
}
