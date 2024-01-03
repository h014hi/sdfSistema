<?php

namespace Database\Factories;
use Faker\Generator as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Infraccion>
 */
class InfraccionFactory extends Factory
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
            'codigo' => $this->faker->regexify('^[A-Z]\d{1,2}[A-Za-z]$'), // Genera códigos como "C4b"
            'tipo' => $this->faker->randomElement(["incumplimiento", "infraccion"]),
            'descripcion' => $this->faker->text(),
            'calificacion' => $this->faker->randomElement(["LEVE", "GRAVE", "MUY GRAVE"]),
            'm_preventivas' => $this->faker->realText(20),
            'consecuencia' => $this->faker->realText(20),
            'importe' => $this->faker->randomElement([495.00,2475.00,4950.00,247.50]),
            'descuento' => $this->faker->randomElement([0,1])
        ];
    }
}
