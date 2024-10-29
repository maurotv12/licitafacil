<?php

namespace Database\Seeders;

use App\Models\Trazabilidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrazabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trazabilidad = new Trazabilidad();
        $trazabilidad->descripcion = 'Cambio en el correo';
        $trazabilidad->id_usuario = 1;
        $trazabilidad->id_usuario_trazabilidad = 1;
        $trazabilidad->id_tipo_trazabilidad = 1;
        $trazabilidad->save();
    }
}
