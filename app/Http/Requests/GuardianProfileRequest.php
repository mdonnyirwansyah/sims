<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class GuardianProfileRequest extends FormRequest
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
        $guardian = $this->user->student->families()->where('type', 'Guardian')->first();
        
        if ($guardian) {
            return [
                'guardian.*' => 'required',
                'guardian.phone' => 'required|unique:addresses,phone,'.$guardian->address->id
            ];
        }

        return [
            'guardian.*' => 'required',
            'guardian.phone' => 'required|unique:addresses,phone'
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
            'guardian.name' => 'nama wali',
            'guardian.occupation' => 'pekerjaan wali',
            'guardian.address' => 'alamat wali',
            'guardian.phone' => 'no. hp wali',
        ];
    }
}
