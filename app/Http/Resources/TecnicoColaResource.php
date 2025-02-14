<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TecnicoColaResource extends JsonResource
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
            'order' => $this->order,
            'tecnico' => new TecnicoResource($this->whenLoaded('tecnico')),
            'cola' => new ColaResource($this->whenLoaded('cola')),
            'status' => $this->status
        ];
    }
}
