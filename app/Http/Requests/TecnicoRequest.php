<?php

namespace App\Http\Requests;

use App\Http\Requests\base\BaseRequest;

class TecnicoRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario_id'=> '',
            'status'=> 'nullable|in:activo,inactivo'
        ];
    }
}
