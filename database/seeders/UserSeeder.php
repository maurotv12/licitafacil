<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user = new User();
        $user->name = 'Mauricio';
        $user->apellido = 'Muñoz';
        $user->cedula = '1144212220';
        $user->telefono = '3135529157';
        $user->id_rol = '1';
        $user->id_estado = '1';
        $user->fecha_nacimiento = '1999-05-12';
        $user->email = 'm-mau55@hotmail.com';
        $user->password = Hash::make('123456');
        $user->save();
    }
}
