<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolAdmin = new Rol();
        $rolAdmin->descripcion = 'Admin';
        $rolAdmin->save();

        $rolEmpleado = new Rol();
        $rolEmpleado->descripcion = 'Empleado';
        $rolEmpleado->save();
    }
}
