<?php

namespace Database\Factories;

use App\Models\Grupo;
use App\Models\Tecnico;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GrupoUsuario>
 */
class GrupoUsuarioFactory extends Factory
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
            'usuario_id' => User::factory(),
            'tecnico_id' => Tecnico::factory(),
            'grupo_id' => Grupo::factory(),
            'status' => Arr::random(['active','inactive']),
        ];
    }
}
