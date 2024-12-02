<div>
    <div class="grid grid-cols-2 gap-2">

    </div>
    <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between p-5">
        <button wire:click="abrirModalCrear" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex-">
            Crear
        </button>
        <div class="items-center justify-between">
            <div class="flex items-center justify-between gap-2">
                @if ($user->id_rol === 1)
                    <div class=" mb-2 bg-gray-200 text-sm text-gray-500 leading-none border-2 border-gray-200 rounded-md inline-flex dark:bg-gray-400 dark:border-gray-700 h-10">
                        <button wire:click="filtrarLicitacionesUsuario" class="inline-flex items-center transition-colors duration-300 ease-in focus:outline-none hover:text-grey-400 focus:text-grey-400 rounded-l-full px-4 py-2 {{!$showAll ? 'active' : ''}}" id="grid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-current w-4 h-4 mr-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            <span>Mias</span>
                        </button>
                        <button wire:click="filtrarLicitacionesUsuario" class="inline-flex items-center transition-colors duration-300 ease-in focus:outline-none hover:text-grey-400 focus:text-grey-400 rounded-r-full px-4 py-2 {{$showAll ? 'active' : ''}}" id="list">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-current w-4 h-4 mr-2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                            <span>Todas</span>
                        </button>
                    </div>
                    <div class="inline-flex justify-center content-center items-center gap-3 mb-2">
                        <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuario:</label>
                        <select wire:model="usuario" wire:change='getLicitaciones' id="usuario" name="usuario" class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option value="">Todos</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{$user->name}} {{$user->apellido}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <style>
                    .active {background: white; border-radius: 5px; color: #black;}
                </style>
                <div class="inline-flex justify-center content-center items-center gap-3 mb-2">
                    <label for="orden" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Orden:</label>
                    <select wire:model="orden" wire:change='getLicitaciones' id="orden" name="orden" class="w-40 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <option value="nombre">Nombre</option>
                        <option value="fecha_inicio">Fecha Inicio</option>
                        <option value="fecha_fin">Fecha Fin</option>
                        <option value="id_estado">Estado</option>
                        <option value="id_cliente">Cliente</option>
                        <option value="id_usuario">Usuario</option>
                    </select>
                </div>

            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input wire:keyup="getLicitaciones" wire:model="texto" type="text" id="table-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar licitaciones">
            </div>
        </div>
    </div>

    <div class="grid mb-8 md:mb-12 md:grid-cols-4 pl-2 pr-5">
        @foreach ($licitaciones as $licitacion)
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 m-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$licitacion->nombre}}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Descripción: {{$licitacion->descripcion}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Cliente: {{$licitacion->cliente->nombre}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Usuario: {{$licitacion->user->name}} {{$licitacion->user->apellido}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Estado: {{$licitacion->estado->descripcion}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fecha inicio: {{$licitacion->fecha_inicio}}</p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Fecha fin: {{$licitacion->fecha_fin}}</p>
                <a wire:click='abrirModalEditar({{$licitacion->id}})' href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Editar
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>
            </div>
        @endforeach
    </div>

    <!-- Main modal -->
    @if ($modal)
        <div id="modal" tabindex="-1" aria-hidden="true" class="backdrop-blur flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-3xl max-h-full">
            <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">

                            @if ($isEdition)
                                Editar licitación
                            @else
                                Crear licitación
                            @endif
                        </h3>
                        <button wire:click="cerrarModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Cerrar</span>
                        </button>
                    </div>

                    <form class="max-w-2xl mx-auto mt-2" autocomplete="off" @submit.prevent="submit">
                        <div class="mb-5">
                            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input wire:model="nombre" type="text" id="nombre" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Licitación" required />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                        <div class="mb-5">
                            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                            {{-- <input wire:model="descripcion" type="text" id="descripcion" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="1234567" required /> --}}
                            <textarea wire:model="descripcion" id="descripcion" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Descripción de la licitación" required></textarea>
                            <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div class="mb-5">
                                <label for="id_cliente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                                <select wire:model="id_cliente" id="id_cliente" name="id_cliente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_cliente')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="id_estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                                <select wire:model="id_estado" id="id_estado" name="id_estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}">{{ $estado->descripcion }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_estado')" class="mt-2" />
                            </div>

                            <div class="mb-5">
                                <label for="fecha_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha inicio </label>
                                <input wire:model="fecha_inicio" type="date" id="fecha_inicio" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="1234567" required />
                                <x-input-error :messages="$errors->get('fecha_inicio')" class="mt-2" />
                            </div>
                            <div class="mb-5">
                                <label for="fecha_fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha fin </label>
                                <input wire:model="fecha_fin" type="date" id="fecha_fin" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="1234567" required />
                                <x-input-error :messages="$errors->get('fecha_fin')" class="mt-2" />
                            </div>

                        </div>

                        <div class="mb-5">
                            <label for="archivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Archivos</label>
                            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4">
                                <div>
                                    <input wire:model="archivo" id="archivo" name="archivo" class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"  type="file">
                                    <x-input-error :messages="$errors->get('archivo')" class="mt-2" />
                                </div>
                                <div>
                                    <div class="inline-flex justify-center content-center items-center gap-3 mb-2">
                                        <label for="id_tipo_archivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo:</label>
                                        <select wire:model="id_tipo_archivo" id="id_tipo_archivo" name="id_tipo_archivo" class="w-50 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($tiposArchivo as $tipo)
                                                <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <x-input-error :messages="$errors->get('id_tipo_archivo')" class="mt-2" />
                                </div>
                                <button wire:click.prevent="agregarArchivo" type="button" class="px-1 py-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                    </svg>
                                    <span class="sr-only">Agregar archivo</span>
                                </button>
                            </div>
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-5">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Nombre
                                            <a href="#" wire:click="ordenar('name')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <div class="flex items-center">
                                            Tipo
                                            <a href="#" wire:click="ordenar('id_rol')">
                                                <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archivos as $archivo)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="ps-3">
                                                <div class="text-base font-semibold max-w-sm">{{Str::limit($archivo['nombre'], 30)}}</div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$archivo['tipo']['descripcion']}}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if (isset($archivo['id']))
                                                <a wire:click.prevent='descargar({{$loop->index}})' href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Descargar</a>
                                            @endif
                                            <a wire:click.prevent='eliminar({{$loop->index}})' href="#" class="{{isset($archivo['id']) ? 'ml-2' : ''}} font-medium text-blue-600 dark:text-blue-500 hover:underline">Eliminar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        <button
                            wire:click.prevent="validateFields"
                            type="submit"
                            class="mb-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            @if ($isEdition)
                                Editar
                            @else
                                Guardar
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

