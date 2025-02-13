<?php

namespace Database\Factories;

use App\Models\Rol;
use App\Models\Vista;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VistaRol>
 */
class VistaRolFactory extends Factory
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
            'vista_id' => Vista::factory(), // Relación con Vista
            'rol_id' => Rol::factory(), // Relación con Rol
            'status' => Arr::random(['activo','inactivo']),
        ];
    }
}
