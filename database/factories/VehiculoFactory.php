<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'placa' => $this->faker->regexify('[A-Z]\d[A-Z]-\d{3}'),
            //'origen'=>$this->faker->sentence(),
            //'destino'=>$this->faker->sentence(),
        ];
    }
}
