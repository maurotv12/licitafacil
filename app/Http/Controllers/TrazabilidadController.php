<?php

namespace App\Http\Controllers;

use App\Models\Trazabilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrazabilidadController extends Controller
{
    public function crearTraza($descripcion, $tipo, $id, $tabla)
    {
        $user = Auth::user();
        $nuevaTraza = [
            'descripcion' => $descripcion,
            'id_tipo_trazabilidad' => $tipo,
            'id_usuario_trazabilidad' => $user->id,
        ];

        switch($tabla) {
            case 'archivo':
                $nuevaTraza['id_archivo'] = $id;
                break;
            case 'licitacion':
                $nuevaTraza['id_licitacion'] = $id;
                break;
            case 'usuario':
                $nuevaTraza['id_usuario'] = $id;
                break;
        }

        Trazabilidad::create($nuevaTraza);
    }
}
