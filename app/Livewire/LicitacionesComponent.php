<?php

namespace App\Livewire;

use App\Http\Controllers\TrazabilidadController;
use App\Models\Archivo;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Licitacion;
use App\Models\TipoArchivo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class LicitacionesComponent extends Component
{
    use WithFileUploads;

    public $user;
    public $licitaciones = [];
    public $archivos = [];
    public $modal = false;
    public $clientes = [];
    public $users = [];
    public $estados = [];
    public $tiposArchivo = [];
    public string $nombre = '';
    public string $descripcion = '';
    public string $id_usuario = '';
    public string $id_estado = '';
    public string $id_cliente = '';
    public string $id_tipo_archivo = '';
    public $archivo;
    public $archivosAgregados = [];
    public $isEdition = false;
    public $editionLicitacion;

    public $showAll = false;
    public $orden = 'nombre';
    public string $texto = '';


    public function render()
    {
        return view('livewire.licitaciones-component');
    }

    public function mount() {
        $this->user = Auth::user();
        $this->getLicitaciones();
        $this->clientes = Cliente::orderBy('nombre')->get();
        $this->users = User::get();
        $this->estados = Estado::get();
        $this->tiposArchivo = TipoArchivo::where('id', '!=', 1)->get();
    }

    public function filtrarLicitacionesUsuario() {
        $this->showAll = !$this->showAll;
        $this->getLicitaciones();
    }

    public function abrirModalCrear() {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = false;
    }

    public function abrirModalEditar($idLicitacion) {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = true;
        $this->editionLicitacion = Licitacion::find($idLicitacion);
        $this->nombre = $this->editionLicitacion->nombre;
        $this->descripcion = $this->editionLicitacion->descripcion;
        $this->id_usuario = $this->editionLicitacion->id_usuario;
        $this->id_estado = $this->editionLicitacion->id_estado;
        $this->id_cliente = $this->editionLicitacion->id_cliente;
        $this->archivos = Archivo::with('tipo')->where('id_tipo_archivo', '!=', 1)->Where('id_licitacion', $idLicitacion)->get()->toArray();
    }

    public function cerrarModal() {
        $this->clearFields();
        $this->modal = false;
    }

    public function clearFields() {
        $this->nombre = '';
        $this->descripcion = '';
        $this->id_usuario = '';
        $this->id_estado = '';
        $this->id_cliente = '';
        $this->archivo = '';
        $this->id_tipo_archivo = '';
        $this->archivos = [];
        $this->archivosAgregados = [];
    }

    public function getLicitaciones() {
        $this->licitaciones = Licitacion::with('estado')->with('user')->with('cliente')->with('archivos')
            ->where('nombre', 'like', '%'.$this->texto.'%')
            ->orWhere('descripcion', 'like', '%'.$this->texto.'%')
            ->orWhereRelation('estado', 'descripcion', 'like', '%'.$this->texto.'%')
            ->orWhereRelation('user', 'name', 'like', '%'.$this->texto.'%')
            ->orWhereRelation('user', 'apellido', 'like', '%'.$this->texto.'%')
            ->orWhereRelation('cliente', 'nombre', 'like', '%'.$this->texto.'%')
            ->orderBy($this->orden)
            ->get();

        if (!$this->showAll) {
            $this->licitaciones = collect($this->licitaciones)->filter(function($licitacion) {
                return $licitacion->id_usuario == $this->user->id;
            })->all();
        }
    }

    public function validateFields() {
        if ($this->isEdition) {
            $this->editarLicitacion();
        } else {
            $this->crearLicitacion();
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function crearLicitacion(): void
    {
        $validated = $this->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required'],
            'id_estado' => ['required'],
        ]);

        $validated['id_usuario'] = $this->user->id;

        $licitacion = Licitacion::create($validated);
        app(TrazabilidadController::class)->crearTraza(implode(",", $validated), 1, $licitacion->id, 'licitacion');

        $this->guardarArchivos($licitacion);
    }

    /**
     * Handle an incoming registration request.
     */
    public function editarLicitacion(): void
    {
        $validated = $this->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required'],
            'id_estado' => ['required'],
        ]);

        $licitacion = Licitacion::find($this->editionLicitacion->id);
        $antes = $licitacion;
        $licitacion->nombre = $validated['nombre'];
        $licitacion->descripcion = $validated['descripcion'];
        $licitacion->id_cliente = $validated['id_cliente'];
        $licitacion->id_estado = $validated['id_estado'];


        $licitacion->save();
        app(TrazabilidadController::class)->crearTraza(strval($antes).' => '.implode(",", $licitacion->toArray()), 2, $licitacion->id, 'licitacion');

        $this->guardarArchivos($licitacion);
    }

    public function guardarArchivos($licitacion) {
        foreach ($this->archivosAgregados as $archivo) {
            $archivo->storeAs('archivos/'.$licitacion->id, $archivo->getClientOriginalName());
        }

        foreach ($this->archivos as $archivo) {
            if (!isset($archivo['id'])) {
                $nuevoArchivo = [
                    'nombre' => $archivo['nombre'],
                    'ruta' => 'archivos/'.$licitacion->id.'/'.$archivo['nombre'],
                    'id_tipo_archivo' => $archivo['id_tipo_archivo'],
                    'id_licitacion' => $licitacion->id
                ];

                $archivoNuevo = Archivo::create($nuevoArchivo);
                app(TrazabilidadController::class)->crearTraza(implode(",", $nuevoArchivo), 4, $archivoNuevo->id, 'archivo');
            }
        }

        $this->getLicitaciones();
        $this->modal = false;
    }

    public function agregarArchivo(): void
    {
        $validated = $this->validate([
            'archivo' => ['required'],
            'id_tipo_archivo' => ['required'],
        ]);

        $validated;

        $nuevoArchivo = [
            'nombre' => $this->archivo->getClientOriginalName(),
            'id_tipo_archivo' => $this->id_tipo_archivo,
            'tipo' => TipoArchivo::find($this->id_tipo_archivo),
            'pocision' => count($this->archivosAgregados)
        ];

        array_push($this->archivosAgregados, $this->archivo);
        array_push($this->archivos, $nuevoArchivo);
        $this->archivo = '';
        $this->id_tipo_archivo = '';
    }

    public function eliminar($archivoIndex) {
        if (isset($this->archivos[$archivoIndex]['id'])) {
            $archivo = Archivo::find($this->archivos[$archivoIndex]['id']);
            $archivo->id_tipo_archivo = 1;
            $archivo->save();
            app(TrazabilidadController::class)->crearTraza(strval($archivo), 3, $archivo->id, 'archivo');
            array_splice($this->archivos, $archivoIndex, 1);
        } else {
            array_splice($this->archivosAgregados, $this->archivos[$archivoIndex]['pocision'], 1);
            array_splice($this->archivos, $archivoIndex, 1);
        }
    }

    public function descargar($archivoIndex) {
        return Storage::download('archivos/'.$this->editionLicitacion->id.'/'.$this->archivos[$archivoIndex]['nombre']);
    }
}
