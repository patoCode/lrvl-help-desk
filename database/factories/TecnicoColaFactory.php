<?php

namespace Database\Factories;

use App\Models\Cola;
use App\Models\Tecnico;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TecnicoCola>
 */
class TecnicoColaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4(),
            'order' => 0,
            'tecnico_id' => Tecnico::factory(),
            'cola_id' => Cola::factory(),
            'registry_by' => Arr::random(['pikachu','raichu','angemon']),
            'status' => Arr::random(['activo','activo']),
        ];
    }
}
