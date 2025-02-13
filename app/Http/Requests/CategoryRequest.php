<?php

namespace App\Http\Requests;

use App\Constants\BasicConstants;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return [
            'nombre' => 'required|min:4',
            'publica' => 'required|in:si,no',
            'promediable' => 'required|in:si,no',
            'cronogramable' => 'required|in:si,no',
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
