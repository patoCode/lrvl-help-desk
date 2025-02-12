<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Cola;
use App\Models\Tecnico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
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
            'description' => $this->faker->words(5),
            'priority' => Arr::random(['low', 'medium','high','critical']),
            'registry_by' => Arr::random(['greymon','laramon','angemon']),
            'updated_by' => Arr::random(['greymon','laramon','angemon']),
            'is_promediable' => Arr::random([true, false]),
            'category_id' => Categoria::factory(),
            'usuario_id' => User::factory(),
            'tecnico_id' => Tecnico::factory(),
            'cola_id' => Cola::factory(),
            'status' => Arr::random(['active','inactive']),

        ];
    }
}
