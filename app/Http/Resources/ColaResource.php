<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColaResource extends JsonResource
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
            'ultimo' => $this->ultima_asignacion,
            'categoria' => new CategoryResource($this->whenLoaded('categoria')),
            'status' => $this->status
        ];
    }
}
