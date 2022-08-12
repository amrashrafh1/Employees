<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => (request()->isMethod('PATCH')) ? 'required|string|email|max:255|unique:employees,email,' . request()->route('employee')->id : 'required|string|email|max:255|unique:employees',
            'password' => (request()->isMethod('PATCH')) ? 'sometimes|nullable|string|min:6' : 'required|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'company_id' => 'nullable|integer|exists:companies,id',
        ];
    }
}
