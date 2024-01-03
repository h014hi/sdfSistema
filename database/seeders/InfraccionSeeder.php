<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfraccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultadVal = [

            [
                'id' => '1',
                'tipo' => 'F.1',
                'descripcion' => 'Prestar el servicio de transporte de personas, de mercancías o
                mixto, sin contar con autorización otorgada por la autoridad competente',
                'monto_100' => '4950.00',
                'monto_50' => '4950.00',
                'monto_30' => '4950.00',
            ],[
                'id' => '2',
                'tipo' => 'F.6a',
                'descripcion' => 'Negarse a entregar la información o documentación
                correspondiente al vehículo, a su habilitación como conductor',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ], [
                'id' => '3',
                'tipo' => 'F.6b',
                'descripcion' => 'Brindar información no conforme, a la autoridad competente,
                durante la fiscalización con el propósito de hacerla incurrir en
                error respecto de la autorización para prestar el servicio,',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],  [
                'id' => '4',
                'tipo' => 'F.6c',
                'descripcion' => 'Realizar maniobras evasivas con el vehículo para evitar la fiscalización',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],  [
                'id' => '5',
                'tipo' => 'F.6d',
                'descripcion' => 'Incurrir en actos de simulación, suplantación u otras conductas destinadas a hacer incurrir en error a la autoridad competente
                respecto de la autorización para prestar el servicio',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],  [
                'id' => '6',
                'tipo' => 'F.7',
                'descripcion' => 'Atentar contra la integridad física del inspector durante la realización de sus funciones',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],   [
                'id' => '7',
                'tipo' => 'S.1a',
                'descripcion' => 'No tenga(n) licencia de conducir.',
                'monto_100' => '2475.00',
                'monto_50' => '2475.00',
                'monto_30' => '2475.00',
            ],   [
                'id' => '8',
                'tipo' => 'S.1b',
                'descripcion' => 'Cuya licencia no se encuentra vigente',
                'monto_100' => '2475.00',
                'monto_50' => '2475.00',
                'monto_30' => '2475.00',
            ],   [
                'id' => '9',
                'tipo' => 'S.1c',
                'descripcion' => 'Cuya licencia de conducir no corresponde a la clase y categoría requerida por las características del vehículo y del servicio a prestar. ',
                'monto_100' => '2475.00',
                'monto_50' => '2475.00',
                'monto_30' => '2475.00',
            ],    [
                'id' => '10',
                'tipo' => 'S.5a',
                'descripcion' => 'Se transporte usuarios que excedan el número de asientos
                indicado por el fabricante del vehículo',
                'monto_100' => '2475.00',
                'monto_50' => '2475.00',
                'monto_30' => '2475.00',
            ],  [
                'id' => '11',
                'tipo' => 'S.5c',
                'descripcion' => 'Se transporte usuarios que excedan al número
                establecido, conforme lo establece el presente Reglamento',
                'monto_100' => '495.00',
                'monto_50' => '495.00',
                'monto_30' => '495.00',
            ],  [
                'id' => '12',
                'tipo' => 'S.8a',
                'descripcion' => 'Realizar la conducción de un vehículo de transporte con licencia
                vencida',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],   [
                'id' => '13',
                'tipo' => 'S.8b',
                'descripcion' => 'Realizar la conducción de un vehículo de transporte con licencia  se encuentre retenida, suspendida o cancelada ',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],   [
                'id' => '14',
                'tipo' => 'S.8c',
                'descripcion' => 'Realizar la conducción de un vehículo de transporte con licencia
                no corresponda a la clase y categoría requerida por la naturaleza y características del servicio',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],  [
                'id' => '15',
                'tipo' => 'S.8c',
                'descripcion' => 'Realizar la conducción de un vehículo de transporte con licencia
                no corresponda a la clase y categoría requerida por la naturaleza y características del servicio',
                'monto_100' => '2475.00',
                'monto_50' => '1237.50',
                'monto_30' => '1732.50',
            ],  [
                'id' => '16',
                'tipo' => 'I.1a',
                'descripcion' => 'El manifiesto de usuarios o el de pasajeros, en el transporte de personas, cuando
                éstos no sean electrónicos',
                'monto_100' => '495.00',
                'monto_50' => '247.50',
                'monto_30' => '346.50',
            ],   [
                'id' => '17',
                'tipo' => 'I.1b',
                'descripcion' => 'La hoja de ruta cuando no sea electrónica',
                'monto_100' => '495.00',
                'monto_50' => '247.50',
                'monto_30' => '346.50',
            ],   [
                'id' => '18',
                'tipo' => 'I.1d',
                'descripcion' => 'El documento de habilitación del vehículo',
                'monto_100' => '495.00',
                'monto_50' => '247.50',
                'monto_30' => '346.50',
            ],  [
                'id' => '19',
                'tipo' => 'I.7b',
                'descripcion' => 'No cumplir con llenar la información necesaria en la hoja de ruta o el manifiesto de
                usuarios o de pasajeros, cuando corresponda, conforme a lo establecido en el presente Reglamento y las normas complementarias',
                'monto_100' => '495.00',
                'monto_50' => '247.50',
                'monto_30' => '346.50',
            ],[
                'id' => '20',
                'tipo' => 'I.7c',
                'descripcion' => 'No cumplir con llenar la información necesaria en la hoja de ruta o el manifiesto de
                usuarios o de pasajeros, cuando corresponda, conforme a lo establecido en el presente Reglamento y las normas complementarias',
                'monto_100' => '495.00',
                'monto_50' => '247.50',
                'monto_30' => '346.50',
            ], 
        ];

        DB::table('infraccion')->insert($facultadVal);
    }
}

