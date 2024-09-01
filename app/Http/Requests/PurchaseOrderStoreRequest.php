<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderStoreRequest extends FormRequest
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
            'supplier_id' => ['required', 'string'],
            'total_amount' => ['required', 'numeric', 'between:-999999.99,999999.99'],
            'status' => ['required', 'in:pending,received,canceled'],
            'created_at' => ['nullable'],
        ];
    }
}
