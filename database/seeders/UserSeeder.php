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
        $user->cedula = '11222333';
        $user->telefono = '1234567';
        $user->id_rol = '1';
        $user->email = 'mauricio@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
    }
}
