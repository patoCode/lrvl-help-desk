<?php

namespace App\Http\Requests;

use App\Constants\BasicConstants;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => 'required|min:4',
            'publica' => 'required|in:si,no',
            'promediable' => 'required|in:si,no',
            'cronogramable' => 'required|in:si,no',
            'status' => 'required|in:activo,inactivo'
        ];
    }


}
