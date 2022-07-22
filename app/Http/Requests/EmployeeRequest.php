<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class EmployeeRequest extends FormRequest
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

            'email'            => 'required',
            'first_name'       => 'required',
            'last_name'        => 'required',
            'address'          => 'required',
            'phone_number'     => 'required',
            'employee_status'           => 'required',
        ];
    }
    public function messages()
    {
        $rules = [
            'email.required'            => 'Email required',
            'first_name.required'       => 'First Name required',
            'last_name.required'        => 'Last Name required',
            'address.required'          => 'Address is required',
            'phone_number.required'     => 'Phone number is required',
            'employee_status.required'           => 'Employee Status is required',
        ];
        return $rules;
    }

    protected function failedValidation(Validator $validator){
//        dd($this->errorBag,$this->getRedirectUrl(),  $validator);
        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
