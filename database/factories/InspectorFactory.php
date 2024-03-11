<?php

namespace Database\Factories;
use Faker\Generator as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inspector>
 */
class InspectorFactory extends Factory
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
        'nombres'=> $this->faker->randomElement(["Juan","Jorge","Julian"]),
        'apellidos'=> $this->faker->realText(20),
        'acreditado'=>$this->faker->randomElement(["SI"]),
        ];
    }
}
