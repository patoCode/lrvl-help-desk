<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventSolicitudRequest  extends FormRequest
{
    public function rules(): array
    {
        return [
            'incidente' => 'required',
            'observacion' => 'required'
        ];
    }
}

