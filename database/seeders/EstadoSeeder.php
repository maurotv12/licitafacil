<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estadoActivo = new Estado();
        $estadoActivo->descripcion = 'Activo';
        $estadoActivo->save();

        $estadoInactivo = new Estado();
        $estadoInactivo->descripcion = 'Inactivo';
        $estadoInactivo->save();

        $estadoProceso = new Estado();
        $estadoProceso->descripcion = 'En proceso';
        $estadoProceso->save();
    }
}
