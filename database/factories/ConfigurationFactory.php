<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuration>
 */
class ConfigurationFactory extends Factory
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
            'nombre' => $this->faker->name(),
            'description' => $this->faker->words(5, true),
            'key' => $this->faker->countryCode(),
            'string_value' => $this->faker->words(3, true),
            'numeric_value' => $this->faker->numberBetween(1000,100000),
            'registry_by' => Arr::random(['gomamon','patamon','angemon']),
            'status' => Arr::random(['activo','inactivo']),
        ];
    }
}
