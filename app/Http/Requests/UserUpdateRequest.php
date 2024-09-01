<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'password', 'max:400'],
            'email_verified_at' => ['nullable'],
            'last_login_datetime' => ['nullable'],
            'last_login_os' => ['nullable', 'string', 'max:50'],
            'last_login_ip' => ['nullable'],
            'last_login_useragent' => ['nullable', 'string'],
        ];
    }
}
