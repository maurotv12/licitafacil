<?php

namespace App\Livewire;

use App\Http\Controllers\TrazabilidadController;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class UsuariosComponent extends Component
{
    public $modal = false;
    public string $cedula = '';
    public string $name = '';
    public string $apellido = '';
    public string $telefono = '';
    public string $id_rol = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public $roles = [];
    public $users = [];
    public $isEdition = false;
    public $editionUser;
    public string $texto = '';

    public function render()
    {
        return view('livewire.usuarios-component');
    }

    public function mount()
    {
        $this->roles = Rol::get();
        $this->getUsers();
    }

    public function getUsers() {
        $this->users = User::with('rol')->get();
    }

    public function validateFields() {
        if ($this->isEdition) {
            $this->editUser();
        } else {
            $this->createUser();
        }
    }

    /**
     * Handle an incoming registration request.
     */
    public function createUser(): void
    {
        $validated = $this->validate([
            'cedula' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
            'id_rol' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['id_estado'] = 1;

        event(new Registered($user = User::create($validated)));

        app(TrazabilidadController::class)->crearTraza(implode(",", $validated), 1, $user->id, 'usuario');

        $this->getUsers();
        $this->modal = false;
    }

    /**
     * Handle an incoming registration request.
     */
    public function editUser(): void
    {
        $validated = $this->validate([
            'cedula' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
            'id_rol' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['id_estado'] = 1;

        $user = User::find($this->editionUser->id);
        $usuarioAntes = $user;
        $user->cedula = $validated['cedula'];
        $user->name = $validated['name'];
        $user->apellido = $validated['apellido'];
        $user->telefono = $validated['telefono'];
        $user->id_rol = $validated['id_rol'];

        if ($user->email !== $this->editionUser->email) {
            $user->email = $validated['email'];
        }

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
            $user->password = $validated['password'];
        }

        $user->save();
        app(TrazabilidadController::class)->crearTraza(strval($usuarioAntes).' => '.implode(",", $user->toArray()), 2, $user->id, 'usuario');

        $this->getUsers();
        $this->modal = false;
    }

    public function abrirModalCrear() {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = false;
    }

    public function abrirModalEditar($idUser) {
        $this->clearFields();
        $this->modal = true;
        $this->isEdition = true;

        $this->editionUser = User::find($idUser);
        $this->cedula = $this->editionUser->cedula;
        $this->name = $this->editionUser->name;
        $this->apellido = $this->editionUser->apellido;
        $this->telefono = $this->editionUser->telefono;
        $this->id_rol = $this->editionUser->id_rol;
        $this->email = $this->editionUser->email;
    }

    public function cerrarModal() {
        $this->clearFields();
        $this->modal = false;
    }

    public function clearFields() {
        $this->cedula = '';
        $this->name = '';
        $this->apellido = '';
        $this->telefono = '';
        $this->id_rol = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function ordenar($columna) {
        $this->users = User::orderBy($columna)->get();
    }

    public function buscar() {
        $this->users = User::with('rol')->where('name', 'like', '%'.$this->texto.'%')
            ->orWhere('apellido', 'like', '%'.$this->texto.'%')
            ->orWhere('telefono', 'like', '%'.$this->texto.'%')
            ->orWhere('email', 'like', '%'.$this->texto.'%')
            ->orWhere('cedula', 'like', '%'.$this->texto.'%')
            ->orWhereRelation('rol', 'descripcion', 'like', '%'.$this->texto.'%')->get();
    }

    public function activarInactivar($userId) {
        $user = User::find($userId);
        $antes = $user->id_estado;
        if ($user->id_estado === 1) {
            $user->id_estado = 2;
        } else {
            $user->id_estado = 1;
        }
        $user->save();
        app(TrazabilidadController::class)->crearTraza($antes.' => '.$user->id_estado, 5, $user->id, 'usuario');
        $this->getUsers();
    }
}
