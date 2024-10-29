<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($view) }}
        </h2>
    </x-slot>

    <div class="mr-3 ml-3">
        @if($view === 'Usuarios')
        <livewire:usuarios-component />
        @elseif ($view === 'Licitaciones')
            <livewire:licitaciones-component />
        @elseif ($view === 'Clientes')
            <livewire:clientes-component />
        @endif
    </div>
</x-app-layout>
