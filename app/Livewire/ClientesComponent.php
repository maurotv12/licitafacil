<?php

namespace App\Livewire;

use App\Http\Controllers\TrazabilidadController;
use App\Models\Cliente;
use Livewire\Component;

class ClientesComponent extends Component
{
    public function render()
    {
        return view('livewire.clientes-component');
    }

    public $modal = false;
    public string $no_identificacion = '';
    public string $nombre = '';
    public string $telefono = '';
    public string $email = '';
    public $clientes = [];
    public $isEdition = false;
    public $editionClient;
    public string $texto = '';
    public $orden = 'nombre';

    public function mount()
    {
        $this->getClientes();
    }

    public function getClientes() {
        $this->clientes = Cliente::where('nombre', 'like', '%'.$this->texto.'%')
            ->orWhere('no_identificacion', 'like', '%'.$this->texto.'%')
            ->orWhere('telefono', 'like', '%'.$this->texto.'%')
            ->orWhere('email', 'like', '%'.$this->texto.'%')->get();
    }

    public function validateFields() {
        if ($this->isEdition) {
            $this->editCliente();
        } else {
            $this->createCliente();
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function createCliente(): void
    {
        $validated = $this->validate([
            'no_identificacion' => ['required', 'string', 'max:20'],
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'telefono' => ['required', 'string', 'max:10']
        ]);

        $cliente = Cliente::create($validated);
        app(TrazabilidadController::class)->crearTraza(implode(",", $validated), 1, $cliente->id, 'cliente');

        $this->getClientes();
        $this->modal = false;
    }

    /**
     * Handle an incoming registration request.
     */
    public function editCliente(): void
    {
        $validated = $this->validate([
            'no_identificacion' => ['required', 'string', 'max:20'],
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'telefono' => ['required', 'string', 'max:10']
        ]);

        $cliente = Cliente::find($this->editionClient->id);
        $antes = $cliente;
        $cliente->no_identificacion = $validated['no_identificacion'];
        $cliente->nombre = $validated['nombre'];
        $cliente->email = $validated['email'];
        $cliente->telefono = $validated['telefono'];

        $cliente->save();
        app(TrazabilidadController::class)->crearTraza(strval($antes).' => '.implode(",", $cliente->toArray()), 2, $cliente->id, 'cliente');

        $this->getClientes();
        $this->modal = false;
    }

    public function abrirModalCrear() {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = false;
    }

    public function abrirModalEditar($idCliente) {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = true;

        $this->editionClient = Cliente::find($idCliente);
        $this->no_identificacion = $this->editionClient->no_identificacion;
        $this->nombre = $this->editionClient->nombre;
        $this->email = $this->editionClient->email;
        $this->telefono = $this->editionClient->telefono;
    }

    public function cerrarModal() {
        $this->clearFields();
        $this->modal = false;
    }

    public function clearFields() {
        $this->no_identificacion = '';
        $this->nombre = '';
        $this->telefono = '';
        $this->email = '';
    }

    public function ordenar($columna) {
        $this->orden = $columna;
        $this->getClientes();
    }
}
