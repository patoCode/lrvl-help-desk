<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
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
            'default' =>Arr::random(['si','no']),
            'sys_code'=> Arr::random(['TEC','SOL','ADM']),
            'status' => Arr::random(['activo','inactivo']),
        ];
    }
}
