<?php

namespace Database\Seeders;

use App\Models\Archivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $archivo = new Archivo();
        $archivo->nombre = 'Cedula Camilo';
        $archivo->ruta = 'files/123';
        $archivo->id_tipo_archivo = 1;
        $archivo->id_licitacion = 1;
        $archivo->save();
    }
}
