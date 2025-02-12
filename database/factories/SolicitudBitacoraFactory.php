<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Solicitud;
use App\Models\Tecnico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolicitudBitacora>
 */
class SolicitudBitacoraFactory extends Factory
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
            'nro_evento' => 0,
            'evento' => $this->faker->words(2),
            'observacion' => $this->faker->words(6),
            'usuario_id' => User::factory(),
            'category_id' => Categoria::factory(),
            'solicitud_id' => Solicitud::factory(),
            'tecnico_id' => Tecnico::factory(),
            'status_bitacora' => Arr::random(['actual','partial','completed','paused']),
            'status' => Arr::random(['active','inactive']),
        ];
    }
}
