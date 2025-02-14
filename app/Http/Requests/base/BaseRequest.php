<?php
namespace App\Http\Requests\base;

use App\Constants\BasicConstants;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
