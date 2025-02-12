<?php

namespace Database\Factories;

use App\Models\Configuration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConfigurationBitacora>
 */
class ConfigurationBitacoraFactory extends Factory
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
            'event' => $this->faker->sentence(5),
            'key' => $this->faker->countryCode(),
            'string_value' => $this->faker->words(3),
            'numeric_value' => $this->faker->numberBetween(1000,100000),
            'registry_by' => Arr::random(['gomamon','patamon','angemon']),
            'status' => Arr::random(['active','inactive']),
            'configuration_id' => Configuration::factory(),
        ];
    }
}
