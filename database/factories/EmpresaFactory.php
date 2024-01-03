<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acta>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $numeroDNI = $this->faker->randomNumber(8);

        return [
            'razon_social'=> $this->faker->randomElement(["CHIRIWANOS","AGUILA","NEVADO","PERLA DEL SUR","SAN INGNACIO","DESCONOCIDO"]),
            'nombres_rep_legal' => $this->faker->text(),
            'apellidos_rep_legal' => $this->faker->text(),
            'dni_rep_legal' => $numeroDNI,
            'res_funcionamiento' => $this->faker->randomNumber(9),
            'partida_electronica' =>$this->faker->randomNumber(8),
            'numero_celular' => '9' . $this->faker->randomNumber(8),
            'ruc' => $this->faker->randomElement(['20', '10']) . $numeroDNI . $this->faker->numberBetween(1, 9),
            'domicilio' => $this->faker->text(),
        ];

    }
}
