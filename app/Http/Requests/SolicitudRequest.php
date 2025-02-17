<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|min:10',
            'priority' => 'required|in:C,H,M,L',
            'is_promediable' => 'nullable',
            'category_id' => 'required',
            'registry_by' => 'nullable',
        ];
    }
}
