<?php

namespace Database\Factories;

use Faker\Generator as faker;
use App\Models\Operativo;
use App\Models\Empresa;
use App\Models\Inspector;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Pago;
use App\Models\Infraccion;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Acta>
 */
class ActaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

	    $operativo = Operativo::all()->random();
        $empresa = Empresa::all()->random();
        $inspector = Inspector::all()->random();
        $conductor = Conductor::all()->random();
        $vehiculo = Vehiculo::all()->random();
        $infraccion = Infraccion::all()->random();
        $pago = Pago::all()->random();


        return [
            //
		'estado'=> $this->faker->randomElement(["ARCHIVADO","CONDESCARGO","TRAMITADO", "DESCONOCIDO","CONRDR"]),
        'numero' => str_pad($this->faker->unique()->randomNumber(7), 7, '0', STR_PAD_LEFT),
        'ruta' =>$this->faker->randomElement(["AYAVIRI-AZANGARO","JULIACA-PUNO","ILAVE-AZANGARO", "PUNO-HUANCANE"]),
		'retencion' => $this->faker->randomElement(["LICENCIA","TUC","CITV", "SOAT","PLACA","NINGUNA"]),
        //'monto'=>$this->faker->randomElement([250.15,0,555.50]),
		'operativo_id' => $operativo->id,
        'empresa_id' =>$empresa->id,
        'inspector_id'=>$inspector->id,
        'conductor_id'=>$conductor->id,
        'vehiculo_id'=>$vehiculo->id,
        'infraccion_id'=>$infraccion->id,
        //'pago_id'=>$pago->id,
        'obs_acta'=>$this->faker->text(),
        ];
    }
}
