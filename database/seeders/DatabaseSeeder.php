<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as faker;
use App\Models\Operativo;
use App\Models\Empresa;
use App\Models\Inspector;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Infraccion;
use App\Models\Pago;
use App\Models\Acta;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //orden de creacion influye xd en migraciones y en factories
	Operativo::factory(3)->create();
    Empresa::factory(10)->create();
    Inspector::factory(3)->create();
    Conductor::factory(15)->create();
    Vehiculo::factory(15)->create();
    Infraccion::factory(10)->create();
    Pago::factory(15)->create();
	Acta::factory(15)->create();

    $this->call(UserSeeder::class);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
