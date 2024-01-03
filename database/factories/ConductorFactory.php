<?php

namespace Database\Factories;
use Faker\Generator as faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conductor>
 */
class ConductorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $letraLicencia = $this->faker->randomElement(['A', 'U', 'Q']);
        $numerosDNI = $this->faker->randomNumber(8);

        // Asegurar que el DNI tenga siempre 8 dígitos llenando con ceros a la izquierda
        $dni = str_pad($numerosDNI, 8, '0', STR_PAD_LEFT);

        $licencia = $letraLicencia . $dni;

        return [
            'nombres' => $this->faker->randomElement(["HENRY", "JUAN", "PEDRO", "SAMUEL"]),
            'apellidos' => $this->faker->randomElement(["QUISPE", "ANASTACIO", "HUARAYA", "LOPEZ"]),
            'dni' => $dni,
            'licencia' => strtoupper($licencia),
            'categoria'=> $this->faker->randomElement(["A-IIIa","A-IIb","AI","A-IIIc"]),
            'estadolicencia'=> $this->faker->randomElement(["VENCIDO","VIGENTE","ENTRAMITE","DESCONOCIDO"]),
            //'categoria' => $this->faker->randomElement(["AIIIa", "AIIb", "AI"]),
            //'estado' => $this->faker->sentence(),
        ];
        }
}
