<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'sku' => ['required', 'string', 'max:100', 'unique:products,sku'],
            'sell_price' => ['required', 'numeric', 'min:1'],
            'purchase_price' => ['required', 'numeric', 'min:1'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
