<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tecnico>
 */
class TecnicoFactory extends Factory
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
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'photo' => $this->faker->imageUrl(),
            'registry_by' => Arr::random(['denis.rodriguez','natalia.medrano','angemon']),
            'updated_by' => Arr::random(['denis.rodriguez','natalia.medrano','angemon']),
            'status' => Arr::random(['activo','activo']),
        ];
    }
}
