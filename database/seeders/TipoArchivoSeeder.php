<?php

namespace Database\Seeders;

use App\Models\TipoArchivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoArchivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoArchivoCedula = new TipoArchivo();
        $tipoArchivoCedula->descripcion = 'Eliminado';
        $tipoArchivoCedula->save();

        $tipoArchivoContrato = new TipoArchivo();
        $tipoArchivoContrato->descripcion = 'Contrato';
        $tipoArchivoContrato->save();

        $tipoArchivoEstimación = new TipoArchivo();
        $tipoArchivoEstimación->descripcion = 'Estimación';
        $tipoArchivoEstimación->save();
    }
}
