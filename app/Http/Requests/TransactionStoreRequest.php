<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
            'transaction_type' => ['required', 'in:sale,purchase,stock'],
            'user_id' => ['required', 'string'],
            'transactable_id' => ['required', 'integer', 'gt:0'],
            'transactable_type' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'details' => ['nullable', 'json'],
        ];
    }
}
