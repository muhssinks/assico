<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'company_id' => 'exists:companies,id',
        ];
    }
}
