<?php

namespace App\Http\Resources;

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
            'publica' => $this->is_public?'si':'no',
            'promediable' =>$this->is_promediable?'si':'no',
            'cronogramable' =>$this->is_schedulable?'si':'no',
            'status' => $this->status
        ];
    }
}
