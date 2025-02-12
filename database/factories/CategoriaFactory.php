<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categoria>
 */
class CategoriaFactory extends Factory
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
            'nombre' => $this->faker->jobTitle(),
            'is_public' => Arr::random([true, false]),
            'is_promediable' => Arr::random([true, false]),
            'is_schedulable' => Arr::random([true, false]),
            'status' => Arr::random(['active','inactive']),
        ];
    }
}
