<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Nette\Utils\Random;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vista>
 */
class VistaFactory extends Factory
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
            'url' => $this->faker->url(),
            'description' => $this->faker->paragraph(2),
            'version' => rand(1,3),
            'status' => Arr::random(['active','inactive']),
        ];
    }
}
