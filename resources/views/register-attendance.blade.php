<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Libro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex justify-between items-center bg-gray-200 px-4 py-2 rounded-t-lg">
                    <h3 class="font-semibold text-lg">Libros</h3>
                    <a href="{{ route('book.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar Libro</a>
                </div>

                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse ($books as $item)
                        <!-- Tarjeta de Ejemplo -->
                        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                            <img src="https://via.placeholder.com/300" alt="Portada del Libro"
                                class="w-full h-64 object-cover rounded-t-lg">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $item->title }}</h3>
                                <p class="text-gray-700">Autor: {{ $item->author }}</p>
                                <p class="text-gray-700">Cantidad: {{ $item->quantity }}</p>
                                <p class="text-gray-700">Género: Ficción</p>
                                <div class="mt-4 flex justify-end space-x-4">
                                    <a href="#"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                                    <a href="#"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No hay libros disponibles.</p>
                    @endforelse
                </div>

                <!-- Paginador -->
                <div class="p-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Libro') }}
        </h2>
    </x-slot>

    


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Libros</h3>
                    <div class="flex justify-between mb-4">
                        <a href="{{ route('book.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Agregar
                            Libro</a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Libro
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Autor
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad de Libros
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                                <!-- Añade más encabezados según sea necesario -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($books as $item)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item -> title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dato 2</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dato 3</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <!-- Botón de Editar con más separación -->
                                        <a href="{{ route('register-attendance') }}"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-6">Editar</a>
                                        <!-- Botón de Eliminar -->
                                        <a href="{{ route('register-attendance') }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Eliminar</a>
                                    </td>
                                    <!-- Añade más datos según sea necesario -->
                                </tr>
                            @empty
                            @endforelse

                            <!-- Añade más filas según sea necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Libro') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <ul class="divide-y divide-gray-200">
                    <!-- Item de Ejemplo -->
                    <li class="py-4 px-6 flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Nombre del Libro</h3>
                            <p class="text-gray-700">Autor: Nombre del Autor</p>
                            <p class="text-gray-700">Cantidad: 5</p>
                        </div>
                        <div>
                            <a href="#"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                            <a href="#"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Eliminar</a>
                        </div>
                    </li>
                    <!-- Repite este item para cada libro -->
                </ul>
            </div>
        </div>
    </div>
</x-app-layout> --}}


