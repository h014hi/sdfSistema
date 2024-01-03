<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $registros = [
            [
                'fecha' => '2023-04-24',
                'Nroacta' => '0000271',
                'lugar' => 'PUENTE CACACHI',
                'empresa' => 'E.T. ETVICON S.R.L.',
                'placa' => 'Z9X959',
                'ruta' => 'JULIACA-TARACO',
                'nombres' => 'JORGE ARMANDO',
                'apellidos' => 'CALLO MACHACA',
                'dni' => '41811125',
                'categoria' => 'AIIIC',
                'retencion' => 'TUC',
                'pago' => 'SI',
                'fecha2' => '2023-04-25',
                'id_infraccion' => 20,
                'tipo' => 'incumplimiento',
                'presento_desc' => 'si',
                'pago_desc' => '20',
                'nro_descargo' => '5765',
                'nro_oficioDCT' => '089',
                'emisionIFI' => 'si',
                'nro_IFI' => '084',
                'nro_oficio_DCT_DRCT' => '074',
                'R_D_R_Nro' => '084',
                'nro_descargo2' => '074',
                'estado' => 'activo',
            ],
            
     ];

        
     foreach ($registros as $registro) {
        $id = DB::table('usuarioc')->insertGetId($registro);
    
        // Realiza cualquier otra operación necesaria con el ID asignado
        // por ejemplo, puedes imprimirlo o almacenarlo en una variable
        echo "El ID asignado es: " . $id . "\n";
    }
    }
}
