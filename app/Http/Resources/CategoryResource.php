<?php

namespace App\Http\Resources;

use App\Constants\BasicConstants;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'publica' => $this->is_public ? BasicConstants::TRUE_VALUE : BasicConstants::FALSE_VALUE,
            'promediable' =>$this->is_promediable ? BasicConstants::TRUE_VALUE : BasicConstants::FALSE_VALUE,
            'cronogramable' =>$this->is_schedulable ? BasicConstants::TRUE_VALUE : BasicConstants::FALSE_VALUE,
            'status' => $this->status
        ];
    }
}
