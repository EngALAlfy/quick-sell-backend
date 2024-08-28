<?php

namespace App\Http\Requests;

use App\Enums\PermissionsGuard;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class RoleStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', Rule::unique("roles")->ignoreModel($this->role ?? null)],
            "title" => "required|array|max:" . count(supported_languages()),
            "title.*" => "required|max:255",
            "level" => "required|integer",
            "permissions" => "nullable|array",
            "guard_name" => "required|max:255|in:" . implode("," , PermissionsGuard::values()),
        ];
    }
}
