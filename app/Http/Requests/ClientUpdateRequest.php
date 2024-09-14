<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required' , "max:255"],
            'contact_information' => ['required' , "max:255"],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
