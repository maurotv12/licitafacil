<?php

use App\Models\User;
use App\Models\Rol;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $cedula = '';
    public string $name = '';
    public string $apellido = '';
    public string $telefono = '';
    public string $id_rol = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
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

        // Auth::login($user);

        $this->redirect(route('user-component', absolute: false), navigate: true);
    }
}; ?>

<x-slot name="header">
    <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Crear usuario') }}
            </h2>
        </div>
    </div>
</x-slot>

<div class="p-10">
    <form wire:submit="register" @submit.prevent="submit">
        <div class="grid grid-cols-2 gap-2 mt-2">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autocomplete="name" autofocus/>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="apellido" :value="__('Apellido')" />
                <x-text-input wire:model="apellido" id="apellido" class="block mt-1 w-full" type="text" name="apellido" required autocomplete="apellido" />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <!-- Cedula -->
            <div>
                <x-input-label for="cedula" :value="__('Cedula')" />
                <x-text-input wire:model="cedula" id="cedula" class="block mt-1 w-full" type="text" name="cedula" required autocomplete="cedula" />
                <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="telefono" :value="__('Telefono')" />
                <x-text-input wire:model="telefono" id="telefono" class="block mt-1 w-full" type="text" name="telefono" required autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <!-- Rol -->
            <div>
                <x-input-label for="id_rol" :value="__('Rol')" />
                <select wire:model="id_rol" id="id_rol" name="id_rol" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="">Select an option</option>
                    @foreach (Rol::get() as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->descripcion }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_rol')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <!-- <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a> -->

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
</div>

