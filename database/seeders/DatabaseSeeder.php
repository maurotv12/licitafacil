<?php

namespace Database\Seeders;

use App\Models\Archivo;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Licitacion;
use App\Models\Rol;
use App\Models\TipoArchivo;
use App\Models\TipoTrazabilidad;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadoSeeder::class,
            RolSeeder::class,
            TipoTrazabilidadSeeder::class,
            TipoArchivoSeeder::class,
        ]);

        // Estado::factory(3)->create();
        // Rol::factory(3)->create();
        // TipoArchivo::factory(3)->create();
        // TipoTrazabilidad::factory(3)->create();
        // User::factory(10)->create();
        // Cliente::factory(10)->create();

        $this->call([
            /* EstadoSeeder::class,
            RolSeeder::class,
            TipoArchivoSeeder::class,
            TipoTrazabilidadSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class, */
            // LicitacionSeeder::class,
            // ArchivoSeeder::class,
            // TrazabilidadSeeder::class,
        ]);

    }
}
