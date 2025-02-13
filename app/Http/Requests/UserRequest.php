<?php

namespace App\Http\Requests;

use App\Constants\BasicConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id');
        return [
            'fullname' => 'required|string',
            'username' => 'required|string',
            'password' => 'nullable|required|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId), // Excluye la validación de unicidad para el usuario actual
            ],
            'ldap' => 'required|in:si,no',
            'status' => 'required|in:activo,inactivo'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => in_array(strtolower($this->status),[BasicConstants::STATUS_ACTIVE,BasicConstants::STATUS_IN_ACTIVE])
                ? $this->status
                : BasicConstants::STATUS_ACTIVE
        ]);
    }
}
