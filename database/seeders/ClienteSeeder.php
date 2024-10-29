<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estado = new Cliente();
        $estado->nombre = 'Camilo';
        $estado->no_identificacion = '33111222';
        $estado->telefono = '1234567';
        $estado->email = 'camilo@gmail.com';
        $estado->save();
    }
}
