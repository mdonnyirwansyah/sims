<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class ParentsProfileRequest extends FormRequest
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
        $father = $this->user->student->families()->where('type', 'Father')->first();
        
        if ($father) {
            return [
                'father.*' => 'required',
                'father.phone' => 'required|unique:addresses,phone,'.$father->address->id,
                'mother.*' => 'required'
            ];
        }

        return [
            'father.*' => 'required',
            'father.phone' => 'required|unique:addresses,phone',
            'mother.*' => 'required',
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
            'father.name' => 'nama ayah',
            'father.occupation' => 'pekerjaan ayah',
            'mother.name' => 'nama ibu',
            'mother.occupation' => 'pekerjaan ibu',
            'father.address' => 'alamat orang tua',
            'father.phone' => 'no. hp orang tua'
        ];
    }
}
