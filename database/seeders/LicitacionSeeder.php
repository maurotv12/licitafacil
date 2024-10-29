<?php

namespace Database\Seeders;

use App\Models\Licitacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LicitacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licitacion = new Licitacion();
        $licitacion->nombre = 'Casas para todos';
        $licitacion->descripcion = 'Proyecto para construir casas para todos';
        $licitacion->id_usuario = 1;
        $licitacion->id_estado = 1;
        $licitacion->id_cliente = 1;
        $licitacion->save();
    }
}
