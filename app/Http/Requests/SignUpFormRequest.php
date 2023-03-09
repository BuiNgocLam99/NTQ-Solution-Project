<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'phone_number' => 'required|regex:/^\+?[0-9]{1,3}[ .-]?(\([0-9]{1,}\)|[0-9]{1,})[ .-]?[0-9]{1,}([ .-]?[0-9]{1,}){0,}$/',
            'password' => 'min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ];
    }
}
