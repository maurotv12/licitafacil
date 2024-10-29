<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Licitacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function indexUsuarios() {
        $users = User::with('rol')->get();
        $view = 'Usuarios';
        return view('livewire/base-controller', compact('users', 'view'));
    }

    public function indexLicitaciones() {
        $user = Auth::user();
        $licitaciones = Licitacion::with('user')->with('estado')->with('cliente')->where('id_usuario', $user->id)->get();
        $view = 'Licitaciones';
        return view('livewire/base-controller', compact('licitaciones', 'view'));
    }

    public function indexClientes() {
        $clientes = Cliente::get();
        $view = 'Clientes';
        return view('livewire/base-controller', compact('clientes', 'view'));
    }
}
