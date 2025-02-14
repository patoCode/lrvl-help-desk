<?php

namespace App\Http\Requests;

use App\Http\Requests\base\BaseRequest;
use Illuminate\Validation\Rule;

class UserRequest extends BaseRequest
{
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
            'rols' => 'nullable|array',
            'rols.*' => 'string',
            'ldap' => 'required|in:si,no',
            'status' => 'required|in:activo,inactivo'
        ];
    }

}
