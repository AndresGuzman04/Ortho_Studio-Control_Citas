<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'razon_social' => $this->faker->company(),
            'cargo' => $this->faker->jobTitle(),
            'img_path' => null, // o puedes usar $this->faker->imageUrl(400, 400, 'people') si quieres imagen aleatoria
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
