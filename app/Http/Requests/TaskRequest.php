<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'            => 'required',
            'description'       => 'required',
            'employee_id' => 'required',
            'status'        => 'required',
        ];
    }

    public function messages()
    {
        $rules = [
            'title.required'            => 'Name is required',
            'description.required'       => 'Description required',
            'employee_id.required' => 'Employee is required',
            'status.required'        => 'Status required',
        ];
        return $rules;
    }
}
