<?php

namespace Database\Seeders;

use App\Models\TipoTrazabilidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTrazabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoTraza = new TipoTrazabilidad();
        $tipoTraza->descripcion = 'Creación';
        $tipoTraza->save();

        $tipoTraza2 = new TipoTrazabilidad();
        $tipoTraza2->descripcion = 'Edición';
        $tipoTraza2->save();

        $tipoTraza3 = new TipoTrazabilidad();
        $tipoTraza3->descripcion = 'Eliminación';
        $tipoTraza3->save();

        $tipoTraza4 = new TipoTrazabilidad();
        $tipoTraza4->descripcion = 'Adición';
        $tipoTraza4->save();

        $tipoTraza5 = new TipoTrazabilidad();
        $tipoTraza5->descripcion = 'Estado';
        $tipoTraza5->save();
    }
}
