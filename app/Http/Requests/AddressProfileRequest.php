<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class AddressProfileRequest extends FormRequest
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
            'address' => 'required',
            'email' => $this->user->address()->count() > 0 ? 'required|unique:addresses,email,'.$this->user->address->id : 'required|unique:addresses,email',
            'phone' => $this->user->address()->count() > 0 ? 'required|unique:addresses,phone,'.$this->user->address->id : 'required|unique:addresses,phone'
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
            'address' => 'alamat',
            'email' => 'email',
            'phone' => 'no. hp'
        ];
    }
}
